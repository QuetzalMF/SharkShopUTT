<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRADORES</title>
    <link rel="shortcut icon" href="../assets/img/logo_sinfondo.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/icons/font/bootstrap-icons.css">
</head>
<body>
<?php
require("../../src/query/ejecuta.php");
require("../../src/query/select.php");

use MyApp\query\Select;
use MyApp\query\Ejecuta;


extract($_POST);
$id = $_GET["id"];

$select = new Select();
$consulta = "SELECT * FROM orden INNER JOIN detalle_orden ON orden.de_orden = detalle_orden.reg_det WHERE reg = $id ";
$query = $select->seleccionar($consulta);
foreach($query as $dato)
{
    $producto = $dato->producto;
    $unidades = $dato->unidades;
}

/* Suma la unidades a comprar de las existencia del producto */
$query = new Ejecuta();
$update = "UPDATE productos SET existencia = existencia + '$unidades' WHERE cve_prod = '$producto'";
$query->ejecutar($update);

/* Confimar la orden, evaluando a 1 el campo */
$queryM = new Ejecuta();
$updateM = "UPDATE orden SET Estado_v = 2 WHERE reg = $id";
$queryM->ejecutar($updateM); 
echo "<div class='alert alert-danger'> Orden Cancelada </div>";
header("refresh:1; misventas.php");
                         
?>
</body>
</html>