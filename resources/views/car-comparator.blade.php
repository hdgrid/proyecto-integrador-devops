<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Comparador de Autos - CarWizard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/car-comparator.css') }}" rel="stylesheet">
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="https://via.placeholder.com/150x40/4366e6/ffffff?text=CarWizard" alt="CarWizard">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Comparador</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <button class="btn text-white"><i class="fas fa-user"></i></button>
                </div>
            </div>
        </div>
    </nav>

    <!-- breadcrumb y header -->
    <section class="header-section">
        <div class="container">            
            <h1 class="text-center mb-3">Comparador de Autos</h1>
            <p class="text-center">Compara equipo, precios, y ficha técnica de diversos modelos de autos.</p>
        </div>
    </section>

    <!-- seccion de comparador -->
    <section class="comparator-section">
        <div class="container">
            <!-- selectores -->
            <div class="row selector-container">
                <div class="col-md-4 mb-3">
                    <label class="selector__label">Marca</label>
                    <select class="form-select car-selector marca-select" data-car-position="1">
                        <option value="">Seleccionar marca...</option>
                        @foreach($marcas as $marca)
                            <option value="{{ $marca }}">{{ $marca }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="selector__label">Modelo</label>
                    <select class="form-select car-selector modelo-select" data-car-position="1" disabled>
                        <option value="">Seleccionar modelo...</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="selector__label">Versión</label>
                    <select class="form-select car-selector version-select" data-car-position="1" disabled>
                        <option value="">Seleccionar versión...</option>
                    </select>
                </div>
            </div>

            <!-- cards de autos -->
            <div class="row" id="car-cards-container">
                <div class="col-md-4">
                    <div class="car-card active" id="car-card-1" data-position="1">
                        <div class="car-number">1/3</div>
                        <div class="car-info text-center">
                            <img src="{{ asset('storage/uploads/placeholder-auto.png') }}" alt="Auto" class="img-fluid">
                            <h4 class="car-title mt-3">Selecciona un auto</h4>
                            <p class="car-subtitle">-</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="car-card" id="car-card-2" data-position="2">
                        <div class="car-number">2/3</div>
                        <div class="car-info text-center">
                            <img src="{{ asset('storage/uploads/placeholder-auto.png') }}" alt="Auto" class="img-fluid">
                            <h4 class="car-title mt-3">Selecciona un auto</h4>
                            <p class="car-subtitle">-</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="car-card" id="car-card-3" data-position="3">
                        <div class="car-number">3/3</div>
                        <div class="car-info text-center">
                            <img src="{{ asset('storage/uploads/placeholder-auto.png') }}" alt="Auto" class="img-fluid">
                            <h4 class="car-title mt-3">Selecciona un auto</h4>
                            <p class="car-subtitle">-</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Boton para comparar -->
            <div class="text-center mt-4">
                <button class="btn btn-primary compare-btn" id="compare-btn" disabled>Comparar</button>
            </div>

            <!-- Tabla de comparación -->
            <div class="comparison-table mt-5" id="comparison-table" style="display: none;">
                <!-- La tabla se llenará dinámicamente con JavaScript -->
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4 footer">
        <div class="container text-center">
            <p class="mb-0">CarWizard © 2025 - Todos los derechos reservados</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let currentPosition = 1;
            let selectedCars = {};

            function activateNextPosition() {
                if (currentPosition < 3) {
                    currentPosition++;
                    updateSelectors();
                    updateCardStates();
                }
            }

            function updateSelectors() {
                // Clonar los selectores del primer auto
                let newSelectors = $('.selector-container').first().clone();
                
                // Actualizar los atributos
                newSelectors.find('select').each(function() {
                    $(this).attr('data-car-position', currentPosition);
                    $(this).val('');
                    if (!$(this).hasClass('marca-select')) {
                        $(this).prop('disabled', true);
                    }
                });

                // Reemplazar los selectores actuales
                $('.selector-container').replaceWith(newSelectors);
                
                // Reactivar los event listeners
                attachEventListeners();
            }

            function updateCardStates() {
                $('.car-card').removeClass('active');
                $(`#car-card-${currentPosition}`).addClass('active');
            }

            function attachEventListeners() {
                // Evento cambio de marca
                $('.marca-select').change(function() {
                    const marca = $(this).val();
                    const carPosition = $(this).data('car-position');
                    
                    if (marca) {
                        $.ajax({
                            url: '{{ route("getModelos") }}',
                            method: 'POST',
                            data: { marca: marca },
                            success: function(modelos) {
                                let modeloSelect = $('.modelo-select');
                                modeloSelect.empty().append('<option value="">Seleccionar modelo...</option>');
                                modelos.forEach(function(modelo) {
                                    modeloSelect.append(`<option value="${modelo}">${modelo}</option>`);
                                });
                                modeloSelect.prop('disabled', false);
                                $('.version-select').prop('disabled', true).empty().append('<option value="">Seleccionar versión...</option>');
                            }
                        });
                    }
                });

                // Evento cambio de modelo
                $('.modelo-select').change(function() {
                    const marca = $('.marca-select').val();
                    const modelo = $(this).val();
                    
                    if (modelo) {
                        $.ajax({
                            url: '{{ route("getVersiones") }}',
                            method: 'POST',
                            data: { 
                                marca: marca,
                                modelo: modelo 
                            },
                            success: function(versiones) {
                                let versionSelect = $('.version-select');
                                versionSelect.empty().append('<option value="">Seleccionar versión...</option>');
                                versiones.forEach(function(version) {
                                    versionSelect.append(`<option value="${version.id}">${version.version}</option>`);
                                });
                                versionSelect.prop('disabled', false);
                            }
                        });
                    }
                });

                // Evento cambio de versión
                $('.version-select').change(function() {
                    const autoId = $(this).val();
                    
                    if (autoId) {
                        $.ajax({
                            url: '{{ route("getAutoDetalle") }}',
                            method: 'POST',
                            data: { auto_id: autoId },
                            success: function(auto) {
                                selectedCars[currentPosition] = auto;
                                updateCarCard(auto, currentPosition);
                                checkCompareButton();
                                activateNextPosition();
                            }
                        });
                    }
                });
            }

            function updateCarCard(auto, position) {
                const card = $(`#car-card-${position}`);
                card.find('.car-title').text(`${auto.marca} ${auto.modelo}`);
                card.find('.car-subtitle').text(auto.version);
            }

            function checkCompareButton() {
                const selectedCount = Object.keys(selectedCars).length;
                $('#compare-btn').prop('disabled', selectedCount < 2);
            }

            $('#compare-btn').click(function() {
                if (Object.keys(selectedCars).length >= 2) {
                    const autoIds = Object.values(selectedCars).map(car => car.id);
                    
                    // Crear un formulario temporal para hacer el POST
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route("comparacionDetallada") }}';
                    
                    // Agregar el token CSRF
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = $('meta[name="csrf-token"]').attr('content');
                    form.appendChild(csrfToken);
                    
                    // Agregar los IDs de los autos
                    autoIds.forEach(id => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'autos[]';
                        input.value = id;
                        form.appendChild(input);
                    });
                    
                    document.body.appendChild(form);
                    form.submit();
                }
            });

            function showComparison(cars) {
                let comparisonHtml = `
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Característica</th>
                                ${Object.values(cars).map(car => `<th>${car.marca} ${car.modelo} ${car.version}</th>`).join('')}
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="${Object.keys(cars).length + 1}" class="table-primary"><strong>Motor</strong></td>
                            </tr>
                            <tr>
                                <td>Tipo</td>
                                ${Object.values(cars).map(car => `<td>${car.motor.tipo}</td>`).join('')}
                            </tr>
                            <tr>
                                <td>Cilindros</td>
                                ${Object.values(cars).map(car => `<td>${car.motor.cilindros}</td>`).join('')}
                            </tr>
                            <tr>
                                <td>Potencia (HP)</td>
                                ${Object.values(cars).map(car => `<td>${car.motor.potencia}</td>`).join('')}
                            </tr>
                            <tr>
                                <td>Torque (lb-ft)</td>
                                ${Object.values(cars).map(car => `<td>${car.motor.torque}</td>`).join('')}
                            </tr>
                            <tr>
                                <td colspan="${Object.keys(cars).length + 1}" class="table-primary"><strong>Transmisión</strong></td>
                            </tr>
                            <tr>
                                <td>Tipo</td>
                                ${Object.values(cars).map(car => `<td>${car.transmision.tipo}</td>`).join('')}
                            </tr>
                            <tr>
                                <td>Tracción</td>
                                ${Object.values(cars).map(car => `<td>${car.transmision.traccion}</td>`).join('')}
                            </tr>
                            <tr>
                                <td colspan="${Object.keys(cars).length + 1}" class="table-primary"><strong>Dimensiones</strong></td>
                            </tr>
                            <tr>
                                <td>Largo (mm)</td>
                                ${Object.values(cars).map(car => `<td>${car.dimension.largo}</td>`).join('')}
                            </tr>
                            <tr>
                                <td>Ancho (mm)</td>
                                ${Object.values(cars).map(car => `<td>${car.dimension.ancho}</td>`).join('')}
                            </tr>
                            <tr>
                                <td>Alto (mm)</td>
                                ${Object.values(cars).map(car => `<td>${car.dimension.alto}</td>`).join('')}
                            </tr>
                            <tr>
                                <td>Peso (kg)</td>
                                ${Object.values(cars).map(car => `<td>${car.dimension.peso}</td>`).join('')}
                            </tr>
                        </tbody>
                    </table>
                `;

                $('#comparison-table').html(comparisonHtml).show();
                // Scroll to comparison table
                $('html, body').animate({
                    scrollTop: $("#comparison-table").offset().top
                }, 1000);
            }

            // Inicializar los event listeners
            attachEventListeners();
        });
    </script>
</body>
</html> 