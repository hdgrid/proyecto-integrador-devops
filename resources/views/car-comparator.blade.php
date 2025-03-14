<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comparador de Autos - CarWizard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/car-comparator.css') }}" rel="stylesheet">
</head>

<!-- probablemente refactorizar ciertas partes para usar componentes blade -->

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
                    <label>Marca</label>
                    <select class="form-select car-selector">
                        <option value="">ARRA</option>
                        <option value="">AUDI</option>
                        <option value="">BMW</option>
                        <option value="">CHEVROLET</option>
                        <option value="">FORD</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Modelo</label>
                    <select class="form-select car-selector">
                        <option value="">Seleccionar...</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Versión</label>
                    <select class="form-select car-selector">
                        <option value="">Seleccionar...</option>
                    </select>
                </div>
            </div>

            <!-- cards de autos -->
            <div class="row">
                <div class="col-md-4">
                    <div class="car-card">
                        <div class="car-number">1/3</div>
                        <img src="{{ asset('storage/uploads/placeholder-auto.png') }}" alt="Carro 1">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="car-card">
                        <div class="car-number">2/3</div>
                        <img src="{{ asset('storage/uploads/placeholder-auto.png') }}" alt="Carro 2">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="car-card">
                        <div class="car-number">3/3</div>
                        <img src="{{ asset('storage/uploads/placeholder-auto.png') }}" alt="Carro 3">
                    </div>
                </div>
            </div>

            <!-- Boton para comparar -->
            <div class="text-center">
                <button class="btn compare-btn">Comparar</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4 footer">
        <div class="container text-center">
            <p class="mb-0">CarWizard © 2025 - Todos los derechos reservados</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html> 