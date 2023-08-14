<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="Vista_Usuario/style_index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
   
    <title>SHARKSHOP</title>
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <nav class="navbar navbar-expand-lg navbar-light bg-light position-relative top-0 start-0 w-100">
            <div class="container">        
                <a href="./index.php" class="navbar-brand d-lg-none">
                    SHARKSHOP
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                    <span class="navbar-toggler-icon" ></span>
                </button>

                <div class="collapse navbar-collapse p-2 flex-column" id="navbarContent">
                    <div class="d-flex justify-content-center justify-content-lg-between flex-column flex-lg-row w-100" >
                        <a href="./index.php" class="navbar-brand d-none d-lg-block">SHARKSHOP</a>
                        <ul class="navbar-nav">
                            <?php 

                                include "src/query/Select.php"; // Asegúrate de incluir la ubicación correcta del archivo Select.php
                                include "src/data/database.php"; // Asegúrate de incluir la ubicación correcta del archivo Mysqlconexion.php

                                use MyApp\query\Select;
                                use MyApp\Data\Mysqlconexion;
                        
                                session_start();
                                $ROL = $_SESSION["Rol"];
                            
                                if(isset($_SESSION["correo"]))
                                {
                                // Primero la session, despues los roles...
                                    
                                    $tel_celular = $_SESSION["tel_celular"];

                                    $quersy = new Select();
                                    $cadenaL = "SELECT id_usr FROM usuario INNER JOIN persona ON persona.id_persona = usuario.persona WHERE tel_celular = '$tel_celular' ";
                                    $consultaL = $quersy->seleccionar($cadenaL);
                                    foreach($consultaL as $datos)
                                    { 
                                        
                                        $_SESSION["id_usr"] = $datos->id_usr;
                                    
                                    }
                                    $id_usr = $_SESSION["id_usr"];

                                    if($ROL == 5)
                                    {
                                ?>
                                <li class="nav-item d-flex align-items-center">
                                    <a href="Administrador/index.php" class="nav-link mx-2">
                                    <i class="fas fa-user"></i><i class="bi bi-person"></i>
                                    Admin
                                    </a>
                                </li>
                                <?php

                                    }
                                
                                ?>
                             <li class="nav-item d-flex align-items-center">
                                <a href="Vista_Usuario/micuenta.php" class="nav-link mx-2">
                                <i class="fas fa-user"></i><i class="bi bi-person"></i>
                                 Mi Cuenta
                                </a>
                             </li>
                             <li class="nav-item d-flex align-items-center">
                                <a href="Vista_Usuario/vistacarro.php" class="nav-link mx2" >
                                    <i class="fas fa-shopping-bag"></i><i class="bi bi-cart2"></i>
                                    Carrito
                                </a>
                                <?php
                               
                               $queryC = new Select();
                               $conexion = new Mysqlconexion("sharkshop", "root", ""); // Asegúrate de proporcionar los datos correctos de conexión
                               
                               $cadenaC = "SELECT COUNT(reg_det) as total FROM detalle_orden WHERE id_usuario = '$id_usr' AND estado = 0";
                               $miconsultaC = $queryC->seleccionar($cadenaC, $conexion->getConexion());
                               
                               foreach ($miconsultaC as $datos => $arreglo) {
                                   foreach ($arreglo as $Key => $value) {
                                       echo "<span class='badge rounded-pill bg-secondary'>$value</span> ";
                                   }
                               }
                               
                               // No olvides cerrar la conexión después de usarla
                               $conexion->desconectarDB();
                               ?>
                            </li>  
                            <?php 
                            }  
                            else
                            {
                                
                            ?>
                            
                            <li class="nav-item d-flex align-items-center">
                                <a href="Vista_Usuario/login.php" class="nav-link mx-2">
                                    <i class="fas fa-user"></i><i class="bi bi-person"></i>
                                    Login
                                </a>
                            </li>
                            <li class="nav-item d-flex align-items-center">
                                <a href="Vista_Usuario/login.php" class="nav-link mx2" >
                                    <i class="fas fa-shopping-bag"></i><i class="bi bi-cart2"></i>
                                    Carrito
                                </a>
                                <span class='badge rounded-pill bg-secondary'>0</span> 
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="d-block w-100">
                        <ul class="navbar-nav d-flex justify-content-center align-items-center pt-3">
                            <li class="nav-item mx-2">
                                <a href="Vista_Usuario/listaproductos_ropa.php" style="text-decoration: none;"><button class="btn btn-outline-dark" type="submit ">TODOS LOS PRODUCTOS</button></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <header class="position-relative text-center text-white mb-5">
            <img src="src/imgs/otrofondolr.jpg" class="w-100" alt="Banner"/>
            <div class="position-absolute top-50 start-50 translate-middle-x w-100 px-3">
                <h1 class="display-4">Colección Verano 2023</h1>
                <a href="#new" class="btn btn-light">Explorar Novedades</a>
            </div>
        </header>
        <div class="container position-relative text-center">
        <h2 id="new" class="display-6 py-5">Más populares</h2>  
        <div class="d-flex justify-content-between align-items-center flex-column flex-lg-row my-5">
            <?php
            
            $query = new Select();
            $conexion = new Mysqlconexion("sharkshop", "root", ""); // Asegúrate de proporcionar los datos correctos de conexión
            
            $cadena = "SELECT * FROM productos ORDER BY existencia DESC LIMIT 3";
            $tabla = $query->seleccionar($cadena, $conexion->getConexion());
            foreach ($tabla as $dato) {
                echo "
                <div class='card m-2'>
                    <a href='Vista_Usuario/producto.php?id=$dato->cve_prod'>
                        <img src='fotos/$dato->imagen' style='width:250px; height:350px' class='' height='300' alt='Producto'/>
                    </a>
                    <div class='card-body'>
                        <p class='card-text fw-bold'> $dato->nombre_pro </p>
                        <small class='text-secondary'>$ $dato->precio </small>
                    </div>
                </div>
                ";
            }
            
            // No olvides cerrar la conexión después de usarla
            $conexion->desconectarDB();
            ?>
        </div>
        <a href="Vista_Usuario/listaproductos_ropa.php" class="btn btn-outline-dark my-5">Ver todo los productos</a>
        </div>

<div class="row text-start align-items-center gy-5 my-5">
    <div class="col-12 col-md-6">
        <img src="src/imgs/modelo_nirvana.jpg" alt="" class="w-100 h-100"/>
    </div>
    <div class="col-12 col-md-6">
        <div>
            <h2 class="display-4">¿Quiénes somos?</h2>
            <p>Somos un concepto que nace del resultado de combinar estilo y tecnología. 
                Gracias a nuestras maravillosas collecciones y excelente servicio al cliente, hemos tenido muchísimo éxito desde el primer día. 
                Navega por nuestro sitio web y consulta las últimas colecciones que tenemos; no dudes en contactarnos en caso de que necesites ayuda.
                ¡Felices compras!
            </p>
        </div>
    </div>
</div>
<div class="form-area">
    <div class="container">
        <div class="row single-form g-0">
            <div class="col-sm-12 col-lg-6">
                <div class="left">
                    <h2><span>Contáctanos</span></h2>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <div class="right">
                    <form method="POST" action="send.php">
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Asunto</label>
                          <input type="text" class="form-control" name="subject" id="subject" aria-describedby="emailHelp">
                          <div id="emailHelp" class="form-text"></div>
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">Correo electrónico</label>
                          <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Mensaje</label>
                            <textarea class="form-control" name="message" id="message"></textarea>
                          </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>





  </body>
</html>