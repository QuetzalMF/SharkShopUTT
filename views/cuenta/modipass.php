<?php

require("../../src/query/ejecuta.php");
require("../../src/query/select.php");

use MyApp\query\Ejecuta;
use MyApp\query\Select;

session_start();
$tel_celular = $_SESSION['tel_celular'];

extract($_POST);

$original = $_POST['original'];
$pass = $_POST['pass'];

$objetoPDO = new Select();
$query = "SELECT pass FROM usuario INNER JOIN persona ON persona.id_persona = usuario.persona WHERE tel_celular = '$tel_celular' ";
$consulta = $objetoPDO->seleccionar($query);
foreach( $consulta as $datos)
{
    $contra = $datos->pass;
}
    if (password_verify($original , $contra))
    {
        /* Seleccionar el ID de la persona */
        $queryS = new Select();
        $cadenaS = "SELECT id_persona FROM persona where tel_celular = '$tel_celular' ";
        $tabla = $queryS->seleccionar($cadenaS);
        foreach($tabla as $dato)
        {$persona = $dato->id_persona;}
        /* Seleccionar el ID de la persona */

        $query = new Ejecuta();
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $cadena = "UPDATE usuario SET pass='$hash' WHERE persona = '$persona' ";
        //$consulta = $query->ejecutar($cadena);
        header("Location: ../../Vista_Usuario/micuenta.php");
    }
    else
    {
        echo "<div class='alert alert-success'> Contraseña incorrecta </div>";
    }

?>