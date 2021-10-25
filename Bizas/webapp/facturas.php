<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BIZAS</title>

    <link rel="stylesheet" href="css/facturas.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
    <script src="js/facturas.js"></script>
    <link rel="shortcut icon" href="pw-fotos/perrologo-modified.png">
</head>
<body>
<div class="container-fluid">
    <nav class="navbar navbar-expand-md navbar-light border-3 border-bottom border-info">
        <div class="container-fluid">
            <a href="#" class="navbar-brand"><img src="pw-fotos/perrologo.jpg" id="logo"></a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menuNavegacion">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="menuNavegacion" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-3">
                    <li class="nav-item"><a class="nav-link" href="facturas.php">Factura</a></li>
                    <li class="nav-item"><a class="nav-link" href="pagos.php">Pagos</a></li>
                    <li class="nav-item"><a class="nav-link" href="perfil.php">Perfil</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php" id="cerrarSesion">Cerrar Sesion</a> </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<div class="container" id="white"></div>

<div class="container mt-2" >
    <ul class="nav nav-tabs nav-fill mb-3">
        <li class="nav-item" > <a class="nav-link active"  id="graficas1" data-bs-toggle="tab" data-bs-target="#Luz">Luz</a></li>
        <li class="nav-item" > <a class="nav-link "        id="graficas2" data-bs-toggle="tab" data-bs-target="#Agua">Agua</a></li>
    </ul>

    <div class="tab-content" >
        <div class="tab-pane active" id="Luz">
            <div class="col p-4">
                <h3>Luz</h3>
                <canvas id="graficaLuz" width="400" height="180"></canvas>

                <script> var ctx = document.getElementById('graficaLuz').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                            datasets: [{
                                label: 'Factura de la luz mensual',
                                data: [100, 90, 80, 110, 107, 100, 93, 86, 137, 122, 90, 97],
                                backgroundColor: "rgb(91, 192, 222)",
                                borderColor: [
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>

        <div class="tab-pane" id="Agua">
            <div class="col p-4">
                <h3>Agua</h3>
                <p>
                    <canvas id="graficaAgua" width="400" height="180"></canvas>

                    <script> var ctx = document.getElementById('graficaAgua').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                                datasets: [{
                                    label: 'Factura del agua mensual',
                                    data: [30, 25, 40, 37, 24, 35, 21, 29, 39, 45, 49, 40],
                                    backgroundColor: "rgb(91, 192, 222)",
                                    borderColor: [
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>
                </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
