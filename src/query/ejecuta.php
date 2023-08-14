<?php
include __DIR__ . '/../../src/data/database.php'; // Asegúrate de tener la ruta correcta
//__DIR__ . 
use MyApp\Data\Mysqlconexion;
use mysqli_sql_exception;

class Ejecuta
{
    public function ejecutar($qry)
    {
        try
        {
            $con = new Mysqlconexion("id21136453_shark", "id21136453_quetzal", "DQuetzal_127");
            $conexion = $con->getConexion();
            $conexion->query($qry);
            $con->desconectarDB();
        }
        catch(mysqli_sql_exception $e)
        {
            echo $e->getMessage();
        }
    }
}


?>