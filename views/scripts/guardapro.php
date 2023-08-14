<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../boostrap/css/bootstrap.min.css" type="text/css">
    <script src="../../../boostrap/js/bootstrap.min.js"></script>
    <title>Registro</title>
</head>
<body>
    <div class="container">
        <?php 
          
          require("../../src/query/ejecuta.php");
          require("../../src/data/database.php");
          
          use MyApp\query\Ejecuta;
          use MyApp\data\Database;

          $insert = new ejecuta();

          extract($_POST);
          
          if(isset($_POST["agregar"]))
          {
            if (!empty($_POST["nombre_pro"]) and !empty($_POST["precio"]) and !empty($_POST["color"]))
            {

              extract($_FILES);
              $dir       =  __DIR__.'/../../fotos/';
              $pathinfo  =  pathinfo($_FILES["imagen"]["name"]);
              $filename  =  $pathinfo["filename"];
              $extension =  $pathinfo["extension"];
              $name      =  time() . ".{$extension}";
              $real_path =  "{$dir}{$name}";
              move_uploaded_file($_FILES["imagen"]["tmp_name"], $real_path);
              $name = isset($_POST["imagen"]) ? $_POST["imagen"] : null;
              // Si no se proporcionó ningún valor, establecer uno predeterminado
              if ($extension == null)
              {
                  $valorPredeterminado = "1691104512.jpg"; // IMAGEN POR PREDETERMINADO
                  $name = $valorPredeterminado;
              }

              $cadena = "INSERT INTO productos(nombre_pro, precio, existencia, talla, color, genero, descripcion, imagen, categoria) 
              VALUES ('$nombre_pro', '$precio','$existencia','$talla','$color','$genero','$descripcion','$name',$categoria)";  
              $consulta = $insert->ejecutar($cadena); 
              if($consulta = true)
              {
                echo "<div class='alert alert-success'> Producto Registrado </div>";
                header("Refresh:1; ../../Administrador/index.php");
              }
              else
              {
                echo "<div class='alert alert-danger'> Error al agregar </div>";
                header("Refresh:1; ../../Administrador/index.php");
              }

            }
            else
            {
                echo "<div class='alert alert-danger'> Campos vacios </div>";
                header("Refresh:1; ../../Administrador/index.php");
            }
              
          }

         
          
          
        

        ?>
    </div>
</body>
</html>

