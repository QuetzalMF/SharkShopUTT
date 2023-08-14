<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Administrador/assets/css/bootstrap.min.css">
    <script src="../boostrap/js/bootstrap.min.js"></script>
    <title>Carrito de Compra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 50px;
        }

        h2 {
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .total {
            font-weight: bold;
            text-align: right;
        }

        .carrito-table-btn {
            text-align: right;
            margin-top: 20px;
        }

        .carrito-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .carrito-btn:hover {
            background-color: #45a049;
        }

        .comprar-btn {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Carrito de Compra</h2>
        <?php
        $fecha_actual = date('Y-m-d');
        echo "<p>Fehca del carrito: $fecha_actual</p>";

        $fecha_actual = $datos->fecha_orden; // Obtenemos la fecha actual en formato 'Y-m-d'
        $nueva_fecha = date('Y-m-d', strtotime($fecha_actual . ' +15 days'));
        echo "<p>Fecha limite: $nueva_fecha</p>";
        ?>
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Unidades a comprar</th>
                    <th>Talla</th>
                    <th>Color</th>
                    <th>Genero</th>
                    <th>Imagen</th>
                    <th>Categoria</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
            <?php
            require("../src/query/select.php");
            use MyApp\query\Select;
            

            session_start();
            if (isset($_SESSION["correo"]) && isset($_SESSION["tel_celular"])) 
            {
                $tel_celular = $_SESSION["tel_celular"];

                /* obtener id  */
                $queryD = new Select();
                $cadenaD = "SELECT * from usuario INNER JOIN persona ON usuario.persona = persona.id_persona where tel_celular = '$tel_celular' ";
                $miconsultaD = $queryD->seleccionar($cadenaD);
                foreach ($miconsultaD as $dato) {
                    $usuario = $dato->id_usr;
                }

                /* SABER SI EL CARRITO YA FUE COMPRADO O NO */
                $subtotal = 0; // Inicializamos la variable $subtotal
                $query = new Select();
                $cadena = "SELECT * from detalle_orden D INNER JOIN  productos P ON D.producto = P.cve_prod 
                                                 INNER JOIN categoria_prenda C ON P.categoria = C.cve_pcat
                WHERE id_usuario = '$usuario' and D.estado = 0 ";
                $tabla = $query->seleccionar($cadena);
                foreach ($tabla as $datos) {
                    $precio = $datos->precio;
                    $subtotal = $subtotal + $precio;
                    echo "
                    <tr>
                        <td>" . (isset($datos->nombre_pro) ? $datos->nombre_pro : '') . "</td>
                        <td>$ $precio</td>
                        <td>" . (isset($datos->unidades) ? $datos->unidades : '') . "</td>
                        <td>" . (isset($datos->talla) ? $datos->talla : '') . "</td>
                        <td>" . (isset($datos->color) ? $datos->color : '') . "</td>
                        <td>" . (isset($datos->genero) ? $datos->genero : '') . "</td>
                        <td><img src='" . (isset($datos->imagen) ? $datos->imagen : '') . "' alt='Imagen' width='100'></td>
                        <td>" . (isset($datos->prenda) ? $datos->prenda : '') . "</td>
                            <form action='../views/scripts/eliminaruno.php' method='POST'>
                            <input type='hidden' value='$datos->reg_det' name='reg_det'>
                        <td>
                            <button type='submit' class='btn btn-danger' name='eliminar'>Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    ";
                    $dato_importante = $datos->unidades;
                }

                $IVA = $subtotal - ($subtotal / 1.21);
                $total = $subtotal + $IVA;

                echo "
                    <tr>
                        <td colspan='9'> EL SUBTOTAL es: " . number_format($subtotal) . " </td>
                    </tr>
                    <tr>
                        <td colspan='9'> EL IVA es: " . number_format($IVA) . " </td>
                    </tr>
                    <tr>
                        <td colspan='9'> EL TOTAL es: " . number_format($total) . " </td>
                    </tr>
                ";
            }
            ?>
            </tbody>
        </table>
        <div class="carrito-table-btn">
                <a href='../views/scripts/eliminar.php'><button type='submit' class='carrito-btn btn btn-success' name='eliminar'>Eliminar todo el carrito</button></a>
            <br>
            <?php
            /*SABER EL LIMITE DEL CARRITO*/
            $queryC = new Select(); 
            $cadenaC = "SELECT COUNT(reg_det) as total from detalle_orden where id_usuario = '$usuario' and estado = 0 ";
            $miconsultaC = $queryC->seleccionar($cadenaC);

            foreach( $miconsultaC as $datos => $arreglo)
            {
                foreach($arreglo as $Key => $value)
                {
                    $limites = $value;
                }
            }
            if( $limites > 5)
            {
                echo "<div class='alert alert-danger'><center> Limite de productos MAX 5 </center></div>";  
            }
            else if($limites == 0 )
            {
                echo "<div class='alert alert-danger'><center> No hay productos </center></div>";  
            }
            else
            {
            /*SABER EL LIMITE DEL CARRITO*/
            ?>
        </div>
        <?php if (isset($_SESSION["correo"]) && isset($_SESSION["tel_celular"])): ?>
            <div class="comprar-btn">
                <a href='../views/scripts/compra.php'><button type="submit" class="btn btn-success" name="comprar" value="guardar">COMPRAR</button></a>
                
            </div>
        <?php 
            endif; 

            }
        ?>

        <?php

        if ($fecha_actual >= $nueva_fecha) 
        {
            $cadena = "SELECT * from detalle_orden D INNER JOIN  productos P ON D.producto = P.cve_prod 
            INNER JOIN categoria_prenda C ON P.categoria = C.cve_pcat
            WHERE id_usuario = '$usuario' ";
            $tabla = $query->seleccionar($cadena);
            foreach($tabla as $datos)
            {
                $producto = $datos->cve_prod;
                $unidades = $datos->unidades;
                
                $queryEJE = new Ejecuta();
                $update = "DELETE FROM detalle_orden WHERE id_usuario ='$usuario' AND producto = '$producto'";
                $consulta = $queryEJE->ejecutar($update);
                header("Location: ../../Vista_Usuario/vistacarro.php");

            }
        }

        s
        /* $rapido = new Select();
        $consulta = "SELECT  COUNT(*) AS cantidad_registros_duplicados FROM (SELECT * from detalle_orden D INNER JOIN  productos P ON D.producto = P.cve_prod 
        INNER JOIN categoria_prenda C ON P.categoria = C.cve_pcat WHERE D.id_usuario = 105 and D.estado = 0) as RV WHERE RV.cve_prod GROUP BY RV.cve_prod HAVING COUNT(*) > 1";
        $cadena = $rapido->seleccionar($consulta);
        foreach( $cadena as $datos => $arreglo)
        {
            foreach($arreglo as $Key => $value)
            {
            

               $resultado = $value * $precio;
             
               echo "<h1>" . $resultado . " </h1> <br>";

                
            }
        }*/
        
        ?>
        
    </div>
</body>
</html>
