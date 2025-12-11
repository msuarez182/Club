<?php 
// Mostrar errores (solo para desarrollo)
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__. ('/../../includes/database/dbMedicable.php');

// Verificar conexión
if (!$dbMedicable) {
    die("Error de conexión a la base de datos");
}

// Consulta para obtener los hospitales
$query = "SELECT NOMBRE, Alcaldia, DOMICILIO, ESTADO, TELEFONO, Lat, Lon FROM hospitales";
$result = mysqli_query($dbMedicable, $query);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($dbMedicable));
}

$hospitales = array();
while($row = mysqli_fetch_assoc($result)) {
    $hospitales[] = $row;
}

// Consultas para los filtros
$estados = array();
$alcaldias = array();

$queryEstados = "SELECT DISTINCT ESTADO FROM hospitales WHERE ESTADO IS NOT NULL ORDER BY ESTADO";
$resultEstados = mysqli_query($dbMedicable, $queryEstados);
while($row = mysqli_fetch_assoc($resultEstados)) {
    $estados[] = $row['ESTADO'];
}

$queryAlcaldias = "SELECT DISTINCT Alcaldia FROM hospitales WHERE Alcaldia IS NOT NULL ORDER BY Alcaldia";
$resultAlcaldias = mysqli_query($dbMedicable, $queryAlcaldias);
while($row = mysqli_fetch_assoc($resultAlcaldias)) {
    $alcaldias[] = $row['Alcaldia'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directorio de Hospitales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        #map {
            height: 500px;
            width: 100%;
            border-radius: 8px;
            z-index: 1;
        }
        .map-container {
            position: relative;
            margin-bottom: 20px;
        }
        .map-overlay {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1000;
            background: white;
            padding: 5px 10px;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            font-size: 14px;
        }
        .hospital-card {
            transition: all 0.3s ease;
            margin-bottom: 15px;
        }
        .hospital-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .no-results {
            padding: 40px 0;
            text-align: center;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <?php include('includes/authModal.php'); ?>
    
    <div class="bg-primary text-white text-center py-5 mb-4">
        <div class="container">
            <h1 class="fw-bold">Directorio de Hospitales</h1>
            <p class="lead">Encuentra hospitales en tu área</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title text-primary mb-4">Filtrar hospitales</h4>
                        
                        <div class="mb-3">
                            <label for="busqueda" class="form-label">Búsqueda</label>
                            <input type="text" class="form-control" id="busqueda" placeholder="Nombre, dirección o teléfono">
                        </div>
                        
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado">
                                <option value="">Todos los estados</option>
                                <?php foreach($estados as $estado): ?>
                                    <option value="<?php echo htmlspecialchars($estado); ?>"><?php echo htmlspecialchars($estado); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="alcaldia" class="form-label">Alcaldía/Municipio</label>
                            <select class="form-select" id="alcaldia">
                                <option value="">Todas las alcaldías</option>
                                <?php foreach($alcaldias as $alcaldia): ?>
                                    <option value="<?php echo htmlspecialchars($alcaldia); ?>"><?php echo htmlspecialchars($alcaldia); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <button id="filtrarBtn" class="btn btn-primary w-100 mt-2">Aplicar filtros</button>
                        <button id="resetBtn" class="btn btn-outline-secondary w-100 mt-2">Reiniciar filtros</button>
                    </div>
                </div>
                
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title text-primary mb-4">Estadísticas</h4>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total de hospitales:</span>
                            <span class="fw-bold" id="totalHospitales"><?php echo count($hospitales); ?></span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Mostrando:</span>
                            <span class="fw-bold" id="mostrandoHospitales"><?php echo count($hospitales); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="text-primary">Resultados</h4>
                    <span id="contadorResultados" class="badge bg-primary"><?php echo count($hospitales); ?> hospitales encontrados</span>
                </div>
                
                <div id="listaHospitales">
                    <?php foreach($hospitales as $hospital): ?>
                    <div class="card hospital-card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="card-title"><?php echo htmlspecialchars($hospital['NOMBRE']); ?></h5>
                                    <span class="badge bg-primary">Hospital</span>
                                </div>
                                <div class="text-end">
                                    <small class="text-muted">
                                        <?php echo htmlspecialchars($hospital['ESTADO']); ?>
                                        <?php if(!empty($hospital['Alcaldia'])): ?>
                                        , <?php echo htmlspecialchars($hospital['Alcaldia']); ?>
                                        <?php endif; ?>
                                    </small>
                                </div>
                            </div>
                            <div class="mt-3">
                                <p class="mb-2"><strong>Dirección:</strong> <?php echo htmlspecialchars($hospital['DOMICILIO']); ?></p>
                            </div>
                            <div class="contact-info">
                                <p class="mb-1"><strong>Teléfono:</strong> <?php echo htmlspecialchars($hospital['TELEFONO']); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-12">
                <h4 class="text-primary mb-3">Ubicación de hospitales</h4>
                <div class="map-container shadow-sm">
                    <div id="map"></div>
                    <div class="map-overlay">
                        <span id="map-counter"><?php echo count($hospitales); ?></span> ubicaciones mostradas
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Datos completos de hospitales desde PHP
        const hospitales = <?php echo json_encode($hospitales); ?>;
        let map;
        let markers = [];
        
        // Objeto para mapear alcaldías por estado
        const alcaldiasPorEstado = {};
        
        // Preprocesar datos para crear estructura estado -> alcaldías
        hospitales.forEach(hospital => {
            if (hospital.ESTADO && hospital.Alcaldia) {
                if (!alcaldiasPorEstado[hospital.ESTADO]) {
                    alcaldiasPorEstado[hospital.ESTADO] = new Set();
                }
                alcaldiasPorEstado[hospital.ESTADO].add(hospital.Alcaldia);
            }
        });

        // Inicializar el mapa
        function initMap() {
            // Configuración inicial centrada en CDMX
            map = L.map('map').setView([19.4326, -99.1332], 12);
            
            // Capa del mapa base
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            
            // Agregar marcadores iniciales
            updateMap(hospitales);
        }

        // Actualizar marcadores en el mapa
        function updateMap(hospitalesMostrados) {
            // Limpiar marcadores anteriores
            markers.forEach(marker => map.removeLayer(marker));
            markers = [];
            
            let ubicacionesValidas = 0;
            
            hospitalesMostrados.forEach(hospital => {
                if (hospital.Lat && hospital.Lon) {
                    const lat = parseFloat(hospital.Lat);
                    const lng = parseFloat(hospital.Lon);
                    
                    if (!isNaN(lat) && !isNaN(lng)) {
                        const marker = L.marker([lat, lng]).addTo(map)
                            .bindPopup(`
                                <div style="max-width: 250px;">
                                    <h6 style="font-weight: 600; margin-bottom: 5px;">${hospital.NOMBRE || 'Hospital'}</h6>
                                    <p style="margin-bottom: 3px;"><strong>Dirección:</strong> ${hospital.DOMICILIO || 'No disponible'}</p>
                                    <p style="margin-bottom: 0;"><strong>Teléfono:</strong> ${hospital.TELEFONO || 'No disponible'}</p>
                                </div>
                            `);
                        
                        markers.push(marker);
                        ubicacionesValidas++;
                    }
                }
            });
            
            // Actualizar contador
            document.getElementById('map-counter').textContent = ubicacionesValidas;
            
            // Ajustar vista del mapa si hay marcadores
            if (markers.length > 0) {
                const group = new L.featureGroup(markers);
                map.fitBounds(group.getBounds());
            }
        }

        // Actualizar opciones de alcaldías según estado seleccionado
        function actualizarAlcaldias() {
            const estadoSeleccionado = document.getElementById('estado').value;
            const selectAlcaldia = document.getElementById('alcaldia');
            
            // Limpiar opciones excepto la primera
            while (selectAlcaldia.options.length > 1) {
                selectAlcaldia.remove(1);
            }
            
            // Si hay estado seleccionado y tiene alcaldías
            if (estadoSeleccionado && alcaldiasPorEstado[estadoSeleccionado]) {
                const alcaldiasOrdenadas = Array.from(alcaldiasPorEstado[estadoSeleccionado]).sort();
                
                alcaldiasOrdenadas.forEach(alcaldia => {
                    const option = document.createElement('option');
                    option.value = alcaldia;
                    option.textContent = alcaldia;
                    selectAlcaldia.appendChild(option);
                });
            }
        }

        // Filtrar hospitales según criterios
        function filtrarHospitales() {
            const busqueda = document.getElementById('busqueda').value.toLowerCase();
            const estado = document.getElementById('estado').value;
            const alcaldia = document.getElementById('alcaldia').value;
            
            const resultados = hospitales.filter(hospital => {
                // Filtro por búsqueda
                const cumpleBusqueda = !busqueda || 
                    (hospital.NOMBRE && hospital.NOMBRE.toLowerCase().includes(busqueda)) ||
                    (hospital.DOMICILIO && hospital.DOMICILIO.toLowerCase().includes(busqueda)) ||
                    (hospital.TELEFONO && hospital.TELEFONO.toLowerCase().includes(busqueda));
                
                // Filtro por estado
                const cumpleEstado = !estado || hospital.ESTADO === estado;
                
                // Filtro por alcaldía
                const cumpleAlcaldia = !alcaldia || hospital.Alcaldia === alcaldia;
                
                return cumpleBusqueda && cumpleEstado && cumpleAlcaldia;
            });
            
            mostrarResultados(resultados);
            updateMap(resultados);
        }

        // Mostrar resultados en la lista
        function mostrarResultados(resultados) {
            const lista = document.getElementById('listaHospitales');
            lista.innerHTML = '';
            
            if (resultados.length === 0) {
                lista.innerHTML = `
                    <div class="no-results">
                        <i class="bi bi-search" style="font-size: 2rem; color: #4ca8d1;"></i>
                        <h5 style="margin-top: 1rem;">No se encontraron resultados</h5>
                        <p>Intenta ajustar tus filtros de búsqueda</p>
                    </div>
                `;
            } else {
                resultados.forEach(hospital => {
                    const card = document.createElement('div');
                    card.className = 'card hospital-card shadow-sm';
                    card.innerHTML = `
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="card-title">${hospital.NOMBRE || 'Nombre no disponible'}</h5>
                                    <span class="badge bg-primary">Hospital</span>
                                </div>
                                <div class="text-end">
                                    <small class="text-muted">
                                        ${hospital.ESTADO || ''}
                                        ${hospital.Alcaldia ? ', ' + hospital.Alcaldia : ''}
                                    </small>
                                </div>
                            </div>
                            <div class="mt-3">
                                <p class="mb-2"><strong>Dirección:</strong> ${hospital.DOMICILIO || 'No disponible'}</p>
                            </div>
                            <div class="contact-info">
                                <p class="mb-1"><strong>Teléfono:</strong> ${hospital.TELEFONO || 'No disponible'}</p>
                            </div>
                        </div>
                    `;
                    lista.appendChild(card);
                });
            }
            
            // Actualizar contadores
            document.getElementById('contadorResultados').textContent = 
                `${resultados.length} ${resultados.length === 1 ? 'hospital encontrado' : 'hospitales encontrados'}`;
            document.getElementById('mostrandoHospitales').textContent = resultados.length;
        }

        // Inicializar cuando el DOM esté listo
        document.addEventListener('DOMContentLoaded', function() {
            initMap();
            
            // Event listeners
            document.getElementById('filtrarBtn').addEventListener('click', filtrarHospitales);
            
            document.getElementById('resetBtn').addEventListener('click', function() {
                document.getElementById('busqueda').value = '';
                document.getElementById('estado').value = '';
                document.getElementById('alcaldia').value = '';
                filtrarHospitales();
            });
            
            // Actualizar alcaldías cuando cambia el estado
            document.getElementById('estado').addEventListener('change', function() {
                actualizarAlcaldias();
                filtrarHospitales(); // Filtramos automáticamente al cambiar estado
            });
            
            // Filtrar al presionar Enter en búsqueda
            document.getElementById('busqueda').addEventListener('keyup', function(e) {
                if (e.key === 'Enter') filtrarHospitales();
            });
            
            // Mostrar todos los hospitales inicialmente
            filtrarHospitales();
        });
    </script>
</body>
</html>