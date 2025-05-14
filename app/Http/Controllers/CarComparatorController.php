<?php

namespace App\Http\Controllers;

use App\Models\Make;
use App\Models\CarModel;
use App\Models\Trim;
use App\Models\Motor;
use App\Models\Body;
use App\Models\Mileage;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CarComparatorController extends Controller
{
    public function index()
    {
        // Obtener marcas únicas
        $marcas = Make::orderBy('name')->get();
        Log::info('CarComparator - Index: Marcas obtenidas', ['count' => $marcas->count()]);
        
        return view('car-comparator', compact('marcas'));
    }

    public function getModelos(Request $request)
    {
        $makeId = $request->marca;
        Log::info('CarComparator - getModelos: Solicitud recibida', ['makeId' => $makeId]);
        
        $make = Make::find($makeId);
        
        if (!$make) {
            Log::warning('CarComparator - getModelos: Marca no encontrada', ['makeId' => $makeId]);
            return response()->json([]);
        }
        
        $modelos = $make->models;
        Log::info('CarComparator - getModelos: Modelos encontrados', [
            'makeId' => $makeId,
            'makeName' => $make->name,
            'modelosCount' => $modelos->count()
        ]);
        
        return response()->json($modelos);
    }

    public function getVersiones(Request $request)
    {
        $makeId = $request->marca;
        $modelName = $request->modelo;
        
        Log::info('CarComparator - getVersiones: Solicitud recibida', [
            'makeId' => $makeId,
            'modelName' => $modelName
        ]);
        
        // Encontrar primero el modelo específico
        $modelo = CarModel::where('PK_name', $modelName)->first();
        
        if (!$modelo) {
            Log::warning('CarComparator - getVersiones: Modelo no encontrado', [
                'makeId' => $makeId,
                'modelName' => $modelName
            ]);
            return response()->json([]);
        }
        
        // Buscar la relación en la tabla pivote
        $makeModel = DB::table('make_model')
            ->where('FK_make_id', $makeId)
            ->where('FK_name', $modelName)
            ->first();
            
        if (!$makeModel) {
            Log::warning('CarComparator - getVersiones: Relación make-model no encontrada', [
                'makeId' => $makeId,
                'modelName' => $modelName
            ]);
            return response()->json([]);
        }
        
        // Obtener todas las versiones (trims) asociadas con este make_model
        $versiones = Trim::where('FK_make_model_id', $makeModel->PK_id)
            ->select('PK_id', 'name as version')
            ->orderBy('name')
            ->get();
            
        Log::info('CarComparator - getVersiones: Versiones encontradas', [
            'makeId' => $makeId,
            'modelName' => $modelName,
            'makeModelId' => $makeModel->PK_id,
            'versionesCount' => $versiones->count()
        ]);
        
        return response()->json($versiones);
    }

    public function getAutoDetalle(Request $request)
    {
        $autoId = $request->auto_id;
        Log::info('CarComparator - getAutoDetalle: Solicitud recibida', ['autoId' => $autoId]);
        
        $trim = Trim::with(['engine', 'body', 'mileage', 'year', 'makeModel.make', 'makeModel.model'])
            ->findOrFail($autoId);
            
        Log::info('CarComparator - getAutoDetalle: Auto encontrado', [
            'autoId' => $autoId,
            'marca' => $trim->makeModel->make->name ?? 'N/A',
            'modelo' => $trim->makeModel->model->PK_name ?? 'N/A',
            'version' => $trim->name
        ]);
        
        // Formatear datos para mantener compatibilidad con la vista existente
        $auto = [
            'id' => $trim->PK_id,
            'marca' => $trim->makeModel->make->name ?? 'N/A',
            'modelo' => $trim->makeModel->model->PK_name ?? 'N/A',
            'version' => $trim->name,
            'year' => $trim->year ? $trim->year->year : 'N/A',
            'price' => $trim->price ?? 0,
            'motor' => [
                'combustible' => $trim->engine->fuel_type ?? 'N/A',
                'cilindrada' => $trim->engine->size ?? 'N/A',
                'potencia' => $trim->engine->horsepower_hp ?? 'N/A',
                'torque' => $trim->engine->torque_ft_lbs ?? 'N/A',
                'cilindros' => $trim->engine->cylinders ?? 'N/A',
                'tipo' => $trim->engine->engine_type ?? 'N/A',
                'valvulas' => $trim->engine->valves ?? 'N/A',
                'transmision' => $trim->engine->transmission ?? 'N/A',
            ],
            'transmision' => [
                'tipo' => $trim->engine->transmission ?? 'N/A',
                'traccion' => $trim->engine->drive_type ?? 'N/A',
                'marchas' => preg_replace('/[^0-9]/', '', $trim->engine->transmission ?? '') ?: 'N/A',
            ],
            'dimension' => [
                'largo' => $trim->body->length ?? 'N/A',
                'ancho' => $trim->body->width ?? 'N/A',
                'alto' => $trim->body->height ?? 'N/A',
                'distancia_ejes' => $trim->body->wheel_base ?? 'N/A',
                'peso' => $trim->body->curb_weight ?? 'N/A',
                'capacidad_carga' => $trim->body->cargo_capacity ?? 'N/A',
                'capacidad_tanque' => $trim->mileage->fuel_tank_capacity ?? 'N/A',
                'puertas' => $trim->body->doors ?? 'N/A',
                'asientos' => $trim->body->seats ?? 'N/A',
            ],
            'rendimiento' => [
                'ciudad' => $trim->mileage->city_LitersAt100km ?? 'N/A',
                'carretera' => $trim->mileage->highway_LitersAt100km ?? 'N/A',
                'combinado' => $trim->mileage->combined_LitersAt100km ?? 'N/A',
                'autonomia' => $trim->mileage->range_highway ?? 'N/A',
            ],
        ];
        
        return response()->json($auto);
    }

    public function comparacionDetallada(Request $request)
    {
        Log::info('CarComparator - comparacionDetallada: Solicitud recibida', [
            'autos_ids' => $request->autos
        ]);
        
        $trims = Trim::with(['engine', 'body', 'mileage', 'year', 'makeModel.make', 'makeModel.model'])
            ->whereIn('PK_id', $request->autos)
            ->get();
            
        Log::info('CarComparator - comparacionDetallada: Autos encontrados', [
            'requested_ids' => $request->autos,
            'found_ids' => $trims->pluck('PK_id')->toArray(),
            'count' => $trims->count()
        ]);
            
        // Convertir las versiones a un formato compatible con la vista existente
        $autos = $trims->map(function($trim) {
            // Asegurarnos que obtenemos el año correctamente
            $yearValue = $trim->year ? $trim->year->year : 'N/A';
            
            $auto = (object)[
                'id' => $trim->PK_id,
                'marca' => $trim->makeModel->make->name ?? 'N/A',
                'modelo' => $trim->makeModel->model->PK_name ?? 'N/A',
                'version' => $trim->name,
                'year' => $yearValue,
                'price' => $trim->price ?? 0,
                'motor' => (object)[
                    'combustible' => $trim->engine->fuel_type ?? 'N/A',
                    'cilindrada' => $trim->engine->size ?? 'N/A',
                    'potencia' => $trim->engine->horsepower_hp ?? 'N/A',
                    'torque' => $trim->engine->torque_ft_lbs ?? 'N/A',
                    'cilindros' => $trim->engine->cylinders ?? 'N/A',
                    'tipo' => $trim->engine->engine_type ?? 'N/A',
                    'valvulas' => $trim->engine->valves ?? 'N/A',
                ],
                'transmision' => (object)[
                    'tipo' => $trim->engine->transmission ?? 'N/A',
                    'traccion' => $trim->engine->drive_type ?? 'N/A',
                    'marchas' => preg_replace('/[^0-9]/', '', $trim->engine->transmission ?? '') ?: 'N/A',
                ],
                'dimension' => (object)[
                    'largo' => $trim->body->length ?? 'N/A',
                    'ancho' => $trim->body->width ?? 'N/A',
                    'alto' => $trim->body->height ?? 'N/A',
                    'distancia_ejes' => $trim->body->wheel_base ?? 'N/A',
                    'peso' => $trim->body->curb_weight ?? 'N/A',
                    'capacidad_carga' => $trim->body->cargo_capacity ?? 'N/A',
                    'capacidad_tanque' => $trim->mileage->fuel_tank_capacity ?? 'N/A',
                    'puertas' => $trim->body->doors ?? 'N/A',
                    'asientos' => $trim->body->seats ?? 'N/A',
                ],
                'rendimiento' => (object)[
                    'ciudad' => $trim->mileage->city_LitersAt100km ?? 'N/A',
                    'carretera' => $trim->mileage->highway_LitersAt100km ?? 'N/A',
                    'combinado' => $trim->mileage->combined_LitersAt100km ?? 'N/A',
                    'autonomia' => $trim->mileage->range_highway ?? 'N/A',
                ],
            ];
            
            Log::info('CarComparator - comparacionDetallada: Auto procesado', [
                'id' => $auto->id,
                'marca' => $auto->marca,
                'modelo' => $auto->modelo,
                'version' => $auto->version
            ]);
            
            return $auto;
        });
        
        return view('car-comparison', compact('autos'));
    }
} 