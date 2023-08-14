<?php
require("../../src/query/ejecuta.php");
require("../../src/query/select.php");
require("../../src/data/database.php");
use MyApp\Data\MysqlConexion;
use MyApp\query\Select;
use MyApp\query\Ejecuta;

session_start();
$tel_celular = $_SESSION["tel_celular"];
/* obtener id  */
$queryD = new Select();
$cadenaD = "SELECT * from usuario INNER JOIN persona ON usuario.persona = persona.id_persona where tel_celular = '$tel_celular' ";
$miconsultaD = $queryD->seleccionar($cadenaD);
foreach( $miconsultaD as $dato)
{
    $usuario = $dato->id_usr;
}
$query = new Select();
$cadena = "SELECT * from detalle_orden D INNER JOIN  productos P ON D.producto = P.cve_prod 
INNER JOIN categoria_prenda C ON P.categoria = C.cve_pcat
WHERE id_usuario = '$usuario' AND estado = 0";
$tabla = $query->seleccionar($cadena);
foreach($tabla as $datos)
{
    $reg = $datos->reg_det;
    $producto = $datos->cve_prod;
    $unidades = $datos->unidades;
    $queryEJE = new Ejecuta();
    $update = "DELETE FROM detalle_orden WHERE reg_det = $reg ";
    $consulta = $queryEJE->ejecutar($update);
    header("Location: ../../Vista_Usuario/vistacarro.php");

}
?>