<?php 
// Mostrar errores (solo para desarrollo)
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__. ('/../../includes/database/dbMedicable.php');


// Verificar conexión
if (!$dbMedicable) {
    die("Error de conexión a la base de datos");
}

// Consulta para obtener los médicos
$query = "SELECT Nombre, Especialidad, Alcaldia, Direccion, Estado, Tel, Extension, Latitud, Longitud FROM medicos";
$result = mysqli_query($dbMedicable, $query);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($dbMedicable));
}

$medicos = array();
while($row = mysqli_fetch_assoc($result)) {
    $medicos[] = $row;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directorio Médico - Especialistas en Diabetes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://use.typekit.net/your-acumin-id.css"> <!-- Reemplaza con tu ID de Adobe Fonts -->
    <style>
        body {
            font-family: 'acumin-variable', sans-serif;
            font-variation-settings: 'wght' 400;
            background-color: #f8f9fa;
            color: #263f48;
        }
        .header {
            background: linear-gradient(135deg, #3e9dd5 0%, #4ca8d1 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .header h1 {
            font-variation-settings: 'wght' 700;
            letter-spacing: -0.5px;
        }
        .filter-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 1.8rem;
            margin-bottom: 2rem;
            border: none;
        }
        .filter-card h4 {
            color: #263f48;
            font-variation-settings: 'wght' 600;
            margin-bottom: 1.5rem;
        }
        .medico-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 1.8rem;
            margin-bottom: 1.8rem;
            transition: all 0.3s ease;
            border: none;
            border-left: 4px solid #3e9dd5;
        }
        .medico-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
        }
        .especialidad-badge {
            background-color: #3e9dd5;
            color: white;
            font-variation-settings: 'wght' 500;
            padding: 0.35rem 0.7rem;
            border-radius: 20px;
        }
        .diabetes-badge {
            background-color: #eb9022;
            color: white;
        }
        #map {
            height: 500px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0,0,0,0.1);
        }
        .medico-name {
            color: #263f48;
            font-variation-settings: 'wght' 650;
            margin-bottom: 0.5rem;
        }
        .contact-info {
            margin-top: 1rem;
        }
        .btn-primary {
            background-color: #4ca8d1;
            border-color: #4ca8d1;
            font-variation-settings: 'wght' 500;
            padding: 0.5rem 1.5rem;
        }
        .btn-primary:hover {
            background-color: #3e9dd5;
            border-color: #3e9dd5;
        }
        .btn-outline-secondary {
            font-variation-settings: 'wght' 500;
            padding: 0.5rem 1.5rem;
        }
        .form-select, .form-control {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-variation-settings: 'wght' 400;
            border: 1px solid rgba(0,0,0,0.1);
        }
        .stat-number {
            font-variation-settings: 'wght' 600;
            color: #4ca8d1;
            font-size: 1.2rem;
        }
        .section-title {
            font-variation-settings: 'wght' 650;
            color: #263f48;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.5rem;
        }
        .section-title:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 60px;
            height: 3px;
            background: #eb9022;
        }
        .no-results {
            background-color: #f8f9fa;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            color: #6c757d;
        }
        .map-container {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
        }
        .map-overlay {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1000;
            background: white;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            font-variation-settings: 'wght' 500;
        }
    </style>
</head>
<?php include('includes/authModal.php');?>
<body>
    <div class="header text-center">
        <div class="container">
            <h1>Directorio de Especialistas Médicos</h1>
            <p class="lead" style="font-variation-settings: 'wght' 450;">Encuentra los mejores especialistas en diabetes y otras áreas</p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="filter-card">
                    <h4>Filtrar médicos</h4>
                    <div class="mb-3">
                        <label for="especialidad" class="form-label" style="font-variation-settings: 'wght' 500;">Especialidad</label>
                        <select class="form-select" id="especialidad">
                            <option value="">Todas las especialidades</option>
                            <option value="Diabetes" selected>Diabetes</option>
                            <!-- Otras especialidades se cargarán dinámicamente -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label" style="font-variation-settings: 'wght' 500;">Estado</label>
                        <select class="form-select" id="estado">
                            <option value="">Todos los estados</option>
                            <!-- Los estados se cargarán dinámicamente -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="alcaldia" class="form-label" style="font-variation-settings: 'wght' 500;">Alcaldía/Municipio</label>
                        <select class="form-select" id="alcaldia">
                            <option value="">Todas las alcaldías</option>
                            <!-- Las alcaldías se cargarán dinámicamente -->
                        </select>
                    </div>
                    <button id="filtrarBtn" class="btn btn-primary w-100 mt-2">Aplicar filtros</button>
                    <button id="resetBtn" class="btn btn-outline-secondary w-100 mt-2">Reiniciar filtros</button>
                </div>
                
                <div class="filter-card">
                    <h4>Estadísticas</h4>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total de médicos:</span>
                        <span class="stat-number" id="totalMedicos">0</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Especialistas en diabetes:</span>
                        <span class="stat-number" id="totalDiabetes">0</span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="section-title">Resultados</h4>
                    <div id="contadorResultados" class="badge bg-primary" style="font-variation-settings: 'wght' 500; background-color: #4ca8d1 !important;">0 médicos encontrados</div>
                </div>
                
                <div id="listaMedicos">
                    <!-- Los médicos se cargarán aquí -->
                </div>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-12">
                <h4 class="section-title">Ubicación de médicos</h4>
                <div class="map-container">
                    <div id="map"></div>
                    <div class="map-overlay">
                        <span id="map-counter">0</span> ubicaciones mostradas
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include('../includes/banner.php');?>

<?php include('includes/footer.php');?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Datos de médicos desde PHP
        const medicos = <?php echo json_encode($medicos); ?>;
        
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar variables
            let map;
            let markers = [];
            
            // Cargar filtros
            cargarFiltros();
            
            // Mostrar todos los médicos inicialmente
            filtrarMedicos();
            
            // Inicializar mapa
            initMap();
            
            // Event listeners
            document.getElementById('filtrarBtn').addEventListener('click', filtrarMedicos);
            document.getElementById('resetBtn').addEventListener('click', function() {
                document.getElementById('especialidad').value = 'Diabetes';
                document.getElementById('estado').value = '';
                document.getElementById('alcaldia').value = '';
                filtrarMedicos();
            });
            
            // Cuando cambia el estado, actualizar las alcaldías disponibles
            document.getElementById('estado').addEventListener('change', function() {
                actualizarAlcaldias();
            });
            
            // Función para cargar los filtros con datos dinámicos
            function cargarFiltros() {
                const especialidades = new Set();
                const estados = new Set();
                const alcaldias = new Set();
                
                medicos.forEach(medico => {
                    if (medico.Especialidad) especialidades.add(medico.Especialidad);
                    if (medico.Estado) estados.add(medico.Estado);
                    if (medico.Alcaldia) alcaldias.add(medico.Alcaldia);
                });
                
                // Ordenar y agregar especialidades
                const selectEspecialidad = document.getElementById('especialidad');
                Array.from(especialidades).sort().forEach(especialidad => {
                    if (especialidad !== 'Diabetes') {
                        const option = document.createElement('option');
                        option.value = especialidad;
                        option.textContent = especialidad;
                        selectEspecialidad.appendChild(option);
                    }
                });
                
                // Ordenar y agregar estados
                const selectEstado = document.getElementById('estado');
                Array.from(estados).sort().forEach(estado => {
                    const option = document.createElement('option');
                    option.value = estado;
                    option.textContent = estado;
                    selectEstado.appendChild(option);
                });
                
                // Estadísticas
                document.getElementById('totalMedicos').textContent = medicos.length;
                const totalDiabetes = medicos.filter(m => m.Especialidad === 'Diabetes').length;
                document.getElementById('totalDiabetes').textContent = totalDiabetes;
            }
            
            // Función para actualizar las alcaldías basado en el estado seleccionado
            function actualizarAlcaldias() {
                const estadoSeleccionado = document.getElementById('estado').value;
                const selectAlcaldia = document.getElementById('alcaldia');
                
                // Limpiar opciones excepto la primera
                while (selectAlcaldia.options.length > 1) {
                    selectAlcaldia.remove(1);
                }
                
                if (estadoSeleccionado) {
                    const alcaldiasFiltradas = new Set();
                    
                    medicos.forEach(medico => {
                        if (medico.Estado === estadoSeleccionado && medico.Alcaldia) {
                            alcaldiasFiltradas.add(medico.Alcaldia);
                        }
                    });
                    
                    // Ordenar y agregar alcaldías
                    Array.from(alcaldiasFiltradas).sort().forEach(alcaldia => {
                        const option = document.createElement('option');
                        option.value = alcaldia;
                        option.textContent = alcaldia;
                        selectAlcaldia.appendChild(option);
                    });
                }
            }
            
            // Función para filtrar médicos
            function filtrarMedicos() {
                const especialidad = document.getElementById('especialidad').value;
                const estado = document.getElementById('estado').value;
                const alcaldia = document.getElementById('alcaldia').value;
                
                const medicosFiltrados = medicos.filter(medico => {
                    return (!especialidad || medico.Especialidad === especialidad) &&
                           (!estado || medico.Estado === estado) &&
                           (!alcaldia || medico.Alcaldia === alcaldia);
                });
                
                mostrarMedicos(medicosFiltrados);
                actualizarMapa(medicosFiltrados);
                document.getElementById('contadorResultados').textContent = `${medicosFiltrados.length} ${medicosFiltrados.length === 1 ? 'médico encontrado' : 'médicos encontrados'}`;
            }
            
            // Función para mostrar los médicos en la lista
            function mostrarMedicos(medicos) {
                const listaMedicos = document.getElementById('listaMedicos');
                listaMedicos.innerHTML = '';
                
                if (medicos.length === 0) {
                    listaMedicos.innerHTML = `
                        <div class="no-results">
                            <i class="bi bi-search" style="font-size: 2rem; color: #4ca8d1;"></i>
                            <h5 style="font-variation-settings: 'wght' 600; margin-top: 1rem;">No se encontraron resultados</h5>
                            <p>Intenta ajustar tus filtros de búsqueda</p>
                        </div>
                    `;
                    return;
                }
                
                medicos.forEach(medico => {
                    const card = document.createElement('div');
                    card.className = 'medico-card';
                    
                    let badgeClass = 'especialidad-badge';
                    if (medico.Especialidad === 'Diabetes') {
                        badgeClass = 'diabetes-badge';
                    }
                    
                    card.innerHTML = `
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="medico-name">${medico.Nombre || 'Nombre no disponible'}</h5>
                                <span class="badge ${badgeClass}">${medico.Especialidad || 'Sin especialidad'}</span>
                            </div>
                            <div class="text-end">
                                <small class="text-muted">${medico.Estado || ''}${medico.Alcaldia ? ', ' + medico.Alcaldia : ''}</small>
                            </div>
                        </div>
                        <div class="mt-3">
                            <p class="mb-2"><strong style="font-variation-settings: 'wght' 600;">Dirección:</strong> ${medico.Direccion || 'No disponible'}</p>
                        </div>
                        <div class="contact-info">
                            <p class="mb-1"><strong style="font-variation-settings: 'wght' 600;">Teléfono:</strong> ${medico.Tel ? medico.Tel + (medico.Extension ? ' Ext. ' + medico.Extension : '') : 'No disponible'}</p>
                        </div>
                    `;
                    
                    listaMedicos.appendChild(card);
                });
            }
            
            // Función para inicializar el mapa
            function initMap() {
                // Centro inicial del mapa (puedes ajustar estas coordenadas)
                map = L.map('map').setView([19.4326, -99.1332], 12); // Centro en CDMX por defecto
                
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
            }
            
            // Función para actualizar los marcadores en el mapa
            function actualizarMapa(medicos) {
                // Limpiar marcadores anteriores
                markers.forEach(marker => map.removeLayer(marker));
                markers = [];
                
                if (medicos.length === 0) {
                    document.getElementById('map-counter').textContent = '0';
                    return;
                }
                
                // Contador de ubicaciones válidas
                let ubicacionesValidas = 0;
                
                // Agregar nuevos marcadores
                medicos.forEach(medico => {
                    if (medico.Latitud && medico.Longitud) {
                        const lat = parseFloat(medico.Latitud);
                        const lng = parseFloat(medico.Longitud);
                        
                        if (!isNaN(lat) && !isNaN(lng)) {
                            const iconColor = medico.Especialidad === 'Diabetes' ? '#eb9022' : '#4ca8d1';
                            
                            const customIcon = L.divIcon({
                                className: 'custom-marker',
                                html: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="${iconColor}" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>`,
                                iconSize: [24, 24],
                                iconAnchor: [12, 24],
                                popupAnchor: [0, -24]
                            });
                            
                            const marker = L.marker([lat, lng], {icon: customIcon}).addTo(map)
                                .bindPopup(`
                                    <div style="font-family: 'acumin-variable', sans-serif; font-variation-settings: 'wght' 400;">
                                        <h6 style="font-variation-settings: 'wght' 650; margin-bottom: 0.5rem; color: #263f48;">${medico.Nombre || 'Médico'}</h6>
                                        <span class="badge ${medico.Especialidad === 'Diabetes' ? 'diabetes-badge' : 'especialidad-badge'}" style="margin-bottom: 0.5rem; display: inline-block;">${medico.Especialidad || ''}</span>
                                        <p style="margin-bottom: 0.3rem;"><strong>Dirección:</strong> ${medico.Direccion || ''}</p>
                                        <p style="margin-bottom: 0;"><strong>Teléfono:</strong> ${medico.Tel ? medico.Tel + (medico.Extension ? ' Ext. ' + medico.Extension : '') : 'No disponible'}</p>
                                    </div>
                                `);
                            
                            markers.push(marker);
                            ubicacionesValidas++;
                        }
                    }
                });
                
                // Actualizar contador de mapa
                document.getElementById('map-counter').textContent = ubicacionesValidas;
                
                // Ajustar la vista del mapa para mostrar todos los marcadores
                if (markers.length > 0) {
                    const group = new L.featureGroup(markers);
                    map.fitBounds(group.getBounds());
                }
            }
        });
    </script>
</body>
</html>