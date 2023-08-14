<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Cuenta - SharkShop</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="Vista_Usuario/style_index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<style>
css
/* Estilos generales */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* Estilos para la barra lateral */
.sidebar {
    background-color: #f0f0f0;
    padding: 20px;
}

.user-info img {
    display: block;
    margin: 0 auto;
    width: 100px;
    height: auto;
    border-radius: 50%;
    margin-bottom: 10px;
}

.user-info h2 {
    margin: 0;
}

.account-options li {
    list-style: none;
    margin-bottom: 10px;
}

.logout-btn {
    display: block;
    margin-top: 20px;
    text-decoration: none;
    color: #fff;
    background-color: #ff0000;
    padding: 10px 15px;
    border-radius: 5px;
}

.logout-btn:hover {
    background-color: #cc0000;
}

/* Estilos para el contenido principal */
.cv-details {
    padding: 20px;
    background-color: #f9f9f9;
    min-height: 400px;
}

.section-title {
    margin-top: 0;
    margin-bottom: 20px;
}

/* Estilos para el encabezado y pie de página */
.header,
.footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
}

/* Estilos para el botón de "Cancelar pedido" */
.btn-danger {
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
}

/* Estilos para el botón "Buscar" */
#buscarBtn {
    background-color: #007bff;
    color: #fff;
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

#buscarBtn:hover {
    background-color: #0056b3;
}

/* Estilos para el botón "Aceptar" */
#aceptarBtn {
    background-color: #28a745;
    color: #fff;
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

#aceptarBtn:hover {
    background-color: #218838;
}


.btn-danger:hover {
    background-color: #c82333;
    border-color: #bd2130;
}

/* Estilos para la barra de búsqueda */
#barraBusqueda {
    width: 100%;
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Estilos para el botón de selección de fecha y listado de meses */
#fechaSeleccionada,
#mesSeleccionado {
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 10px;
}

/* Estilos para los elementos de la lista de meses */
#mesSeleccionado option {
    padding: 4px;
}
</style>
<body>
    <?php
    require("../../src/query/select.php");
    use MyApp\query\Select;
    session_start();


    if(isset($_SESSION["correo"]))
    {
      
    ?>
    <header class="header">
        <div class="container">
            <h1>SharkShop</h1>
        </div>
    </header>
    <main class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar">
                        <div class="user-info">
                            <a href='../../Vista_Usuario/micuenta.php'><img src="../../src/imgs/logo_sinfondo.png" alt="Logo de SharkShop"></a>
                        </div>
                        <ul class="account-options">
                            <li><a href="./modificar.php"><button type="button" class="btn btn-dark">Editar perfil</button></a></li>
                            <li><a href="./passnew.php"><button type="button" class="btn btn-dark">Cambiar contraseña</button></a></li>
                            <li><a href="./misventas.php"><button type="button" class="btn btn-dark">Historial de compras</button></a></li>
                        </ul>
                        <a href="../../views/scripts/cerrar.php" style="text-decoration: none;" class="logout-btn">Cerrar sesión</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="cv-details">
                        <h2 class="section-title">Mis compras</h2>
                        <!-- Barra de búsqueda -->
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
        <div class='card'>
            <div class='card-header'>
                Compras del usuario
            </div>
            
            <div class='card-body'>
                <div class="container text-center">
                    <div class="row align-items-start">
                        <div class="col">
                            <h5 class='card-title'>Compras pagadas:</h5>
                            <?php
                            $tel_celular = $_SESSION['tel_celular'];
                            $quersy = new Select();
                            $cadenaL = "SELECT id_usr FROM usuario INNER JOIN persona ON persona.id_persona = usuario.persona WHERE tel_celular = '$tel_celular' ";
                            $consultaL = $quersy->seleccionar($cadenaL);
                            foreach($consultaL as $datos)
                            { 
                                        
                                $_SESSION["id_usr"] = $datos->id_usr;
                                    
                            }
                            $id_usr = $_SESSION["id_usr"];

                            $queryC = new Select(); 
                            $cadenaC = "SELECT COUNT(reg_det) from orden INNER JOIN detalle_orden ON orden.de_orden = detalle_orden.reg_det where id_usuario = '$id_usr' and Estado_v = 1 ";
                            $miconsultaC = $queryC->seleccionar($cadenaC);

                            foreach( $miconsultaC as $datos => $arreglo)
                            {
                                foreach($arreglo as $Key => $value)
                                {
                                echo"<center><h1 class=' rounded-pill bg-dark' style='color: white; width: 50px'><center>$value</center></h1></center>";
                                }
                            }
                            ?>  
                        </div>
                        <div class="col">
                            <h5 class='card-title'>Compras pendientes:</h5>
                            <?php
                            $cadenaC = "SELECT COUNT(reg_det) from orden INNER JOIN detalle_orden ON orden.de_orden = detalle_orden.reg_det where id_usuario = '$id_usr' and Estado_v = 0 ";
                            $miconsultaC = $queryC->seleccionar($cadenaC);

                            foreach( $miconsultaC as $datos => $arreglo)
                            {
                                foreach($arreglo as $Key => $value)
                                {
                                echo"<center><h1 class=' rounded-pill bg-dark' style='color: white; width: 55px'><center>$value</center></h1></center>";
                                }
                            }
                            ?>
                        </div>
                        <div class="col">
                            <h5 class='card-title'>Compras canceladas:</h5>
                            <?php
                            $cadenaC = "SELECT COUNT(reg_det) from orden INNER JOIN detalle_orden ON orden.de_orden = detalle_orden.reg_det where id_usuario = '$id_usr' and Estado_v = 2 ";
                            $miconsultaC = $queryC->seleccionar($cadenaC);

                            foreach( $miconsultaC as $datos => $arreglo)
                            {
                                foreach($arreglo as $Key => $value)
                                {
                                echo"<center><h1 class=' rounded-pill bg-dark' style='color: white; width: 50px'><center>$value</center></h1></center>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>                   
            </div>
        </div>
        <br>
    <?php
    $estado = isset($_GET['estado']) ? $_GET['estado'] : '';
    if($estado == 1)
    {
        echo"
        <table class='table table-dark table-striped'>
        <tr>
            <th> NO. Orden </th> 
            <th> Nombre </th>
            <th> Precio </th>
            <th> Talla </th>
            <th> Color </th>
            <th> Unidades </th>
            <th> Fecha Compra</th>
            <th> Fecha Limite </th>
            <th> Acciones </th>
            <th> Ticket </th>
        </tr>
        ";
        $num_orden = isset($_GET['num_orden']) ? $_GET['num_orden'] : '';
        $fecha_orden = isset($_GET['fecha_orden']) ? $_GET['fecha_orden'] : '';
        

    

        $query = new Select();
        $cadena = "SELECT * FROM detalle_orden 
                INNER JOIN orden ON detalle_orden.reg_det = orden.de_orden 
                INNER JOIN productos ON productos.cve_prod = detalle_orden.producto
                WHERE orden.reg LIKE '%$num_orden%' AND orden.fecha_orden LIKE '%$fecha_orden%' AND id_usuario = '$id_usr' AND Estado_v = 1 ORDER BY existencia DESC LIMIT 8 ";
        $miconsulta = $query->seleccionar($cadena);
        foreach ($miconsulta as $datos) {
            echo "
            <tr>
                <td> $datos->reg </td>
                <td> $datos->nombre_pro </td>
                <td> $datos->precio </td>
                <td> $datos->talla </td>
                <td> $datos->color </td>
                <td> $datos->unidades </td>
                <td> $datos->fecha_orden </td>
            ";
                $fecha_actual = $datos->fecha_orden; // Obtenemos la fecha actual en formato 'Y-m-d'

                $nueva_fecha = date('Y-m-d', strtotime($fecha_actual . ' +30 days'));

            echo"
            <td>$nueva_fecha</td>
                <td>
                    <a href='cancelardos.php?id=$datos->reg'><button class='btn btn-danger'>Cancelar Pedido</button></a>
                </td>
                
                <td>
                    <a href='ticketn.php?id=$datos->reg'><button class='btn btn-success'>Renovar Ticket</button></a>
                </td>
            </tr>
            ";
        }

    }
    else if($estado == 2)
    {

        echo"
        <table class='table table-dark table-striped'>
        <tr>
            <th> NO. Orden </th> 
            <th> Nombre </th>
            <th> Precio </th>
            <th> Talla </th>
            <th> Color </th>
            <th> Unidades </th>
            <th> Fecha Compra</th>
            <th> Fecha Limite </th>
            <th> Acciones </th>
        </tr>
        ";
        $num_orden = isset($_GET['num_orden']) ? $_GET['num_orden'] : '';
        $fecha_orden = isset($_GET['fecha_orden']) ? $_GET['fecha_orden'] : '';
        

    

        $query = new Select();
        $cadena = "SELECT * FROM detalle_orden 
                INNER JOIN orden ON detalle_orden.reg_det = orden.de_orden 
                INNER JOIN productos ON productos.cve_prod = detalle_orden.producto
                WHERE orden.reg LIKE '%$num_orden%' AND orden.fecha_orden LIKE '%$fecha_orden%' AND id_usuario = '$id_usr' AND Estado_v = 1 ORDER BY existencia DESC LIMIT 8 ";
        $miconsulta = $query->seleccionar($cadena);
        foreach ($miconsulta as $datos) {
            echo "
            <tr>
                <td> $datos->reg </td>
                <td> $datos->nombre_pro </td>
                <td> $datos->precio </td>
                <td> $datos->talla </td>
                <td> $datos->color </td>
                <td> $datos->unidades </td>
                <td> $datos->fecha_orden </td>
            ";
                $fecha_actual = $datos->fecha_orden; // Obtenemos la fecha actual en formato 'Y-m-d'

                $nueva_fecha = date('Y-m-d', strtotime($fecha_actual . ' +30 days'));

            echo"
            <td>$nueva_fecha</td>
                <td>
                    <a href='renovar.php?id=$datos->reg'><button class='btn btn-success'>Renovar</button></a>
                </td>
            </tr>
            ";
        }
    }
    else
    {

        echo"
        <table class='table table-dark table-striped'>
        <tr>
            <th> NO. Orden </th> 
            <th> Nombre </th>
            <th> Precio </th>
            <th> Talla </th>
            <th> Color </th>
            <th> Unidades </th>
            <th> Fecha Compra</th>
            <th> Fecha Limite </th>
            <th> Acciones </th>
            <th> Ticket </th>
        </tr>
        ";
        $num_orden = isset($_GET['num_orden']) ? $_GET['num_orden'] : '';
        $fecha_orden = isset($_GET['fecha_orden']) ? $_GET['fecha_orden'] : '';
        

    

        $query = new Select();
        $cadena = "SELECT * FROM detalle_orden 
                INNER JOIN orden ON detalle_orden.reg_det = orden.de_orden 
                INNER JOIN productos ON productos.cve_prod = detalle_orden.producto
                WHERE orden.reg LIKE '%$num_orden%' AND orden.fecha_orden LIKE '%$fecha_orden%' AND id_usuario = '$id_usr' AND Estado_v = 0 ORDER BY existencia DESC LIMIT 8 ";
        $miconsulta = $query->seleccionar($cadena);
        foreach ($miconsulta as $datos) {
            echo "
            <tr>
                <td> $datos->reg </td>
                <td> $datos->nombre_pro </td>
                <td> $datos->precio </td>
                <td> $datos->talla </td>
                <td> $datos->color </td>
                <td> $datos->unidades </td>
                <td> $datos->fecha_orden </td>
            ";
                $fecha_actual = $datos->fecha_orden; // Obtenemos la fecha actual en formato 'Y-m-d'

                $nueva_fecha = date('Y-m-d', strtotime($fecha_actual . ' +30 days'));

            echo"
            <td>$nueva_fecha</td>
                <td>
                    <a href='cancelar.php?id=$datos->reg'><button class='btn btn-danger'>Cancelar Pedido</button></a>
                </td>
                
                <td>
                    <a href='ticketn.php?id=$datos->reg'><button class='btn btn-success'>Renovar Ticket</button></a>
                </td>
            </tr>
            ";
        }

    }
    ?>
</table>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    }
    else
    {
    ?>
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading" style="margin-left: 40px;">No hay sesion activa!!!</h4>
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 30px; margin-top: -75px;" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <p>No cuentas con una cuenta, te pedimos amablemente salir de esta URL dirigiendote a: <a href="../index.php"><button class="btn btn-dark"> Inicio </button></a>.</p>
            <hr>
            <p class="mb-0">Muchas gracias por entender y disfrute de la estadia en la pagina.</p>
        </div>
    <?php
    }
    ?>
</body>
</html>