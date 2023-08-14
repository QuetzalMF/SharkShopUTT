<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLIENTES REGISTRADOS</title>
    <link rel="shortcut icon" href="assets/img/logo_sinfondo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/icons/font/bootstrap-icons.css">
</head>
<body>
<!------------Cuenta admin activa---------------->
<?php
session_start();
require_once "../src/query/Select.php"; // Asegúrate de incluir la ubicación correcta del archivo Select.php
require_once "../src/data/database.php"; // Asegúrate de incluir la ubicación correcta del archivo Mysqlconexion.php
use MyApp\query\Select;
use MyApp\Data\Mysqlconexion;

if($_SESSION["Rol"] == 5)
{
?>
<!------------Cuenta admin activa---------------->
<?php
            
            $id=$_GET["id"];
            $query = new Select();

            $cadena = "SELECT * from productos
            INNER JOIN categoria_prenda ON productos.categoria = categoria_prenda.cve_pcat where cve_prod = $id";

            $miconsulta = $query->seleccionar($cadena);
?>
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="../index.php" class="navbar-brand d-lg-none">SHARKSHOP</a>
  
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <a href="../index.php" class="navbar-brand d-none d-lg-block">SHARKSHOP</a>

      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-1">
          <li class="nav-item">
            <a href="./index.php" class="nav-link">Administradores</a>
          </li>
          <li class="nav-item">
            <a href="./ventas.php" class="nav-link">Ventas</a>
          </li>
          <li class="nav-item">
            <a href="./index.php" class="nav-link">Productos</a>
          </li>
        </ul>
      </div>
  
      <div class="d-flex">
        <div class="dropdown">
          <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Jatziri Mtz
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="./index.html">Cerrar sesión</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

      <div class="card text-center m-4">
        <div class="card-header">
        <?php

        
        include "../views/scripts/modificar.php";
        
        foreach($miconsulta as $datos)
        {?>
        <form action="" method="POST" enctype="multipart/form-data">
        <div class="container" style="width: 40%;">
            <br><br>
            <div class="mb-3">
              <h1>Registro del producto</h1><br>
            <input type="hidden" name="id" value="<?=$_GET["id"]?>">
              <label for="nombre" class="form-label"><strong>Nombre</strong></label>
              <input type="text" name="nombre_pro" class="form-control" value="<?= $datos->nombre_pro?>">
            </div>
            <div class="mb-3">
              <label for="precio" class="form-label"><strong>Precio</strong></label>
              <input type="text" name="precio" id="" class="form-control"  value="<?= $datos->precio?>">
            </div>
            <div class="mb-3">
              <label for="existencia" class="form-label"><strong>Existencia</strong></label>
              <input type="text" name="existencia" id="" class="form-control" value="<?= $datos->existencia?>">
            </div>
            <div class="mb-3">
              <label for="talla" class="form-label"><strong>Talla</strong></label>
              <select name='talla' class="form-select" class='form-select'>
                <option value="<?=$datos->talla?>"><?= $datos->talla?></option>
                <option value='S' >S</option>
                <option value='M' >M</option>
                <option value='L' >L</option>
                <option value='XL' >XL</option>
                <option value='XXL' >XXL</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="color" class="form-label"><strong>Color</strong></label>
              <input type="text" name="color" id="" class="form-control" value="<?= $datos->color?>">
            </div>
            <div class="mb-3">
              <label for="color" class="form-label"><strong>Genero</strong></label>
              <select name='genero' class="form-select" class='form-select'>
                <option value='<?= $datos->genero?>' >masculino</option>
                <option value='masculino' >masculino</option>
                <option value='femenino' >femenino</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="descripcion" class="form-label"><strong>Descripcion</strong></label>
              <input type="text" name="descripcion" id="" class="form-control" value="<?= $datos->descripcion?>">
            </div>
            <div class="mb-3">
              <label for="color" class="form-label"><strong>imagen</strong></label>
              <input type="file" name="imagen" class="form-control" accept=".jpg, .png, .jpeg"/>
            </div>
        <!--Campo con consulta para la categoria_prenda -->
        <div class="mb-3">
          <?php
            $queryp = new Select();
            $cadenap = "SELECT * from categoria_prenda ";
            $reg = $queryp->seleccionar($cadenap);
            echo "
            <label for='cat' class='form-label'>Categoria</label>
            <select name='categoria' class='form-select'>
              <option value=' ".$datos->cve_pcat." ' > ".$datos->prenda."</option>
            ";
            foreach($reg as $value)
            {
                echo "<option value=' ".$value->cve_pcat." ' > ".$value->prenda."</option>";
            }

            echo "</select>";
            ?>
          <br>
          <div class="col text-center">
              <button type="submit" class="btn btn-primary" name="btnmodifcar" value="guardar">Modificar producto</button>
          </div>	
        </div>
        </form>
        <?php }

            ?>
        </div>
        <div class="card-body">

            

        </div>
        <div class="card-footer text-body-secondary">
        
        </div>
      </div>



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
<!------------Cuenta admin activa---------------->
</body>
</html>