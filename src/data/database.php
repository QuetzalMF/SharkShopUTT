<?php

namespace MyApp\Data;
use mysqli;

class Mysqlconexion
{
    public $conexion = null;
    public $user = "root";
    public $password = "";
    public $dbname = "sharkshop";

    public function __construct(string $dbname, string $user, string $password)
    {
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
    }

    public function getConexion()
    {
        $host = "localhost";
        $this->conexion = new mysqli($host, $this->user, $this->password, $this->dbname);
        
        if ($this->conexion->connect_error) {
            die("Conexión fallida: " . $this->conexion->connect_error);
        }
        
        return $this->conexion;
    }

    public function desconectarDB()
    {
        if ($this->conexion) {
            $this->conexion->close();
        }
    }
}

?>
