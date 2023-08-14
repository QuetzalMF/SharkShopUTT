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

require("../src/query/ejecuta.php");
use MyApp\query\Ejecuta;
use MyApp\Data\Mysqlconexion;

if($_SESSION["Rol"] == 5)
{
?>
<!------------Cuenta admin activa---------------->
<?php
            $id=$_GET["id"];
            $query = new Select();

            $cadena = "SELECT * from categoria_prenda where cve_pcat = $id";

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

include "../views/scripts/mocat.php";
        foreach($miconsulta as $datos)
        {?>
        <form action="" method="POST" enctype="multipart/form-data">
        <div class="container" style="width: 40%;">
            <br><br>
            <div class="mb-3">
              <h1>Modificar categoría</h1><br>
            <input type="hidden" name="id" value="<?=$_GET["id"]?>">
              <label for="nombre" class="form-label"><strong>Nombre</strong></label>
              <input type="text" name="nombre_pro" class="form-control" value="<?= $datos->prenda?>">
            </div>	
        </div>
        <div class="col text-center">
              <button type="submit" class="btn btn-primary" name="btnmodifcar" value="guardar">Modificar categoría</button>
          </div>	
        </form>
        
        <?php }

            ?>
            <?php

if(isset($_POST["btnmodifcar"])) {
    
    $idCategoria = $_POST["id"];

    $nuevoNombre = $_POST["nombre_pro"];

  
    
    $query = new Ejecuta(); 

    $cadena = "UPDATE categoria_prenda SET prenda = '$nuevoNombre' WHERE cve_pcat = $idCategoria";
    $query->ejecutar($cadena);

    
    header("Location: agcat.php");
    exit;
}
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