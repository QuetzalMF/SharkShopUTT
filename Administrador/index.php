

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRODUCTOS</title>
    <link rel="shortcut icon" href="assets/img/logo_sinfondo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/icons/font/bootstrap-icons.css">
</head>
<body>
<!------------Cuenta admin activa---------------->
<?php
require_once "../src/query/Select.php"; // Asegúrate de incluir la ubicación correcta del archivo Select.php
require_once "../src/data/database.php"; // Asegúrate de incluir la ubicación correcta del archivo Mysqlconexion.php
use MyApp\query\Select;
use MyApp\Data\Mysqlconexion;

session_start();

if($_SESSION["Rol"] == 5)
{
?>
<!------------Cuenta admin activa---------------->
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
          
          <li>
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

      <div class="card text-center m-4">
        <div class="card-header">
          PRODUCTOS
        </div>
        <div class="card-body">
           <div class="text-end">
           <form action="" method="GET" >
              <input type="hidden" name="fuera" value="0">
              <button class="btn btn-primary mb-3" style="float: left;" name="enviar" type="submit">Fuera de Stock</button>
            </form>
           </div>

          <form method="GET">
           <input onkeyup="$enviar"  style="float: left; width: 300px; margin-left: 10px"  name="busqueda" class="form-control me-2" placeholder="Buscar"/>
              <button  class="btn btn-outline-dark" style="float: left;" name="enviando" type="submit">
                <i class="fas fa-search"></i>
                <i class="bi bi-search-heart"></i>
              </button>
          </form> 

           <div class="text-end">
            <!--------------AGREGAR CATEGORIA---------------->
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#AgregarModal">Agregar Producto <i class="bi bi-person-add p-1"></i></button>
           </div>
           <!--------------AGREGAR PRODUCTO---------------->

            <table class="table table-hover">
                <thead class="table-dark">
                  <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Precio</td>
                    <td>Existencia</td>
                    <td>Talla</td>
                    <td>Color</td>
                    <td>Genero</td>
                    <td>Descripcion</td>
                    <td>Imagen</td>
                    <td>Categoria</td>
                    <td>Editar</td>
                    <td>Eliminar</td>
                  </tr>
                </thead>


                <!-- AGREGAR CAMPO DE DATOS YA COMPRADOS-->
                <?php
              
                if (isset($_GET['enviando'])) 
                {
                  $busqueda= $_GET['busqueda'];
                       $query = new Select();
                       $cadena = "SELECT * from productos INNER JOIN categoria_prenda ON productos.categoria = categoria_prenda.cve_pcat WHERE nombre_pro LIKE '%$busqueda%' and existencia >0 ORDER BY existencia DESC LIMIT 10  ";
                       $tabla = $query->seleccionar($cadena);
                       foreach($tabla as $dato)
                       {
                        echo "
                        <tbody>
                            <tr>
                                <td>$dato->cve_prod</td>
                                <td>$dato->nombre_pro</td>
                                <td>$ $dato->precio</td>
                                <td>$dato->existencia</td>
                                <td>$dato->talla</td>
                                <td>$dato->color</td>
                                <td>$dato->genero</td>
                                <td>$dato->descripcion</td>
                                <td><img src='../fotos/$dato->imagen' style='width:100px; height:100px;'></td>
                                <td>$dato->prenda</td>
                                <td><a href='modificar.php?id=$dato->cve_prod'> <button class='btn btn-success'> Editar <i class='bi bi-pencil-square'></i></button></a></td>
                                <td><button class='btn btn-danger'>Eliminar <i class='bi bi-trash'></i></button></td>
                              </tr> 
                        </tbody>
                        ";
                       }
                }
                else if (isset($_GET['enviar'])) 
                {
                  $fuera= $_GET['fuera'];

                $query = new Select();

                $cadena = "SELECT * from productos INNER JOIN categoria_prenda ON productos.categoria = categoria_prenda.cve_pcat WHERE existencia = '$fuera' ORDER BY existencia DESC LIMIT 10  ";

                $tabla = $query->seleccionar($cadena);

                foreach($tabla as $dato)
                {
                echo "
                <tbody>
                    <tr>
                        <td>$dato->cve_prod</td>
                        <td>$dato->nombre_pro</td>
                        <td>$ $dato->precio</td>
                        <td>$dato->existencia</td>
                        <td>$dato->talla</td>
                        <td>$dato->color</td>
                        <td>$dato->genero</td>
                        <td>$dato->descripcion</td>
                        <td><img src='../fotos/$dato->imagen' style='width:100px; height:100px;'></td>
                        <td>$dato->prenda</td>
                        <td><a href='modificar.php?id=$dato->cve_prod'><button class='btn btn-success'> Editar <i class='bi bi-pencil-square'></i></button></a></td>
                        <td><button class='btn btn-danger'>0 Stock</button></td>
                      </tr> 
                </tbody>
                ";
                }
              }
              else
              {

                $query = new Select();

                $cadena = "SELECT * from productos INNER JOIN categoria_prenda ON productos.categoria = categoria_prenda.cve_pcat WHERE existencia > 0 ORDER BY existencia DESC LIMIT 10 ";
                $tabla = $query->seleccionar($cadena);

                foreach($tabla as $dato)
                {
                echo "
                <tbody>
                    <tr>
                        <td>$dato->cve_prod</td>
                        <td>$dato->nombre_pro</td>
                        <td>$ $dato->precio</td>
                        <td>$dato->existencia</td>
                        <td>$dato->talla</td>
                        <td>$dato->color</td>
                        <td>$dato->genero</td>
                        <td>$dato->descripcion</td>
                        <td><img src='../fotos/$dato->imagen' style='width:100px; height:100px;'></td>
                        <td>$dato->prenda</td>
                        <td><a href='modificar.php?id=$dato->cve_prod'> <button class='btn btn-success'> Editar <i class='bi bi-pencil-square'></i></button></a></td>
                        <td><a href='../views/scripts/actualizar.php?id=$dato->cve_prod'><button class='btn btn-danger'>Eliminar <i class='bi bi-trash'></i></button></a></td>
                      </tr> 
                </tbody>
                ";
                }
              }
                ?>
              </table>
        </div>
        <div class="card-footer text-body-secondary">
          .
        </div>
      </div>


<!------------AGREGAR PRODUCTO---------------->
<div class="modal fade" id="AgregarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Agregar Producto</h1>
        <button type="button" class="btn-close" style="filter: invert(1);" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="../views/scripts/guardapro.php" method="post" id="formAgregar" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre</label>
          <input type="text" name="nombre_pro" class="form-control" id="nombre"/>
        </div>
        <div class="mb-3">
          <label for="ap" class="form-label">Precio</label>
          <input type="text" name="precio" class="form-control" id="ap"/>
        </div>
        <div class="mb-3">
          <label for="am" class="form-label">Existencia</label>
          <input type="text" name="existencia" class="form-control" id="am"/>
        </div>
        <div class="mb-3">
          <label for="am" class="form-label">Talla</label>
          <select name='talla' class="form-select" class='form-select'>
            <option value='S' >S</option>
            <option value='M' >M</option>
            <option value='L' >L</option>
            <option value='XL' >XL</option>
            <option value='XXL' >XXL</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="Genero" class="form-label">Genero</label>
          <select name='genero' class="form-select" class='form-select'>
            <option value='masculino' >masculino</option>
            <option value='femenino' >femenino</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="color" class="form-label">Color</label>
          <input type="text" name="color" class="form-control"/>
        </div>
        <div class="mb-3">
          <label for="descripcion" class="form-label">Descripcion</label>
          <input type="text" name="descripcion" class="form-control"/>
        </div>
        <div class="mb-3">
          <label for="Imagen" class="form-label">Imagen</label>
          <input type="file" name="imagen" class="form-control" accept=".jpg, .png, .jpeg"/>
        </div>
        <div class="mb-3">
          <?php
          $queryp = new Select();
          $cadenap = "SELECT * from categoria_prenda ";
          $reg = $queryp->seleccionar($cadenap);
          echo "
          <label for='cat' class='form-label'>Categoria</label>
          <select name='categoria' class='form-select'>
          
          ";
          foreach($reg as $value)
          {
              echo "<option value=' ".$value->cve_pcat." ' > ".$value->prenda."</option>";
          }

          echo "</select>";
          ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" name="agregar" class="btn btn-success">Guardar</button>
      </div>
    </div>
    </form>
  </div>

</div>
<!------------AGREGAR PRODUCTO---------------->



    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/cdn.jsdelivr.net_npm_sweetalert2@11.7.12_dist_sweetalert2.all.min.js"></script>

<!------------Cuenta admin activa---------------->
<?php
}
else 
{
?>
  <div class="alert alert-danger" role="alert">
  <h4 class="alert-heading" style="margin-left: 40px;">No eres Administrador!!!</h4>
  <svg xmlns="http://www.w3.org/2000/svg" style="width: 30px; margin-top: -75px;" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </svg>
    <p>No cuentas con una cuenta de administrador o no eres el dueño del negocio, 
      <br>te pedimos amablemente salir de esta URL dirigiendote a: <a href="../index.php"><button class="btn btn-dark"> Inicio </button></a>.</p>
    <hr>
    <p class="mb-0">Muchas gracias por entender y disfrute de la estadia en la pagina.</p>
  </div>
  
<?php  
}
?>

<?php
$select = new Select();
$consulta = "SELECT fecha_orden, reg FROM orden";
$query = $select->seleccionar($consulta);

$fecha_actual = date('Y-m-d'); // Obtén la fecha actual

$fechas_generadas = array(); // Para almacenar las fechas límite ya procesadas

foreach ($query as $dato) {
    $fecha = $dato->fecha_orden;
    $reg = $dato->reg;
    //echo "<p>Fechas: $fecha , $reg </p>";
    $objetivo = date('Y-m-d', strtotime($fecha . ' +15 days'));
    //echo "<p>Fechas límite: $objetivo</p><br>";

    // Compara la fecha límite con la fecha actual
    if (($objetivo == $fecha_actual || $objetivo < $fecha_actual) && !in_array($objetivo, $fechas_generadas)) {

        $queryM = new Ejecuta();
        $updateM = "UPDATE orden SET Estado_v = 2 WHERE reg = $reg";
        $queryM->ejecutar($updateM); 
        $fechas_generadas[] = $objetivo; // Agrega la fecha al array de fechas procesadas
    }
}
?>
<!------------Cuenta admin activa---------------->
</body>
</html>
