<?php
class Mysqlconexion
{
    public $conexion = null;
    public $user = "id21136453_quetzal";
    public $password = "DQuetzal_127";
    public $dbname = "id21136453_shark";

    public function __construct()
    {
        // No es necesario pasar dbname, user y password aquí, ya que están predefinidos
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