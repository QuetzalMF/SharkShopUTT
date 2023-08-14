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
require_once "../../src/query/Select.php"; // Asegúrate de incluir la ubicación correcta del archivo Select.php
require_once "../../src/query/Ejecuta.php"; // Asegúrate de incluir la ubicación correcta del archivo Ejecuta.php
require_once "../../src/data/database.php"; // Asegúrate de incluir la ubicación correcta del archivo Mysqlconexion.php
use MyApp\query\Select;
use MyApp\query\Ejecuta;
use MyApp\Data\Mysqlconexion;

// No es necesario requerir el autoload

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

/* Confimar la orden, evaluando a 1 el campo */
$queryM = new Ejecuta();
$updateM = "UPDATE orden SET Estado_v = 2 WHERE reg = $id";
$queryM->ejecutar($updateM); 
header("Location: ../ventas.php");



// $valor = 15;  
// $fecha = "2023-08-" .$valor;
// Fecha objetivo (puedes cambiar esta fecha por la que necesites)
//$fechaObjetivo = strtotime($fecha);
// Fecha actual
//$fechaActual = time(); 

/*echo $orden->fecha_orden;
                                        2023-08-02
                                        $valor = 15;  
                                        $fecha = "2023-08-" +$valor;
                                        // Fecha objetivo (puedes cambiar esta fecha por la que necesites)
                                        $fechaObjetivo = strtotime($fecha);
    
                                        // Fecha actual
                                        $fechaActual = time();
    
                                        if ($fechaActual >= $fechaObjetivo) {
                                            // Si la fecha actual es igual o después de la fecha objetivo
                                            $valorNuevo = "¡Es el día deseado!"; // Cambia esto por el valor que quieras enviar
                                        } else {
                                            // Si todavía no se ha alcanzado la fecha objetivo
                                            $diferenciaSegundos = $fechaObjetivo - $fechaActual;
                                            $diferenciaDias = ceil($diferenciaSegundos / (60 * 60 * 24));
                                            $valorNuevo = "Días restantes: " . $diferenciaDias;
                                        }
                                        echo "<td><center>$valorNuevo</center></td>"; */                          
?>
</body>
</html>