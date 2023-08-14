<?php
require("../../src/query/login.php");
use MyApp\query\Login;

$sesion = new Login();
$sesion->cerrarsesion();
?>