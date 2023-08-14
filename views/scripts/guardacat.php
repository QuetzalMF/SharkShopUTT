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
          $cadena = "INSERT INTO categoria_prenda(prenda) 
          VALUES ('$prenda')";
          $insert -> ejecutar($cadena);
          echo "<div class='alert alert-success'> Categoria registrada </div>";
          /*Registro exitoso y despues se dirige a la pagina principal*/
          header("Location: ../../Administrador/agcat.php");
          
        

        ?>
    </div>
</body>
</html>

