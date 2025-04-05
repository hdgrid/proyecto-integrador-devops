<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comparación Detallada - CarWizard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/car-comparison.css') }}">
</head>

<body>
    <!-- navbar -->
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="https://via.placeholder.com/150x40/4366e6/ffffff?text=CarWizard" alt="CarWizard">
            </a>
            <a href="{{ route('comparador') }}" class="button button--secondary">
                <i class="fas fa-arrow-left"></i> Volver al comparador
            </a>
        </div>
    </nav>

    <!-- header -->
    <section class="header-section">
        <div class="container">
            <h1 class="text-center mb-3">
                @foreach($autos as $key => $auto)
                    {{ $auto->marca }} {{ $auto->modelo }}
                    @if($key < count($autos) - 1) vs @endif
                @endforeach
            </h1>
            <p class="text-center">Comparación de las características técnicas, de equipamiento, seguridad y precios de 
                @foreach($autos as $key => $auto)
                    {{ $auto->marca }} {{ $auto->modelo }}
                    @if($key < count($autos) - 1) {{ $key == count($autos) - 2 ? ' y ' : ', ' }} @endif
                @endforeach.
            </p>
        </div>
    </section>

    <!-- contenido principal -->
    <div class="container comparison">
        <!-- Cards de autos -->
        <div class="row mb-4">
            @foreach($autos as $auto)
            <div class="col-md-{{ 12/count($autos) }} mb-3">
                <div class="car">
                    <img src="{{ asset('storage/uploads/placeholder-auto.png') }}" alt="{{ $auto->marca }} {{ $auto->modelo }}" class="car__image">
                    <h3 class="car__title">{{ $auto->marca }} {{ $auto->modelo }}</h3>
                    <p class="car__subtitle">{{ $auto->version }}</p>
                    <div class="car__price">${{ rand(300000, 900000) }}</div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Fabricado en -->
        <div class="comparison__section">
            <h2 class="comparison__title">Fabricación</h2>
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Fabricado en</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{{ ['Japón', 'Gran Bretaña', 'Italia', 'Alemania', 'Estados Unidos'][rand(0, 4)] }}</div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Motor y rendimiento -->
        <div class="comparison__section">
            <h2 class="comparison__title">Motor</h2>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Combustible</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{{ $auto->motor->combustible }}</div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Cilindrada</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{{ $auto->motor->cilindrada * 1000 }} cc</div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Potencia</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">
                            {{ $auto->motor->potencia }} hp/rpm
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Torque</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">
                            {{ $auto->motor->torque }} lb-pie/rpm
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Cilindros</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{{ $auto->motor->cilindros }} en línea</div>
                    @endforeach
                </div>
            </div>

            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Tipo de Motor</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{{ $auto->motor->tipo }}</div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Transmisión -->
        <div class="comparison__section">
            <h2 class="comparison__title">Transmisión</h2>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Tipo</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{{ $auto->transmision->tipo }}</div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Tracción</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{{ $auto->transmision->traccion }}</div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Velocidades</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{{ $auto->transmision->marchas }}</div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Dimensiones -->
        <div class="comparison__section">
            <h2 class="comparison__title">Dimensiones y Capacidades</h2>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Largo (mm)</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{{ $auto->dimension->largo }}</div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Ancho (mm)</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{{ $auto->dimension->ancho }}</div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Alto (mm)</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{{ $auto->dimension->alto }}</div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Distancia entre ejes (mm)</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{{ $auto->dimension->distancia_ejes }}</div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Peso (kg)</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{{ $auto->dimension->peso }}</div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Capacidad de tanque (L)</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{{ $auto->dimension->capacidad_tanque }}</div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Capacidad de cajuela (L)</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">
                            {{ $auto->dimension->capacidad_cajuela }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Seguridad -->
        <div class="comparison__section">
            <h2 class="comparison__title">Seguridad</h2>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Airbags</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">
                            {{ $auto->seguridad->airbags }}
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">ABS</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{!! $auto->seguridad->abs ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>' !!}</div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Control de Tracción</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{!! $auto->seguridad->control_traccion ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>' !!}</div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Control de Estabilidad</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{!! $auto->seguridad->control_estabilidad ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>' !!}</div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Asistente de Frenado</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{!! $auto->seguridad->asistente_frenado ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>' !!}</div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Cámara de Reversa</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{!! $auto->seguridad->camara_reversa ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>' !!}</div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Confort -->
        <div class="comparison__section">
            <h2 class="comparison__title">Confort</h2>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Aire Acondicionado</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{!! $auto->confort->aire_acondicionado ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>' !!}</div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Climatizador</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{!! $auto->confort->climatizador ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>' !!}</div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Asientos Calefactables</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{!! $auto->confort->asientos_calefactables ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>' !!}</div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Asientos Eléctricos</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{!! $auto->confort->asientos_electricos ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>' !!}</div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Techo Solar</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{!! $auto->confort->techo_solar ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>' !!}</div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Entretenimiento -->
        <div class="comparison__section">
            <h2 class="comparison__title">Entretenimiento</h2>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Sistema de Infotenimiento</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{{ $auto->entretenimiento->sistema_infotainment }}</div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Pantalla Principal (pulgadas)</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">
                            {{ $auto->entretenimiento->pantalla_principal }}"
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Sistema de Sonido</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{{ $auto->entretenimiento->sistema_sonido }}</div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Número de Parlantes</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">
                            {{ $auto->entretenimiento->numero_parlantes }}
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Bluetooth</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{!! $auto->entretenimiento->bluetooth ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>' !!}</div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Android Auto</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{!! $auto->entretenimiento->android_auto ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>' !!}</div>
                    @endforeach
                </div>
            </div>
            
            <div class="comparison__feature">
                <h3 class="comparison__feature-header">Apple CarPlay</h3>
                <div class="comparison__feature-values">
                    @foreach($autos as $auto)
                        <div class="comparison__feature-value">{!! $auto->entretenimiento->apple_carplay ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>' !!}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p class="mb-0">CarWizard © 2025 - Todos los derechos reservados</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 