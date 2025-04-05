<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use Illuminate\Http\Request;

class CarComparatorController extends Controller
{
    public function index()
    {
        // Obtener marcas únicas
        $marcas = Auto::select('marca')->distinct()->orderBy('marca')->pluck('marca');
        
        return view('car-comparator', compact('marcas'));
    }

    public function getModelos(Request $request)
    {
        $modelos = Auto::where('marca', $request->marca)
            ->select('modelo')
            ->distinct()
            ->orderBy('modelo')
            ->pluck('modelo');
        
        return response()->json($modelos);
    }

    public function getVersiones(Request $request)
    {
        $versiones = Auto::where('marca', $request->marca)
            ->where('modelo', $request->modelo)
            ->select('version', 'id')
            ->orderBy('version')
            ->get();
        
        return response()->json($versiones);
    }

    public function getAutoDetalle(Request $request)
    {
        $auto = Auto::with(['motor', 'transmision', 'dimension', 'seguridad', 'confort', 'entretenimiento'])
            ->findOrFail($request->auto_id);
        
        return response()->json($auto);
    }

    public function comparacionDetallada(Request $request)
    {
        $autos = Auto::with(['motor', 'transmision', 'dimension', 'seguridad', 'confort', 'entretenimiento'])
            ->whereIn('id', $request->autos)
            ->get();
        
        return view('car-comparison', compact('autos'));
    }
} 