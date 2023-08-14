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
        require("../../src/query/select.php");
        require("../../src/data/database.php");
        use MyApp\Data\MysqlConexion;
        use MyApp\query\Select;
        use MyApp\query\Ejecuta;
          
          session_start();
          extract($_POST);
          $nombre=$_POST["nombre"];
          $cve_prod=$_POST["cve_prod"];
          $talla=$_POST["talla"];
          $tel_celular = $_SESSION["tel_celular"];
          $existencia_n = $_POST["existencia_n"];
          $estado = 0;

           /* agregar producto */
          $query = new Select();
          $cadena = "SELECT * from usuario INNER JOIN persona ON usuario.persona = persona.id_persona where tel_celular = '$tel_celular' ";
          $miconsulta = $query->seleccionar($cadena);
          foreach( $miconsulta as $dato)
          {
              $usuario = $dato->id_usr;
          }
          $queryUp = new Ejecuta();
          $cadena = "INSERT INTO detalle_orden(unidades, id_usuario, producto, estado) 
          VALUES ('$existencia_n', $usuario, $cve_prod, '$estado')";
          $queryUp -> ejecutar($cadena);
          echo "<div class='alert alert-success'> Producto Registrado </div>";
          header("Location: ../../Vista_Usuario/listaproductos_ropa.php");
         
          

         

        ?>
    </div>
</body>
</html>
