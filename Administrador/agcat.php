

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CATEGORÍAS</title>
    <link rel="shortcut icon" href="assets/img/logo_sinfondo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/icons/font/bootstrap-icons.css">
</head>
<body>
<!------------Cuenta admin activa---------------->
<?php
session_start();
require_once "../src/query/select.php"; // Asegúrate de incluir la ubicación correcta del archivo Select.php
require_once "../src/data/database.php"; // Asegúrate de incluir la ubicación correcta del archivo Mysqlconexion.php
use MyApp\query\Select;
use MyApp\Data\Mysqlconexion;

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
          <li class="nav-item">
            <a href="./ventas.php" class="nav-link">Categorías</a>
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
            CATEGORÍAS
            </div>
        <div class="card-body">
           <div class="text-end">
           <form action="" method="GET" >
              <input type="hidden" name="fuera" value="0">
       
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
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#AgregarCat"> Agregar Categoria <i class="bi bi-person-add p-1"></i></button>
           
           </div>
    
  

            <table class="table table-hover">
                <thead class="table-dark">
                  <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Editar</td>
                    
                  </tr>
                </thead>


                <!-- AGREGAR CAMPO DE DATOS YA COMPRADOS-->
                <?php
                
                    if (isset($_GET['enviando'])) 
                    {
                        $busqueda= $_GET['busqueda'];
                        $query = new Select();
                        $cadena = "SELECT * from categoria_prenda WHERE prenda LIKE '%$busqueda%' ";
                        $tabla = $query->seleccionar($cadena);
                        foreach($tabla as $dato)
                        {
                            echo "
                            <tbody>
                                <tr>
                                    <td>$dato->cve_pcat</td>
                                    <td>$dato->prenda</td>
                                    <td><a href='modificarcat.php?id=$dato->cve_pcat'> <button class='btn btn-success'> Editar <i class='bi bi-pencil-square'></i></button></a></td>
                                    
                                </tr> 
                            </tbody>
                            ";
                        }
                    }
                    else
                    {
                        $query = new Select();
                        $cadena = "SELECT * from categoria_prenda";
                        $tabla = $query->seleccionar($cadena);
                        foreach($tabla as $dato)
                        {
                            echo "
                            <tbody>
                                <tr>
                                    <td>$dato->cve_pcat</td>
                                    <td>$dato->prenda</td>
                                    <td><a href='modificarcat.php?id=$dato->cve_pcat'> <button class='btn btn-success'> Editar <i class='bi bi-pencil-square'></i></button></a></td>
                                    
                                </tr> 
                            </tbody>
                            ";
                        }
                    }
                ?>
    </div>
</div>














<!------------AGREGAR CATEGORIA---------------->
<div class="modal fade" id="AgregarCat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Agregar Producto</h1>
        <button type="button" class="btn-close" style="filter: invert(1);" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="../views/scripts/guardacat.php" method="post" id="formAgregar" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="mb-3">
          <label for="prenda" class="form-label">Nombre de la Categoria</label>
          <input type="text" name="prenda" class="form-control" id="prenda"/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Guardar</button>
      </div>
    </div>
    </form>
  </div>
</div>
<!------------AGREGAR CATEGORIA---------------->
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
<!------------Cuenta admin activa---------------->
</body>
</html>
