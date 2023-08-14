<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Administrador/assets/css/bootstrap.min.css">
    <script src="../boostrap/js/bootstrap.min.js"></script>
    <title>Carrito</title>
</head>
<body>
    <table class="table table-hover">
                <thead class="table-dark">
                  <tr>
                    <td>Nombre</td>
                    <td>Precio</td>
                    <td>Unidades a comprar</td>
                    <td>Talla</td>
                    <td>Color</td>
                    <td>Genero</td>
                    <td>Imagen</td>
                    <td>Categoria</td>
                    <td>Eliminar</td>
                  </tr>
                </thead>
    <?php

require("../src/query/select.php");
    use MyApp\query\Select;

    require("../vendor/autoload.php");

    session_start();

    echo $_SESSION["correo"] . " ";
    $tel_celular = $_SESSION["tel_celular"];

     /* obtener id  */
     $queryD = new Select();
     $cadenaD = "SELECT * from usuario INNER JOIN persona ON usuario.persona = persona.id_persona where tel_celular = '$tel_celular' ";
     $miconsultaD = $queryD->seleccionar($cadenaD);
     foreach( $miconsultaD as $dato)
     {
         $usuario = $dato->id_usr;
     }


    

    /*SABER EL LIMITE DEL CARRITO*/
    $queryC = new Select(); 
    $cadenaC = "SELECT COUNT(reg_det) as total from detalle_orden where id_usuario = '$usuario' and estado = 0 ";
    $miconsultaC = $queryC->seleccionar($cadenaC);

    foreach( $miconsultaC as $datos => $arreglo)
    {
        foreach($arreglo as $Key => $value)
        {
            $limites = $value;
            echo "<span class='badge rounded-pill bg-secondary'>$limites</span> "; 
        }
    }
    if( $limites > 5)
    {
       echo "<span class='badge rounded-pill bg-secondary'>Estas excediendo el limite de compras</span> "; 
    }
    /*SABER EL LIMITE DEL CARRITO*/




    $variable = new Select();
    $cadenaM = "SELECT * from detalle_orden INNER JOIN  productos P ON detalle_orden.producto = P.cve_prod 
                                             INNER JOIN categoria_prenda C ON P.categoria = C.cve_pcat
    WHERE id_usuario = '$usuario' AND estado = 0 ";
    $consulta = $variable->seleccionar($cadenaM);
    if ($consulta == true)
    { 
      foreach($consulta as $datos)
      { 
              $unidades = $datos->unidades;
              $precio = $datos->precio;
              $subtotal = $subtotal + $precio;
              
                echo "
                        <tbody>
                            <tr>
                                <td>$datos->nombre_pro</td>
                                <td>$precio</td>
                                <td>$unidades</td>
                                <td>$datos->talla</td>
                                <td>$datos->color</td>
                                <td>$datos->genero</td>
                                <td>$datos->imagen</td>
                                <td>$datos->prenda</td>
                                  <form action='../views/scripts/eliminaruno.php' method='POST'>
                                  <input type='hidden' value='$datos->reg_det' name='reg_det'>
                                <td><button type='submit' class='btn btn-danger' name='eliminar'>Eliminar</button>
                                  </form>
                                </td>
                              </tr>
                        
                        ";
                    $dato_importante = $datos->unidades;
                
              
        }
    }
    else if($consulta == false)
    {
      echo "<tr>
              <td colspan='9'> <div class='alert alert-danger'> No hay productos en el carrito </div> </td>
            </tr>";
    }
      $IVA = $subtotal - ($subtotal / 1.21) ;
      $total = $subtotal + $IVA;    
    ?>




    <!-- saber las unidades de cada producto y hacer comparaciones -->
    <?php 

    $queryU = new Select(); 
    $cadenaU = "SELECT * from detalle_orden where id_usuario = '$usuario' and estado = 0 ";
    $miconsultaU = $queryU->seleccionar($cadenaU);
    foreach($miconsultaU as $datos)
    {

      $unidad = $datos -> producto;
      echo "<h1>" . $unidad  . "</h1>";
      echo $totall = $totall + $unidad;
      

    }
    ?>
    <!-- saber las unidades de cada producto y hacer comparaciones -->








          <tr>
            <td colspan='9'> EL SUBTOTAL es: <?php echo number_format($subtotal); ?> </td>
          </tr>
          <tr>
            <td colspan='9'> EL IVA es: <?php echo number_format($IVA); ?> </td>
          </tr>
          <tr>
            <td colspan='9'> EL TOTAL es: <?php echo number_format($total); ?> </td>
          </tr>
        </tbody>
    </table>
    <a href='../views/scripts/eliminar.php'><button type='submit' class='btn btn-danger' name='eliminar'>Eliminar todo el carrito</button></a>
    <a href='../views/scripts/compra.php'><button type="submit" class="btn btn-success" name="comprar" value="guardar">Comprar</button></a>
    

</body>
</html>





