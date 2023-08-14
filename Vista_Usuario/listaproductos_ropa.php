<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style_index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    

    <title>ROPA</title>
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <nav class="navbar navbar-expand-lg navbar-light bg-light position-relative top-0 start-0 w-100">
        <div class="container">
            
            <a href="./listaproductos_ropa.php" class="navbar-brand d-lg-none">
                SHARKSHOP
            </a>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse p-2 flex-column" id="navbarContent">
                <div class="d-flex justify-content-center justify-content-lg-between flex-column flex-lg-row w-100" >
                    <form action="" method="get" class="d-flex">
                        <input onkeyup="$enviar" name="busqueda" class="form-control me-2" placeholder="Buscar"/>
                        <select name='estado' class="form-control me-2" class='form-select' placeholder="Tallas">
                            <option value=''>Tallas</option>
                            <option value='S'>Chica</option>
                            <option value='M'>Mediana</option>
                            <option value='L'>Grande</option>
                            <option value='XL'>Extra Grande</option>
                            <option value='XXL'>Extra Extra Grande</option>
                        </select>
                        <button class="btn btn-outline-dark" name="enviar" type="submit">
                            <i class="fas fa-search"></i>
                            <i class="bi bi-search-heart"></i>
                        </button>
                    </form>
                    <a href="../index.php" class="navbar-brand d-none d-lg-block">SHARKSHOP</a>
                    <ul class="navbar-nav">
                        <?php

                        require_once "../src/query/Select.php"; // Asegúrate de incluir la ubicación correcta del archivo Select.php
                        require_once "../src/data/database.php"; // Asegúrate de incluir la ubicación correcta del archivo Mysqlconexion.php
                        use MyApp\query\Select;
                        use MyApp\Data\Mysqlconexion;

                        session_start();
                        $ROL = $_SESSION["Rol"];
                        if(isset($_SESSION["correo"]))
                        {
                            $tel_celular = $_SESSION["tel_celular"];
                            $id_usr = $_SESSION["id_usr"];
                            if($_SESSION["Rol"] == 5)
                            {
                        ?>
                        <li class="nav-item d-flex align-items-center">
                                <a href="../Administrador/index.php" class="nav-link mx-2">
                                <i class="fas fa-user"></i><i class="bi bi-person"></i>
                                 Admin
                                </a>
                             </li>
                            <?php

                                    }
                                
                                ?>
                        <li class="nav-item d-flex align-items-center">
                            <a href="./micuenta.php" class="nav-link mx-2">
                                <i class="fas fa-user"></i><i class="bi bi-person"></i>
                                Mi Cuenta
                            </a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a href="./vistacarro.php" class="nav-link mx2" >
                                <i class="fas fa-shopping-bag"></i><i class="bi bi-cart2"></i>
                                Carrito
                            </a>
                            <?php
                            
                            $queryC = new Select();
                            $conexion = new Mysqlconexion("sharkshop", "root", ""); // Asegúrate de proporcionar los datos correctos de conexión
                            
                            /* Modifica conforme al id del usuario */
                            $cadenaC = "SELECT COUNT(reg_det) as total FROM detalle_orden WHERE id_usuario = '$id_usr' AND estado = 0";
                            $miconsultaC = $queryC->seleccionar($cadenaC, $conexion->getConexion());
                            
                            foreach ($miconsultaC as $datos => $arreglo) {
                                foreach ($arreglo as $Key => $value) {
                                    $limites = $value;
                                    echo "<span class='badge rounded-pill bg-secondary'>$limites</span> ";
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
                            <a href="./login.php" class="nav-link mx-2">
                                <i class="fas fa-user"></i><i class="bi bi-person"></i>
                                Login
                            </a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a href="./login.php" class="nav-link mx2" >
                                <i class="fas fa-shopping-bag"></i><i class="bi bi-cart2"></i>
                                Carrito
                            </a>
                        </li>
                        <?php
                        }
                        ?>
                        
                    </ul>
                </div>
                <div class="d-block w-100">
                    <ul class="navbar-nav d-flex justify-content-center align-items-center pt-3">
                        <li class="nav-item mx-2">
                          <form method="GET">
                            <input type="hidden" name="variable_ro" value="10">
                            <button class="btn btn-outline-dark" name="enviar_ro" type="submit ">Ropa</button>
                          </form>
                        </li>
                        <li class="nav-item mx-2">
                           <form method="GET">
                            <input type="hidden" name="variable_pa" value="11">
                            <button class="btn btn-outline-dark" name="enviar_pa" type="submit">Pantalones</button>
                           </form>
                        </li>
                        <li class="nav-item mx-2">
                           <form method="GET">
                            <input type="hidden" name="variable_ac" value="12">
                            <button class="btn btn-outline-dark" name="enviar_ac" type="submit">Accesorios</button>
                           </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <header class="position-relative text-center text-white mb-5">
        <img src="../src/imgs/otrofondolr.jpg" class="w-100" alt="Banner"/>
        <div class="position-absolute top-50 start-50 translate-middle-x w-100 px-3">
            <h1 class="display-3" style="background-color: black; color: white;">Playeras</h1>
        </div>
    </header>
    <div class="row">
        <div class="col col-lg-3 text-start">
            <h3>Ropa</h3>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <form method="GET">
                        <input type="hidden" name="variable_ro" value="10">
                        <button class="nav-link text-muted" style="border: none; background: none;" name="enviar_ro" type="submit">Playeras</button>
                    </form>
                </li>
            </ul>

            <h3>Pantalones</h3>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <form method="GET">
                        <input type="hidden" name="variable_pa" value="11">
                        <button class="nav-link text-muted" style="border: none; background: none;" name="enviar_pa" type="submit">Pantalones</button>
                    </form>
                </li>
            </ul>
            <h3>Accesorios</h3>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <form method="GET">
                        <input type="hidden" name="variable_ac" value="12">
                        <button class="nav-link text-muted" style="border: none; background: none;" name="enviar_ac" type="submit">Accesorios</button>
                    </form>
                </li>
            </ul>
            
        </div>
        
        <div class='col col-9.5 d-flex flex-wrap justify-content-between'>
        <?php
        if (isset($_GET['enviar'])) 
        {
           if(isset($_SESSION["correo"]))/*----------------------------*/
           {

                           $busqueda = $_GET['busqueda'];
                           $estado = isset($_GET['estado']) ? $_GET['estado'] : '';
                           $query = new Select();

                           $cadenacom = "SELECT producto from detalle_orden WHERE id_usuario = '$id_usr' and estado = 0 ";
                           $tablComa = $query->seleccionar($cadenacom);


                           $cadena = "SELECT * from productos WHERE nombre_pro LIKE '%$busqueda%' AND talla LIKE '%$estado%' AND existencia > 0 ";
                           $tabla = $query->seleccionar($cadena);
                           foreach ($tabla as $datos) 
                           {
                           $comparande = $datos->cve_prod;
                           $estaEnCarrito = false;
                       
                       
                           echo "
                           <div class='card m-2'>
                               <a href='./producto.php?id=$datos->cve_prod'>
                                   <img src='../fotos/$datos->imagen' style='width:250px; height:350px' class='card-img-top' height='300' alt='Product'/>
                               </a>
                               <div class='card-body'>
                                   <p class='card-text fw-bold'>$datos->nombre_pro</p>
                                   <small class='text-secondary'>$ $datos->precio</small>
                                   <br>
                                   <br>
                           ";
                               if($limites <= 5)
                               {
                                   foreach ($tablComa as $datoComa) 
                                   {
                                       $comparar = $datoComa->producto;
                               
                                       if ($comparar === $comparande) 
                                       {
                                           $estaEnCarrito = true;
                                           break; // Rompe el bucle cuando se encuentra una coincidencia
                                       }
                                   }
                                   if ($estaEnCarrito) {
                                       echo "
                                           <a href='#'><div class='btn btn-sm btn-danger' type='button' style='height:30px;'> Ya esta dentro del carrito </div></a>
                                       ";
                                   }
                                   else
                                   {
                                       echo "
                                       <a href='../views/scripts/guardacarrito.php?id=$comparando' ><button class='btn btn-sm btn-dark' type='button' style='height:30px;'>Agregar al carrito</button></a>
                                       ";
                                   }
                               }
                               else
                               {
                                   echo "
                                   <a href='#' ><div class='btn btn-sm btn-danger' type='button' style='height:30px;'> Carrito Lleno </div></a>
                                   ";
                               }
                           
                           echo "
                               </div>
                           </div>
                           ";
                       }

           }
           else/*----------------------------*/
           {
                   $busqueda = $_GET['busqueda'];
                   $estado = isset($_GET['estado']) ? $_GET['estado'] : '';
                   $query = new Select();

                   
                   $cadena = "SELECT * from productos WHERE nombre_pro LIKE '%$busqueda%' AND talla LIKE '%$estado%' AND existencia > 0 ";
                   $tabla = $query->seleccionar($cadena);
                   foreach ($tabla as $datos) 
                   {
                       echo "
                       <div class='card m-2'>
                           <a href='./producto.php?id=$datos->cve_prod'>
                               <img src='../fotos/$datos->imagen' style='width:250px; height:350px' class='card-img-top' height='300' alt='Product'/>
                           </a>
                           <div class='card-body'>
                               <p class='card-text fw-bold'>$datos->nombre_pro</p>
                               <small class='text-secondary'>$ $datos->precio</small>
                               <br>
                               <br>
                               <a href='./login.php'><button class='btn btn-sm btn-dark' type='button' style='height:30px;'>Agregar al carrito</button></a>
                           </div>
                       </div>
                       ";
                   }

           }/*----------------------------*/

       }
       else if (isset($_GET['enviar_ro'])) 
       {
           if(isset($_SESSION["correo"]))/*----------------------------*/
           {
           
                   $variable_ro = $_GET["variable_ro"];
                   $query = new Select();

                   $cadenacom = "SELECT producto from detalle_orden WHERE id_usuario = '$id_usr' and estado = 0 ";
                   $tablComa = $query->seleccionar($cadenacom);

                   $cadena = "SELECT * FROM productos WHERE categoria = '$variable_ro' and existencia > 0 ORDER BY existencia DESC LIMIT 6  ";
                   $tabla = $query->seleccionar($cadena);
                   foreach ($tabla as $datos) 
                   {
                   $comparande = $datos->cve_prod;
                   $estaEnCarrito = false;
               
               
                   echo "
                   <div class='card m-2'>
                       <a href='./producto.php?id=$datos->cve_prod'>
                           <img src='../fotos/$datos->imagen' style='width:250px; height:350px' class='card-img-top' height='300' alt='Product'/>
                       </a>
                       <div class='card-body'>
                           <p class='card-text fw-bold'>$datos->nombre_pro</p>
                           <small class='text-secondary'>$ $datos->precio</small>
                           <br>
                           <br>
                   ";
                       if($limites <= 5)
                       {
                           foreach ($tablComa as $datoComa) 
                           {
                               $comparar = $datoComa->producto;
                       
                               if ($comparar === $comparande) 
                               {
                                   $estaEnCarrito = true;
                                   break; // Rompe el bucle cuando se encuentra una coincidencia
                               }
                           }
                           if ($estaEnCarrito) {
                               echo "
                                   <a href='#'><div class='btn btn-sm btn-danger' type='button' style='height:30px;'> Ya esta dentro del carrito </div></a>
                               ";
                           }
                           else
                           {
                               echo "
                               <a href='../views/scripts/guardacarrito.php?id=$comparande' ><button class='btn btn-sm btn-dark' type='button' style='height:30px;'>Agregar al carrito</button></a>
                               ";
                           }
                       }
                       else
                       {
                           echo "
                           <a href='#' ><div class='btn btn-sm btn-danger' type='button' style='height:30px;'> Carrito Lleno </div></a>
                           ";
                       }
                   echo "
                       </div>
                   </div>
                   ";
               }
           }
           else/*----------------------------*/
           {
                   $variable_ro = $_GET["variable_ro"];
                   $query = new Select();

                   
                   $cadena = "SELECT * from productos WHERE categoria = '$variable_ro' and existencia > 0 ORDER BY existencia DESC LIMIT 6 ";
                   $tabla = $query->seleccionar($cadena);
                   foreach ($tabla as $datos) 
                   {
                       echo "
                       <div class='card m-2'>
                           <a href='./producto.php?id=$datos->cve_prod'>
                               <img src='../fotos/$datos->imagen' style='width:250px; height:350px' class='card-img-top' height='300' alt='Product'/>
                           </a>
                           <div class='card-body'>
                               <p class='card-text fw-bold'>$datos->nombre_pro</p>
                               <small class='text-secondary'>$ $datos->precio</small>
                               <br>
                               <br>
                               <a href='./login.php'><button class='btn btn-sm btn-dark' type='button' style='height:30px;'>Agregar al carrito</button></a>
                           </div>
                       </div>
                       ";
                   }

           }/*----------------------------*/

       }
       else if(isset($_GET['enviar_pa'])) 
       {
           if(isset($_SESSION["correo"]))/*----------------------------*/
           {
                       $variable_pa = $_GET["variable_pa"];
                       $query = new Select();

                       $cadenacom = "SELECT producto from detalle_orden WHERE id_usuario = '$id_usr' and estado = 0 ";
                       $tablComa = $query->seleccionar($cadenacom);

                       $cadena = "SELECT * from productos WHERE categoria = '$variable_pa' and existencia > 0 ORDER BY existencia DESC LIMIT 6 ";
                       $tabla = $query->seleccionar($cadena);
                       foreach ($tabla as $datos) 
                       {
                       $comparande = $datos->cve_prod;
                       $estaEnCarrito = false;
                   
                   
                       echo "
                       <div class='card m-2'>
                           <a href='./producto.php?id=$datos->cve_prod'>
                               <img src='../fotos/$datos->imagen' style='width:250px; height:350px' class='card-img-top' height='300' alt='Product'/>
                           </a>
                           <div class='card-body'>
                               <p class='card-text fw-bold'>$datos->nombre_pro</p>
                               <small class='text-secondary'>$ $datos->precio</small>
                               <br>
                               <br>
                       ";
                           if($limites <= 5)
                           {
                               foreach ($tablComa as $datoComa) 
                               {
                                   $comparar = $datoComa->producto;
                           
                                   if ($comparar === $comparande) 
                                   {
                                       $estaEnCarrito = true;
                                       break; // Rompe el bucle cuando se encuentra una coincidencia
                                   }
                               }
                               if ($estaEnCarrito) {
                                   echo "
                                       <a href='#'><div class='btn btn-sm btn-danger' type='button' style='height:30px;'> Ya esta dentro del carrito </div></a>
                                   ";
                               }
                               else
                               {
                                   echo "
                                   <a href='../views/scripts/guardacarrito.php?id=$comparande' ><button class='btn btn-sm btn-dark' type='button' style='height:30px;'>Agregar al carrito</button></a>
                                   ";
                               }
                           }
                           else
                           {
                               echo "
                               <a href='#' ><div class='btn btn-sm btn-danger' type='button' style='height:30px;'> Carrito Lleno </div></a>
                               ";
                           }
                       echo "
                           </div>
                       </div>
                       ";
                   }
           }
           else/*----------------------------*/
           {
                   $variable_pa = $_GET["variable_pa"];
                   $query = new Select();

                   
                   $cadena = "SELECT * from productos WHERE categoria = '$variable_pa' and existencia > 0 ORDER BY existencia DESC LIMIT 6 ";
                   $tabla = $query->seleccionar($cadena);
                   foreach ($tabla as $datos) 
                   {
                       echo "
                       <div class='card m-2'>
                           <a href='./producto.php?id=$datos->cve_prod'>
                               <img src='../fotos/$datos->imagen' style='width:250px; height:350px' class='card-img-top' height='300' alt='Product'/>
                           </a>
                           <div class='card-body'>
                               <p class='card-text fw-bold'>$datos->nombre_pro</p>
                               <small class='text-secondary'>$ $datos->precio</small>
                               <br>
                               <br>
                               <a href='./login.php'><button class='btn btn-sm btn-dark' type='button' style='height:30px;'>Agregar al carrito</button></a>
                           </div>
                       </div>
                       ";
                   }

           }/*----------------------------*/

       }
       else if(isset($_GET['enviar_ac'])) 
       {
           if(isset($_SESSION["correo"]))/*----------------------------*/
           {
                   $variable_ac = $_GET["variable_ac"];
                   $query = new Select();

                   
                   $cadena = "SELECT * from productos WHERE categoria = '$variable_ac' and existencia > 0 ORDER BY existencia DESC LIMIT 6 ";
                   $tabla = $query->seleccionar($cadena);
                   $cadenacom = "SELECT producto from detalle_orden WHERE id_usuario = '$id_usr' and estado = 0 ";
                   $tablComa = $query->seleccionar($cadenacom);
                   
                   foreach ($tabla as $datos) 
                   {
                       $comparande = $datos->cve_prod;
                       $estaEnCarrito = false;
                   
                   
                       echo "
                       <div class='card m-2'>
                           <a href='./producto.php?id=$datos->cve_prod'>
                               <img src='../fotos/$datos->imagen' style='width:250px; height:350px' class='card-img-top' height='300' alt='Product'/>
                           </a>
                           <div class='card-body'>
                               <p class='card-text fw-bold'>$datos->nombre_pro</p>
                               <small class='text-secondary'>$ $datos->precio</small>
                               <br>
                               <br>
                       ";
                           if($limites <= 5)
                           {
                               foreach ($tablComa as $datoComa) 
                               {
                                   $comparar = $datoComa->producto;
                           
                                   if ($comparar === $comparande) 
                                   {
                                       $estaEnCarrito = true;
                                       break; // Rompe el bucle cuando se encuentra una coincidencia
                                   }
                               }
                               if ($estaEnCarrito) {
                                   echo "
                                       <a href='#'><div class='btn btn-sm btn-danger' type='button' style='height:30px;'> Ya esta dentro del carrito </div></a>
                                   ";
                               }
                               else
                               {
                                   echo "
                                   <a href='../views/scripts/guardacarrito.php?id=$comparande' ><button class='btn btn-sm btn-dark' type='button' style='height:30px;'>Agregar al carrito</button></a>
                                   ";
                               }
                           }
                           else
                           {
                               echo "
                               <a href='#' ><div class='btn btn-sm btn-danger' type='button' style='height:30px;'> Carrito Lleno </div></a>
                               ";
                           }
                       echo "
                           </div>
                       </div>
                       ";
                   }
           }/*----------------------------*/
           else/*----------------------------*/
           {
                   $variable_ac = $_GET["variable_ac"];
                   $query = new Select();

                   
                   $cadena = "SELECT * from productos WHERE categoria = '$variable_ac' and existencia > 0 ORDER BY existencia DESC LIMIT 6 ";
                   $tabla = $query->seleccionar($cadena);
                   foreach ($tabla as $datos) 
                   {
                       echo "
                       <div class='card m-2'>
                           <a href='./producto.php?id=$datos->cve_prod'>
                               <img src='../fotos/$datos->imagen' style='width:250px; height:350px' class='card-img-top' height='300' alt='Product'/>
                           </a>
                           <div class='card-body'>
                               <p class='card-text fw-bold'>$datos->nombre_pro</p>
                               <small class='text-secondary'>$ $datos->precio</small>
                               <br>
                               <br>
                               <a href='./login.php'><button class='btn btn-sm btn-dark' type='button' style='height:30px;'>Agregar al carrito</button></a>
                           </div>
                       </div>
                       ";
                   }

           }/*----------------------------*/
       }
       else /*------------RECARGAR----------------*/
       {
                   $query = new Select();

                   $cadenacom = "SELECT producto from detalle_orden WHERE id_usuario = '$id_usr' and estado = 0 ";
                   $tablComa = $query->seleccionar($cadenacom);

           if(isset($_SESSION["correo"])) /*----------------------------*/
           {

                   $cadena = "SELECT * from productos WHERE existencia > 0 ORDER BY existencia DESC LIMIT 10 ";
                   $tabla = $query->seleccionar($cadena);
                   foreach ($tabla as $datos) 
                   {
                       $comparande = $datos->cve_prod;
                       $estaEnCarrito = false;
                   
                   
                       echo "
                       <div class='card m-2'>
                           <a href='./producto.php?id=$datos->cve_prod'>
                               <img src='../fotos/$datos->imagen' style='width:250px; height:350px' class='card-img-top' height='300' alt='Product'/>
                           </a>
                           <div class='card-body'>
                               <p class='card-text fw-bold'>$datos->nombre_pro</p>
                               <small class='text-secondary'>$ $datos->precio</small>
                               <br>
                               <br>
                       ";
                       
                           if($limites <= 5)
                           {
                               foreach ($tablComa as $datoComa) 
                               {
                                   $comparar = $datoComa->producto;
                           
                                   if ($comparar === $comparande) 
                                   {
                                       $estaEnCarrito = true;
                                       break; // Rompe el bucle cuando se encuentra una coincidencia
                                   }
                               }
                               if ($estaEnCarrito) {
                                   echo "
                                       <a href='#'><div class='btn btn-sm btn-danger' type='button' style='height:30px;'> Ya esta dentro del carrito </div></a>
                                   ";
                               }
                               else
                               {
                                   echo "
                                   <a href='../views/scripts/guardacarrito.php?id=$comparande' ><button class='btn btn-sm btn-dark' type='button' style='height:30px;'>Agregar al carrito</button></a>
                                   ";
                               }
                           }
                           else
                           {
                               echo "
                               <a href='#' ><div class='btn btn-sm btn-danger' type='button' style='height:30px;'> Carrito Lleno </div></a>
                               ";
                           }
                       echo "
                           </div>
                       </div>
                       ";
                   }
           }/*----------------------------*/
           else /*----------------------------*/
           {
               $query = new Select();
               $cadena = "SELECT * from productos WHERE existencia > 0 ORDER BY existencia DESC LIMIT 10 ";
               $tabla = $query->seleccionar($cadena);
               foreach ($tabla as $datos) 
               {
                   echo "
                       <div class='card m-2'>
                               <a href='./producto.php?id=$datos->cve_prod'>
                               <img src='../fotos/$datos->imagen' style='width:250px; height:350px' class='card-img-top' height='300' alt='Product'/>
                               </a>
                           <div class='card-body'>
                               <p class='card-text fw-bold'>$datos->nombre_pro</p>
                               <small class='text-secondary'>$ $datos->precio</small>
                               <br>
                               <br>
                               <a href='./login.php' ><button class='btn btn-sm btn-dark' type='button' style='height:30px;'>Agregar al carrito</button></a>
                           </div>
                       </div>
                   ";
               }

           }/*----------------------------*/
        
       }
       /*------------RECARGAR----------------*/
      
               
         
        ?>
        
</div>
</div>

</body>
</html>