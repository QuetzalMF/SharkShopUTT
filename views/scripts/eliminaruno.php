<?php
require("../../src/query/ejecuta.php");
require("../../src/query/select.php");
require("../../src/data/database.php");
use MyApp\Data\MysqlConexion;
use MyApp\query\Select;
use MyApp\query\Ejecuta;


    session_start();

    extract($_POST);


    $tel_celular = $_SESSION["tel_celular"];

    $reg_det=$_POST["reg_det"];
    /* obtener id  */
    $queryEJE = new Ejecuta();
    $update = "DELETE FROM detalle_orden WHERE reg_det = '$reg_det' ";
    $miconsultaU = $queryEJE->ejecutar($update);
    header("Location: ../../Vista_Usuario/vistacarro.php");


?>