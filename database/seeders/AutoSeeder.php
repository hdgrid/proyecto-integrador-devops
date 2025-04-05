<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auto;
use App\Models\Motor;
use App\Models\Transmision;
use App\Models\Dimension;
use App\Models\Seguridad;
use App\Models\Confort;
use App\Models\Entretenimiento;

class AutoSeeder extends Seeder
{
    public function run()
    {
        // Toyota Corolla
        $corolla = Auto::create([
            'nombre' => 'Corolla',
            'marca' => 'Toyota',
            'modelo' => 'Corolla',
            'anio' => 2024,
            'version' => 'SE'
        ]);

        Motor::create([
            'auto_id' => $corolla->id,
            'tipo' => 'L4 DOHC',
            'cilindros' => 4,
            'cilindrada' => 2.0,
            'potencia' => 169,
            'torque' => 151,
            'combustible' => 'Gasolina'
        ]);

        Transmision::create([
            'auto_id' => $corolla->id,
            'tipo' => 'CVT',
            'traccion' => 'Delantera',
            'marchas' => 10
        ]);

        Dimension::create([
            'auto_id' => $corolla->id,
            'largo' => 4630,
            'ancho' => 1780,
            'alto' => 1435,
            'peso' => 1375,
            'capacidad_tanque' => 50,
            'capacidad_cajuela' => 470,
            'distancia_ejes' => 2700
        ]);

        Seguridad::create([
            'auto_id' => $corolla->id,
            'airbags' => 10,
            'abs' => true,
            'control_traccion' => true,
            'control_estabilidad' => true,
            'asistente_frenado' => true,
            'monitoreo_presion_neumaticos' => true,
            'camara_reversa' => true,
            'sensores_estacionamiento' => true
        ]);

        Confort::create([
            'auto_id' => $corolla->id,
            'aire_acondicionado' => true,
            'climatizador' => true,
            'asientos_calefactables' => true,
            'asientos_electricos' => true,
            'techo_solar' => false,
            'volante_multifuncion' => true,
            'control_crucero' => true,
            'encendido_sin_llave' => true
        ]);

        Entretenimiento::create([
            'auto_id' => $corolla->id,
            'sistema_infotainment' => 'Toyota Audio Multimedia',
            'pantalla_principal' => 8.0,
            'pantalla_secundaria' => false,
            'sistema_sonido' => 'JBL Premium Audio',
            'numero_parlantes' => 6,
            'bluetooth' => true,
            'android_auto' => true,
            'apple_carplay' => true,
            'navegador_gps' => true,
            'cargador_inalambrico' => true,
            'puertos_usb' => 4
        ]);

        // Honda Civic
        $civic = Auto::create([
            'nombre' => 'Civic',
            'marca' => 'Honda',
            'modelo' => 'Civic',
            'anio' => 2024,
            'version' => 'Touring'
        ]);

        Motor::create([
            'auto_id' => $civic->id,
            'tipo' => 'L4 Turbo',
            'cilindros' => 4,
            'cilindrada' => 1.5,
            'potencia' => 180,
            'torque' => 177,
            'combustible' => 'Gasolina'
        ]);

        Transmision::create([
            'auto_id' => $civic->id,
            'tipo' => 'CVT',
            'traccion' => 'Delantera',
            'marchas' => 7
        ]);

        Dimension::create([
            'auto_id' => $civic->id,
            'largo' => 4674,
            'ancho' => 1801,
            'alto' => 1415,
            'peso' => 1396,
            'capacidad_tanque' => 47,
            'capacidad_cajuela' => 419,
            'distancia_ejes' => 2735
        ]);

        Seguridad::create([
            'auto_id' => $civic->id,
            'airbags' => 10,
            'abs' => true,
            'control_traccion' => true,
            'control_estabilidad' => true,
            'asistente_frenado' => true,
            'monitoreo_presion_neumaticos' => true,
            'camara_reversa' => true,
            'sensores_estacionamiento' => true
        ]);

        Confort::create([
            'auto_id' => $civic->id,
            'aire_acondicionado' => true,
            'climatizador' => true,
            'asientos_calefactables' => true,
            'asientos_electricos' => true,
            'techo_solar' => true,
            'volante_multifuncion' => true,
            'control_crucero' => true,
            'encendido_sin_llave' => true
        ]);

        Entretenimiento::create([
            'auto_id' => $civic->id,
            'sistema_infotainment' => 'Honda Display Audio',
            'pantalla_principal' => 9.0,
            'pantalla_secundaria' => true,
            'sistema_sonido' => 'Bose Premium Sound',
            'numero_parlantes' => 12,
            'bluetooth' => true,
            'android_auto' => true,
            'apple_carplay' => true,
            'navegador_gps' => true,
            'cargador_inalambrico' => true,
            'puertos_usb' => 4
        ]);

        // Volkswagen Jetta
        $jetta = Auto::create([
            'nombre' => 'Jetta',
            'marca' => 'Volkswagen',
            'modelo' => 'Jetta',
            'anio' => 2024,
            'version' => 'GLI'
        ]);

        Motor::create([
            'auto_id' => $jetta->id,
            'tipo' => 'L4 TSI',
            'cilindros' => 4,
            'cilindrada' => 2.0,
            'potencia' => 228,
            'torque' => 258,
            'combustible' => 'Gasolina Premium'
        ]);

        Transmision::create([
            'auto_id' => $jetta->id,
            'tipo' => 'DSG',
            'traccion' => 'Delantera',
            'marchas' => 7
        ]);

        Dimension::create([
            'auto_id' => $jetta->id,
            'largo' => 4702,
            'ancho' => 1799,
            'alto' => 1459,
            'peso' => 1463,
            'capacidad_tanque' => 51,
            'capacidad_cajuela' => 510,
            'distancia_ejes' => 2686
        ]);

        Seguridad::create([
            'auto_id' => $jetta->id,
            'airbags' => 7,
            'abs' => true,
            'control_traccion' => true,
            'control_estabilidad' => true,
            'asistente_frenado' => true,
            'monitoreo_presion_neumaticos' => true,
            'camara_reversa' => true,
            'sensores_estacionamiento' => true
        ]);

        Confort::create([
            'auto_id' => $jetta->id,
            'aire_acondicionado' => true,
            'climatizador' => true,
            'asientos_calefactables' => true,
            'asientos_electricos' => true,
            'techo_solar' => true,
            'volante_multifuncion' => true,
            'control_crucero' => true,
            'encendido_sin_llave' => true
        ]);

        Entretenimiento::create([
            'auto_id' => $jetta->id,
            'sistema_infotainment' => 'VW Composition Media',
            'pantalla_principal' => 10.0,
            'pantalla_secundaria' => true,
            'sistema_sonido' => 'BeatsAudio',
            'numero_parlantes' => 8,
            'bluetooth' => true,
            'android_auto' => true,
            'apple_carplay' => true,
            'navegador_gps' => true,
            'cargador_inalambrico' => true,
            'puertos_usb' => 4
        ]);
    }
}