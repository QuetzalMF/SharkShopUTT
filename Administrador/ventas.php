<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRADORES</title>
    <link rel="shortcut icon" href="assets/img/logo_sinfondo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/icons/font/bootstrap-icons.css">
</head>

<body>
    <?php
    session_start();
    require_once "../src/query/Select.php"; // Asegúrate de incluir la ubicación correcta del archivo Select.php
    require_once "../src/data/database.php"; // Asegúrate de incluir la ubicación correcta del archivo Mysqlconexion.php
    use MyApp\query\Select;
    use MyApp\Data\Mysqlconexion;

    if ($_SESSION["Rol"] == 5) { 
    ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a href="../index.php" class="navbar-brand d-lg-none">SHARKSHOP</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a href="../index.php" class="navbar-brand d-none d-lg-block">SHARKSHOP</a>

                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="./index.php" class="nav-link">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a href="./agcat.php" class="nav-link">Categorías</a>
                        </li>
                        <li class="nav-item">
                            <a href="./ventas.php" class="nav-link">Ventas</a>
                        </li>
                       
                    </ul>
                </div>

                <div class="d-flex">
                    <div class="dropdown">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                            echo $_SESSION["correo"];
                            ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="../views/scripts/cerrar.php">Cerrar sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

       
        <div class="container mt-3">
            <form method="GET" class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="num_orden" placeholder="Número de Orden">
                </div>
                <div class="col-md-4">
                    <input type="date" class="form-control" name="fecha_orden" placeholder="Fecha de Orden">
                </div>
                <div class="col-md-2">
                    <select name='estado' class="form-select" class='form-select' placeholder="Estado">
                        <option value='0'>Compras</option>
                        <option value='1'>Confirmadas</option>
                        <option value='2'>Canceladas</option>
                    </select>
                </div>
                <div class="col-md-2">
              <button  class="btn btn-outline-dark" style="float: left;" name="enviando" type="submit">
                <i class="fas fa-search"></i>
                <i class="bi bi-search-heart"></i>
              </button>
                </div>
            </form>
        </div>
       

        <div class="container mt-5">
            <h2>Órdenes</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                                <?php
                               
                               $estado = isset($_GET['estado']) ? $_GET['estado'] : '';
                               if($estado == 1)
                                {
                                    
                                    echo "
                                    <table class='table table-striped table-bordered'>
                                    <thead class='table-dark'>
                                        <tr>
                                            <th colspan='6'><center>Confirmadas</center></th>
                                        </tr>
                                        <tr>
                                            <th>ID de Orden</th>
                                            <th>Fecha de Orden</th>
                                            <th>Usuario</th>
                                            <th>Producto</th>
                                            <th>Unidades</th>
                                            <th>Cancelar</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

                                    $num_orden = isset($_GET['num_orden']) ? $_GET['num_orden'] : '';
                                    $fecha_orden = isset($_GET['fecha_orden']) ? $_GET['fecha_orden'] : '';

                                                                
                                    $queryC = new Select();
                                    $cadena = "SELECT o.reg, o.fecha_orden, u.correo, nombre_pro, do.unidades, do.estado, o.Estado_v
                                                FROM orden o
                                                INNER JOIN detalle_orden do ON o.de_orden = do.reg_det
                                                INNER JOIN usuario u ON do.id_usuario = u.id_usr
                                                INNER JOIN productos p ON do.producto = p.cve_prod
                                                WHERE o.reg LIKE '%$num_orden%' AND o.fecha_orden LIKE '%$fecha_orden%' AND o.Estado_v LIKE '%1%' ORDER BY existencia DESC LIMIT 10  ";
                            
                                    $ordenes = $queryC->seleccionar($cadena);
                                    foreach ($ordenes as $orden) {
                                        echo "<tr>";
                                        echo "<td>$orden->reg</td>";
                                        echo "<td>$orden->fecha_orden</td>";
                                        echo "<td>$orden->correo</td>";
                                        echo "<td>$orden->nombre_pro</td>"; 
                                        echo "<td>$orden->unidades</td>";
                                        echo "<td><center><a href='scriptsdm/cancelardos.php?id=$orden->reg'><button class='btn btn-outline-dark'>Cancelar</button></a></center></td>";
                                        echo "</tr>";
                                    }
                                    echo "
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    ";
                                }
                                else if($estado == 2)
                                {
                                   
                                    echo "
                                    <table class='table table-striped table-bordered'>
                                    <thead class='table-dark'>
                                        <tr>
                                            <th colspan='7'><center>Canceladas</center></th>
                                        </tr>
                                        <tr>
                                            <th>ID de Orden</th>
                                            <th>Fecha de Orden</th>
                                            <th>Usuario</th>
                                            <th>Producto</th>
                                            <th>Unidades</th>
                                            <th>Renovar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

                                    $num_orden = isset($_GET['num_orden']) ? $_GET['num_orden'] : '';
                                    $fecha_orden = isset($_GET['fecha_orden']) ? $_GET['fecha_orden'] : '';

                                                                
                                    $queryC = new Select();
                                    $cadena = "SELECT o.reg, o.fecha_orden, u.correo, nombre_pro, do.unidades, do.estado, o.Estado_v
                                                FROM orden o
                                                INNER JOIN detalle_orden do ON o.de_orden = do.reg_det
                                                INNER JOIN usuario u ON do.id_usuario = u.id_usr
                                                INNER JOIN productos p ON do.producto = p.cve_prod
                                                WHERE o.reg LIKE '%$num_orden%' AND o.fecha_orden LIKE '%$fecha_orden%' AND o.Estado_v LIKE '%2%' ORDER BY existencia DESC LIMIT 10  ";
                            
                                    $ordenes = $queryC->seleccionar($cadena);
                                    foreach ($ordenes as $orden) {
                                        echo "<tr>";
                                        echo "<td>$orden->reg</td>";
                                        echo "<td>$orden->fecha_orden</td>";
                                        echo "<td>$orden->correo</td>";
                                        echo "<td>$orden->nombre_pro</td>"; 
                                        echo "<td>$orden->unidades</td>";
                                        echo "<td><center><a href='scriptsdm/renovar.php?id=$orden->reg'><button class='btn btn-outline-dark'>Renovar</button></a></center></td>";
                                        echo "<td><center><a href='scriptsdm/eliminar.php?id=$orden->reg'><button class='btn btn-outline-dark'>Eliminar</button></a></center></td>";
                                        echo "</tr>";
                                    }
                                    echo "
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    ";
                                }
                                else
                                {
                                   
                                    
                                    echo "
                                    <table class='table table-striped table-bordered'>
                                    <thead class='table-dark'> 
                                        <tr>
                                            <th colspan='8'><center>Compras</center></th>
                                        </tr>
                                        <tr>
                                            <th>ID de Orden</th>
                                            <th>Fecha de Orden</th>
                                            <th>Usuario</th>
                                            <th>Producto</th>
                                            <th>Unidades</th>
                                            <th>Confirmar</th>
                                            <th>Cancelar</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

                                    

                                    $num_orden = isset($_GET['num_orden']) ? $_GET['num_orden'] : '';
                                    $fecha_orden = isset($_GET['fecha_orden']) ? $_GET['fecha_orden'] : '';

                                                                
                                    $queryC = new Select();
                                    $cadena = "SELECT o.reg, o.fecha_orden, u.correo, nombre_pro, do.unidades, do.estado, o.Estado_v
                                                FROM orden o
                                                INNER JOIN detalle_orden do ON o.de_orden = do.reg_det
                                                INNER JOIN usuario u ON do.id_usuario = u.id_usr
                                                INNER JOIN productos p ON do.producto = p.cve_prod
                                                WHERE o.reg LIKE '%$num_orden%' AND o.fecha_orden LIKE '%$fecha_orden%' AND o.Estado_v LIKE '%0%' ORDER BY existencia DESC LIMIT 10  ";

                                    $ordenes = $queryC->seleccionar($cadena);
                                    foreach ($ordenes as $orden) {
                                        echo "<tr>";
                                        echo "<td>$orden->reg</td>";
                                        echo "<td>$orden->fecha_orden</td>";
                                        echo "<td>$orden->correo</td>";
                                        echo "<td>$orden->nombre_pro</td>"; 
                                        echo "<td>$orden->unidades</td>";
                                        echo "<td><center><a href='scriptsdm/confirmar.php?id=$orden->reg'><button class='btn btn-outline-dark'>Confirmar</button></a></center></td>";
                                        echo "<td><center><a href='scriptsdm/cancelar.php?id=$orden->reg'><button class='btn btn-outline-dark'>Cancelar</button></a></center></td>";
                                        echo "</tr>";
                                    }
                                    echo "
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    ";
                                }
                                ?>
        <div class="container mt-5">
            <h2>Gráfica de Ventas Mensuales</h2>
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="graficoVentasMensuales"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <?php
        $query = new Select(); 
        /* modificar conforme al id del usuario */

        /* __________________ enero __________________ */
        $enero = "SELECT COUNT(reg) as total from orden WHERE Estado_v = 1 AND fecha_orden BETWEEN '2023-01-01' AND '2023-01-31' ";
        $insert = $query->seleccionar($enero);
        foreach( $insert as $datos => $arreglo)
        { 
            foreach($arreglo as $Key => $value) 
            { 
                 $ene = $value; 
            } 
        }
        /* __________________ enero __________________ */


        /* __________________ febrero __________________ */
        $febrero = "SELECT COUNT(reg) as total from orden WHERE Estado_v = 1 AND fecha_orden BETWEEN '2023-02-01' AND '2023-02-28' ";
        $insert = $query->seleccionar($febrero);
        foreach( $insert as $datos => $arreglo)
        { 
            foreach($arreglo as $Key => $value) 
            { 
                 $feb = $value; 
            } 
        }
        /* __________________ febrero __________________ */

        /* __________________ marzo __________________ */
        $marzo = "SELECT COUNT(reg) as total from orden WHERE Estado_v = 1 AND fecha_orden BETWEEN '2023-03-01' AND '2023-03-31' ";
        $insert = $query->seleccionar($marzo);
        foreach( $insert as $datos => $arreglo)
        { 
            foreach($arreglo as $Key => $value) 
            { 
                 $mar = $value; 
            } 
        }
        /* __________________ marzo __________________ */


        /* __________________ abril __________________ */
        $abril = "SELECT COUNT(reg) as total from orden WHERE Estado_v = 1 AND fecha_orden BETWEEN '2023-04-01' AND '2023-04-30' ";
        $insert = $query->seleccionar($abril);
        foreach( $insert as $datos => $arreglo)
        { 
            foreach($arreglo as $Key => $value) 
            { 
                 $abr = $value; 
            } 
        }
        /* __________________ abril __________________ */


        /* __________________ mayo __________________ */
        $mayo = "SELECT COUNT(reg) as total from orden WHERE Estado_v = 1 AND fecha_orden BETWEEN '2023-05-01' AND '2023-05-31' ";
        $insert = $query->seleccionar($mayo);
        foreach( $insert as $datos => $arreglo)
        { 
            foreach($arreglo as $Key => $value) 
            { 
                 $may = $value; 
            } 
        }
        /* __________________ mayo __________________ */


        /* __________________ junio __________________ */
        $junio = "SELECT COUNT(reg) as total from orden WHERE Estado_v = 1 AND fecha_orden BETWEEN '2023-06-01' AND '2023-06-30' ";
        $insert = $query->seleccionar($junio);
        foreach( $insert as $datos => $arreglo)
        { 
            foreach($arreglo as $Key => $value) 
            { 
                 $jun = $value; 
            } 
        }
        /* __________________ junio __________________ */


        /* __________________ julio __________________ */
        $julio = "SELECT COUNT(reg) as total from orden WHERE Estado_v = 1 AND fecha_orden BETWEEN '2023-07-01' AND '2023-07-31' ";
        $insert = $query->seleccionar($julio);
        foreach( $insert as $datos => $arreglo)
        { 
            foreach($arreglo as $Key => $value) 
            { 
                 $jul = $value; 
            } 
        }
        /* __________________ julio __________________ */

        
        /* __________________ agosto __________________ */
        $agosto = "SELECT COUNT(reg) as total from orden WHERE Estado_v = 1 AND fecha_orden BETWEEN '2023-08-01' AND '2023-08-31' ";
        $insert = $query->seleccionar($agosto);
        foreach( $insert as $datos => $arreglo)
        { 
            foreach($arreglo as $Key => $value) 
            { 
                 $ago = $value; 
            } 
        }
        /* __________________ agosto __________________ */


        /* __________________ septiembre __________________ */
        $septiembre = "SELECT COUNT(reg) as total from orden WHERE Estado_v = 1 AND fecha_orden BETWEEN '2023-09-01' AND '2023-09-30' ";
        $insert = $query->seleccionar($septiembre);
        foreach( $insert as $datos => $arreglo)
        { 
            foreach($arreglo as $Key => $value) 
            { 
                 $sep = $value; 
            } 
        }
        /* __________________ septiembre __________________ */


        /* __________________ octubre __________________ */
        $octubre = "SELECT COUNT(reg) as total from orden WHERE Estado_v = 1 AND fecha_orden BETWEEN '2023-10-01' AND '2023-10-31' ";
        $insert = $query->seleccionar($octubre);
        foreach( $insert as $datos => $arreglo)
        { 
            foreach($arreglo as $Key => $value) 
            { 
                 $oct = $value; 
            } 
        }
        /* __________________ octubre __________________ */


        /* __________________ noviembre __________________ */
        $noviembre = "SELECT COUNT(reg) as total from orden WHERE Estado_v = 1 AND fecha_orden BETWEEN '2023-11-01' AND '2023-11-30' ";
        $insert = $query->seleccionar($noviembre);
        foreach( $insert as $datos => $arreglo)
        { 
             foreach($arreglo as $Key => $value) 
             { 
                 $nov = $value; 
             } 
        }
        /* __________________ noviembre __________________ */


        /* __________________ diciembre __________________ */
        $diciembre = "SELECT COUNT(reg) as total from orden WHERE Estado_v = 1 AND fecha_orden BETWEEN '2023-12-01' AND '2023-12-31' ";
        $insert = $query->seleccionar($diciembre);
        foreach( $insert as $datos => $arreglo)
        { 
             foreach($arreglo as $Key => $value) 
             { 
                 $dic = $value; 
             } 
        }
        /* __________________ diciembre __________________ */


    ?>
        <script>
  const ene = "<?php echo $ene ?>";
  const feb = "<?php echo $feb ?>";
  const mar = "<?php echo $mar ?>";
  const abr = "<?php echo $abr ?>";
  const may = "<?php echo $may ?>";
  const jun = "<?php echo $jun ?>";
  const jul = "<?php echo $jul ?>";
  const ago = "<?php echo $ago ?>";
  const sep = "<?php echo $sep ?>";
  const oct = "<?php echo $oct ?>";
  const nov = "<?php echo $nov ?>";
  const dic = "<?php echo $dic ?>";


  // Datos de ventas mensuales (Ejemplo de como quedaría)
  var ventasMensuales = [ene, feb, mar, abr, may, jun, jul, ago, sep, oct, nov, dic];
            document.addEventListener("DOMContentLoaded", function () {
                var ctx = document.getElementById("graficoVentasMensuales").getContext("2d");
                var myChart = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
                        datasets: [{
                            label: "Ventas Mensuales",
                            data: [ene, feb, mar, abr, may, jun, jul, ago, sep, oct, nov, dic], 
                            backgroundColor: "rgba(75, 192, 192, 0.2)",
                            borderColor: "rgba(75, 192, 192, 1)",
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
            });
        </script>

    <?php
    } else {
    ?>
        <div class="alert alert-danger" role="alert">
        No tienes permisos para acceder a esta página. Por favor, inicia sesión con una cuenta de administrador.
        </div>

    <?php
    }
    ?>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/cdn.jsdelivr.net_npm_sweetalert2@11.7.12_dist_sweetalert2.all.min.js"></script>
</body>

</html>

 



