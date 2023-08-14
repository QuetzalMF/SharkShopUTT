<?php
require("../../src/query/ejecuta.php");
require("../../src/query/select.php");

use MyApp\query\Ejecuta;
use MyApp\query\Select;
require("../../vendor/autoload.php");

session_start();
$original = $_SESSION['tel_celular'];

extract($_POST);

$correo = $_POST["correo"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$telefono = $_POST["telefono"];


/* Paso 1 */
$queryuno = new Select();
$updateuno = "UPDATE persona SET nombre='$nombre', apellidos='$apellido', tel_celular='$telefono' WHERE tel_celular = $original";
$consultauno = $queryuno->seleccionar($updateuno);
/* Paso 1 */

/* Seleccionar el ID de la persona */
$query = new Select();
$cadena = "SELECT id_persona FROM persona where tel_celular = '$original' ";
$tabla = $query->seleccionar($cadena);
foreach($tabla as $dato)
{$persona = $dato->id_persona;}
/* Seleccionar el ID de la persona */

/* Paso 2 */
$querydos = new Select();
$updatedos = "UPDATE usuario SET correo='$correo' WHERE persona = '$persona' ";
$consultados = $querydos->seleccionar($updatedos);
/* Paso 2 */
header("Location: ../../Vista_Usuario/micuenta.php");


?>