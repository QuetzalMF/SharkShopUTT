<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style_index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    

    <title>PRODUCTO</title>
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <nav class="navbar navbar-expand-lg navbar-light bg-light position-relative top-0 start-0 w-100">
        <div class="container">

            <a href="../index.php" class="navbar-brand d-lg-none">
                SHARKSHOP
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon" ></span>
            </button>

            <div class="collapse navbar-collapse p-2 flex-column" id="navbarContent">
                <div class="d-flex justify-content-center justify-content-lg-between flex-column flex-lg-row w-100" >
                    <a href="../index.php" class="navbar-brand d-none d-lg-block">SHARKSHOP</a>
                    <ul class="navbar-nav">
                    <?php 
                    
                    require("../src/query/select.php");
                    use MyApp\query\Select;

                                session_start();
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
                            $cadenaC = "SELECT COUNT(reg_det) as total from detalle_orden where id_usuario = '$id_usr' and estado = 0";
                            $miconsultaC = $queryC->seleccionar($cadenaC);

                            foreach( $miconsultaC as $datos => $arreglo)
                            {
                                foreach($arreglo as $Key => $value)
                                {
                                    $limites = $value;
                                    echo "<span class='badge rounded-pill bg-secondary'>$limites</span> "; 
                                }
                            }
                            ?>
                            
                        </li>
                        <?php
                        }
                        else{
                        ?>
                        <li class="nav-item d-flex align-items-center">
                            <a href="./login.php" class="nav-link mx-2">
                                <i class="fas fa-user"></i><i class="bi bi-person"></i>
                                Login
                            </a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a href="./vistacarro.php" class="nav-link mx2" >
                                <i class="fas fa-shopping-bag"></i><i class="bi bi-cart2"></i>
                                Carrito
                            </a>
                            <span class='badge rounded-pill bg-secondary'><?php $limites=0 ?></span> 
                        </li>
                        <?php
                        }
                        ?>
                        
                        
                    </ul>
                </div>
            </div>
        </div>
    </nav>
        <?php
            
            /*Saber si estan en el carrito o no? */
                
        if(isset($_SESSION["correo"]))
        { 
            $query = new Select();
                $id=$_GET["id"];
                $cadenacom = "SELECT producto from detalle_orden WHERE id_usuario = '$id_usr' and estado = 0 ";
                $tablComa = $query->seleccionar($cadenacom);

                $cadena = "SELECT * from productos where cve_prod = '$id'";
                $tabla = $query->seleccionar($cadena);
                foreach ($tabla as $dato) 
                {
                    $comparande = $dato->cve_prod;
                    $estaEnCarrito = false;

                    $dato_importante = $dato->existencia;
                    if($dato_importante > 0)
                    { 
                        echo "
                        <div class='row py-5 g-5'>
                        <div class='col-12 col-lg-6'>
                            <img src='../fotos/$dato->imagen' alt='' class='m-1 w-100 sliderMainImage'/>
                            <div>
                                <img src='../fotos/$dato->imagen' width='100' class='m-1 sliderThumb'/>
                                <img src='../fotos/$dato->imagen' width='100' class='m-1 sliderThumb'/>
                            </div>
                        </div>
                        <div class='col-12 col-lg-6'>
                            <form action='../views/scripts/GUARCAR.php' method='post'> 
                                <h2 id='productName'> $dato->nombre_pro </h2>
                                <input type='hidden' class='form-control' name='nombre' value='$dato->nombre_pro'>

                                <small class='text-muted'> ID: $dato->cve_prod </small>
                                <input type='hidden' class='form-control' name='cve_prod' value='$dato->cve_prod'>

                                <h4 class='my-4'> $ $dato->precio</h4>

                                <label for='selectSize' class='text-muted'> Talla: $dato->talla</label>

                                <h4 class='my-4'>Existencias: $dato_importante </h4>

                                <label for='selectSize' class='text-muted'>Cuantos vas a comprar?</label>
                                <input type='number' min='1' max='$dato_importante'  class='form-control' name='existencia_n' value='1'> 
                        ";
                        /* agregar limitante de numeros  */

                            
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
                                        if($estaEnCarrito)
                                        {
                                            echo "
                                            <div class='d-grid my-4'>
                                                <div class='btn btn-lg btn-danger'>Este producto ya esta en el carrito</div>
                                            </div>
                                            ";
                                        }
                                        else 
                                        {
                                            echo "
                                            <div class='d-grid my-4'>
                                            <button class='btn btn-lg btn-dark' type='submit' id='carbtn'>Agregar al carrito</button>
                                            </div>
                                            ";
                                        }
                                    
                                }
                                else
                                {
                                    echo "
                                    <div class='d-grid my-4'>
                                        <div class='btn btn-lg btn-danger'>Carrito lleno (Max 5 productos)</div>
                                    </div>
                                    ";
                                }

                            

                        echo"        
                            </form>
                                <div class='accordion'>
                                    <div class='accordion-item'>
                                        <h2 class='accordion-header' id='hOne'>
                                            <button class='accordion-button' style='background-color: black; color: white;' type='button' data-bs-toggle='collapse' data-bs-target='#One' aria-expanded='true' aria-controls='One'>
                                                <strong>Descripción</strong>
                                            </button>
                                        </h2>
                                        <div id='One' class='accordion-collapse collapse show' aria-labelledby='hOne'>
                                            <div class='accordion-body'>$dato->descripcion</div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                        </div>
                        ";
                    }
                    /* ---------------------------------------- SABER QUE ESTA FUERA DE STOCK ---------------------------------------- */
                    else if($dato_importante == 0)
                    {
                        echo "
                        <div class='row py-5 g-5'>
                        <div class='col-12 col-lg-6'>
                            <img src='../fotos/$dato->imagen' alt='' class='m-1 w-100 sliderMainImage'/>
                            <div>
                                <img src='../fotos/$dato->imagen' width='100' class='m-1 sliderThumb'/>
                                <img src='../fotos/$dato->imagen' width='100' class='m-1 sliderThumb'/>
                            </div>
                        </div>
                        <div class='col-12 col-lg-6'>
                            <form action='../views/scripts/GUARCAR.php' method='post'> 
                                <h2 id='productName'> $dato->nombre_pro </h2>
                                <input type='hidden' class='form-control' name='nombre' value='$dato->nombre_pro'>

                                <small class='text-muted'> ID: $dato->cve_prod </small>
                                <input type='hidden' class='form-control' name='cve_prod' value='$dato->cve_prod'>

                                <h4 class='my-4'> $ $dato->precio</h4>

                                <label for='selectSize' class='text-muted'> Talla: $dato->talla</label>

                                <h4 class='my-4'>Existencias: $dato->existencias </h4>

                                <label for='selectSize' class='text-muted'>Cuantos vas a comprar?</label>
                                <input type='number' min='1' max='$dato_importante'  class='form-control' name='existencia_n' value='1'> 
                        ";
                        /* agregar limitante de numeros  */

                            
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
                                        if($estaEnCarrito)
                                        {
                                            echo "
                                            <div class='d-grid my-4'>
                                                <div class='btn btn-lg btn-danger'>Este producto ya esta en el carrito</div>
                                            </div>
                                            ";
                                        }
                                        else 
                                        {
                                            echo "
                                            <div class='d-grid my-4'>
                                            <div class='btn btn-lg btn-danger'id='carbtn'>Producto fuera de Stock</div>
                                            </div>
                                            ";
                                        }
                                    
                                }
                                else
                                {
                                    echo "
                                    <div class='d-grid my-4'>
                                        <div class='btn btn-lg btn-danger'>Carrito lleno (Max 5 productos)</div>
                                    </div>
                                    ";
                                }

                        echo"        
                            </form>
                                <div class='accordion'>
                                    <div class='accordion-item'>
                                        <h2 class='accordion-header' id='hOne'>
                                            <button class='accordion-button' style='background-color: black; color: white;' type='button' data-bs-toggle='collapse' data-bs-target='#One' aria-expanded='true' aria-controls='One'>
                                                <strong>Descripción</strong>
                                            </button>
                                        </h2>
                                        <div id='One' class='accordion-collapse collapse show' aria-labelledby='hOne'>
                                            <div class='accordion-body'>$dato->descripcion</div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                        </div>
                        ";
                    }
                }
                

        }
        else
        {
                $queryM = new Select();
                $id=$_GET["id"];
                $cadenaS = "SELECT * from productos where cve_prod = '$id' ";
                $tablas = $queryM->seleccionar($cadenaS);
                foreach ($tablas as $dato) 
                {
                $dato_importante = $dato->existencia;
                echo "
                            <div class='row py-5 g-5'>
                            <div class='col-12 col-lg-6'>
                                <img src='../fotos/$dato->imagen' alt='' class='m-1 w-100 sliderMainImage'/>
                                <div>
                                    <img src='../fotos/$dato->imagen' width='100' class='m-1 sliderThumb'/>
                                    <img src='../fotos/$dato->imagen' width='100' class='m-1 sliderThumb'/>
                                </div>
                            </div>
                            <div class='col-12 col-lg-6'>
                                <form action='../views/scripts/GUARCAR.php' method='post'> 
                                    <h2 id='productName'> $dato->nombre_pro </h2>
                                    <input type='hidden' class='form-control' name='nombre' value='$dato->nombre_pro'>

                                    <small class='text-muted'> ID: $dato->cve_prod </small>
                                    <input type='hidden' class='form-control' name='cve_prod' value='$dato->cve_prod'>

                                    <h4 class='my-4'> $ $dato->precio</h4>

                                    <label for='selectSize' class='text-muted'> Talla: $dato->talla</label>

                                    <h4 class='my-4'>Existencias: $dato_importante </h4>

                                    <label for='selectSize' class='text-muted'>Cuantos vas a comprar?</label>
                                    <input type='number' min='1' max='$dato_importante'  class='form-control' name='existencia_n' value='1'> 
                    ";
                    echo "
                    <div class='d-grid my-4'>
                    <button class='btn btn-lg btn-dark' id='carbtn'><a href='login.php' style='text-decoration: none; color: white;'>Agregar al carrito</a></button>
                    </div>
                    ";

                    echo"        
                            </form>
                                <div class='accordion'>
                                    <div class='accordion-item'>
                                        <h2 class='accordion-header' id='hOne'>
                                            <button class='accordion-button' style='background-color: black; color: white;' type='button' data-bs-toggle='collapse' data-bs-target='#One' aria-expanded='true' aria-controls='One'>
                                                <strong>Descripción</strong>
                                            </button>
                                        </h2>
                                        <div id='One' class='accordion-collapse collapse show' aria-labelledby='hOne'>
                                            <div class='accordion-body'>$dato->descripcion</div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                        </div>
                        ";
                }
            
        }




        ?>
    </body>
    </html>

    <!-- php 


     echo "
                                    <div class='d-grid my-4'>
                                    <div class='btn btn-lg btn-danger'id='carbtn'>Producto fuera de Stock</div>
                                    </div>
                                    ";

                                    

            foreach($miconsulta as $datos)
            {
                echo "
                <h2 id='productName'> $datos->nombre_pro </h2>
                <small class='text-muted'> ID: $datos->cve_prod</small>
                <h4 class='my-4'> $ $datos->precio</h4>
                <label for='selectSize' class='text-muted'>$datos->talla</label>
                ";

                echo "
                <div class='d-grid my-4'>
                <a href='../views/scripts/guardacarrito.php?id=$datos->cve_prod' ><button class='btn btn-lg btn-dark' type='button' id='carbtn'>Agregar al carrito</button></a>
                </div>
                ";
            } 
            <div class="accordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="hOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#One" aria-expanded="true" aria-controls="One">
                            <strong>Descripción</strong>
                        </button>
                    </h2>
                    <div id="One" class="accordion-collapse collapse show" aria-labelledby="hOne">
                        <div class="accordion-body">Playera negra con estampado de ángel</div>
                    </div>
                </div>
            </div>
        </div>-->