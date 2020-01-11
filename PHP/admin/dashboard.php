<?php
        ob_start(); //Se guardan las cabeceras en el buffer del documento para que no de error al enviar el header de cerrar sesión.
        session_start();
        include('../config/conection.php');
        $consultaeropuertos="SELECT DISTINCT(codaer), nombre FROM aeropuerto;";
        $result=$connection->query($consultaeropuertos);
        $contenido = "";
                    while($obj = $result->fetch_object()) {
                    $consultavuelos="SELECT codvuelo FROM vuelo WHERE codaerori='$obj->codaer' OR codaerdes='$obj->codaer';";
                    $result2=$connection->query($consultavuelos);
                    $nvuelos=$result2->num_rows;
                    if($contenido != ""){
          $contenido .= ', ';
        }
             $contenido.= '["'.$obj->nombre.'", '.$nvuelos.']';
                    }
        $consultaplazas="SELECT capacidad from vuelo;";
        $result3=$connection->query($consultaplazas);
        $nplazas="";
        while($obj2 = $result3->fetch_object()) {
            $nplazas=$nplazas+($obj2->capacidad);
        }
        $contenido2 = "";
        $consultadisponibles="SELECT libres from vuelo;";
        $result4=$connection->query($consultadisponibles);
        $nlibres="";
        while($obj3 = $result4->fetch_object()) {
            $nlibres=$nlibres+($obj3->libres);
        }
        $ocupadas=$nplazas - $nlibres;
             $contenido2.='["'."Libres".'", '.$nlibres.'],["'."Ocupadas".'", '.$ocupadas.', '."".']';
                    
?>

    <!DOCTYPE html>
    <html lang="Spanish">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Cache-Control" content="no-store" />
        <title>Airline</title>
        <link rel="stylesheet" href="../styles/estilos.css">
        <link rel="stylesheet" href="../styles/css/bootstrap.css">
        <script src="../styles/js/bootstrap.js"></script>
        <script src="../styles/js/jquery.js"></script>
        <!--Load the AJAX API-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            // Load the Visualization API and the corechart package.
            google.charts.load('current', {
                'packages': ['bar', 'corechart', 'bar']
            });

            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);
            google.charts.setOnLoadCallback(drawStuff);
            google.charts.setOnLoadCallback(drawChart2);
            google.charts.setOnLoadCallback(drawBarChart);


            // Callback that creates and populates a data table,
            // instantiates the pie chart, passes in the data and
            // draws it.
            function drawChart() {

                // Create the data table.
                var data = google.visualization.arrayToDataTable([
                    ['Aeropuerto', 'Vuelos'],
                    <?php
          echo $contenido;
        ?>
                ]);

                // Set chart options
                var options = {
                    'title': 'Vuelos por aeropuerto',
                    'width': 360,
                    'height': 300,
                };

                // Instantiate and draw our chart, passing in some options.
                var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }

            function drawStuff() {
                var data = new google.visualization.arrayToDataTable([
                    ['Aeropuertos', 'Vuelos'],
                    <?php
          echo $contenido;
           ?>
                ]);
                var options2 = {
                    title: 'Vuelos por Aeropuerto',
                    width: 360,
                    height: 300,
                    legend: {
                        position: 'none'
                    },
                    chart: {},
                    bars: 'vertical', // Required for Material Bar Charts.
                    axes: {
                        x: {
                            0: {
                                side: 'top',
                                label: 'Vuelos por Aeropuertos'
                            } // Top x-axis.
                        }
                    },
                    bar: {
                        groupWidth: "90%"
                    }
                };
                var chart = new google.charts.Bar(document.getElementById('top_x_div'));
                chart.draw(data, options2);
            };

            function drawChart2() {

                // Create the data table.
                var data = google.visualization.arrayToDataTable([
                    ['Aeropuerto', 'Vuelos'],
                    <?php
          echo $contenido2;
        ?>
                ]);

                // Set chart options
                var options3 = {
                    title: 'Plazas',
                    width: 360,
                    height: 300,
                    pieHole: 0.4,
                };

                // Instantiate and draw our chart, passing in some options.
                var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));
                chart.draw(data, options3);
            }

            function drawBarChart() {

                // Create the data table.
                var data = google.visualization.arrayToDataTable([
                    ['Libres', 'Plazas'],
                    <?php
          echo $contenido2;
        ?>
                ]);

                // Set chart options
                var options4 = {
                    title: 'Plazas',
                    width: 360,
                    height: 300,
                    chartArea: {
                        width: '50%'
                    },
                    hAxis: {
                        title: 'Libres',
                        minValue: 0
                    },
                    vAxis: {
                        title: 'Cantidad'
                    }
                };

                // Instantiate and draw our chart, passing in some options.
                var chart = new google.visualization.BarChart(document.getElementById('bar_div'));
                chart.draw(data, options4);
            }

        </script>
    </head>

    <body>
        <div class="container-fluid" id="colorfondo">
            <div class="row" style="height:5%;"></div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="container-fluid recuadro margin1">
                        <div class="row">
                            <?php
         include('../config/head.php');
         include('../config/compruebausuario.php');
         ?>
                        </div>
                        <div class="row">
                            <nav class="navbar navbar-default">
                                <div class="navbar-header"> <a class="navbar-brand">Administrador</a> </div>
                                <ul class="nav navbar-nav">
                                    <li><a href="/admin/datosaeropuertos.php">Aeropuertos</a></li>
                                    <li><a href="/admin/addaeropuerto.php">Añadir aeropuerto</a></li>
                                    <li><a href="/admin/homeadministrador.php">Vuelos</a></li>
                                    <li><a href="/admin/addvuelo.php">Añadir vuelo</a></li>
                                    <li><a href="/admin/datosclientes.php">Clientes</a></li>
                                    <li><a href="/admin/addcliente.php">Añadir cliente</a></li>
                                    <li><a href="/admin/datosreservas.php">Reservas</a></li>
                                    <li class="active"><a href="/admin/dashboard.php">Dashboards</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div id="chart_div"></div>
                            </div>
                            <div class="col-md-6">
                                <div id="top_x_div"></div>
                            </div>
                        </div>
                        </br>
                        <div class="row">
                            <div class="col-md-6">
                                <div id="chart_div2"></div>
                            </div>
                            <div class="col-md-6">
                                <div id="bar_div"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
    <?php
include('../config/footer.php');
ob_end_flush();
?>

    </html>
