<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../css/bootstrap.min.css" type="text/css">
    <script src="../../js/bootstrap.min.js"></script>
    <!-- Bootstrap CSS v5.2.0-beta1 -->
  </head>
  <body>
    <?php

        require("../../src/query/ejecuta.php");
        require("../../src/query/select.php");
        require("../../src/data/database.php");
        use MyApp\Data\MysqlConexion;
        use MyApp\query\Select;
        use MyApp\query\Ejecuta;

        session_start();
        $producto=$_GET["id"];
        $tel_celular = $_SESSION["tel_celular"];
        $unidades = 1;
        $estado = 0;
        /* agregar producto */
        $query = new Select();
        $cadenas = "SELECT * from usuario INNER JOIN persona ON usuario.persona = persona.id_persona where tel_celular = '$tel_celular' ";
        $miconsulta = $query->seleccionar($cadenas);
        foreach( $miconsulta as $dato)
        {
            $usuario = $dato->id_usr;
        }
        $queryUp = new Ejecuta();
        $cadena = "INSERT INTO detalle_orden(unidades, id_usuario, producto, estado) VALUES ('$unidades', $usuario, $producto, '$estado')";
        $consulta = $queryUp->ejecutar($cadena);
        header("Location: ../../Vista_Usuario/listaproductos_ropa.php");

        

    ?>
</body>
</html>
