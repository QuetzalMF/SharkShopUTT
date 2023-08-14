<?php
require("../../src/query/ejecuta.php");
require("../../src/data/database.php");
use MyApp\Data\MysqlConexion;
use MyApp\query\Ejecuta;

extract($_POST);
$id = $_GET["id"];
$query = new Ejecuta();
$consulta = "UPDATE productos SET existencia = 0 WHERE cve_prod = $id";
$query->ejecutar($consulta);
header("Location: ../../Administrador/index.php");

?>