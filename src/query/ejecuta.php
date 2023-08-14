<?php

namespace MyApp\Query;
use MyApp\Data\Mysqlconexion;
use mysqli_sql_exception;

class Ejecuta
{
    public function ejecutar($qry)
    {
        try
        {
            $con = new Mysqlconexion("sharkshop", "root", "");
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