<?php
include __DIR__ . '/../../src/data/database.php'; // Asegúrate de tener la ruta correcta
//__DIR__ . 

class Select
{
    public function seleccionar($qry)
    {
        $host = "localhost";
        $username = "id21136453_quetzal";
        $password = "DQuetzal_127";
        $dbname = "id21136453_shark";

        $connection = new \mysqli($host, $username, $password, $dbname);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $result = $connection->query($qry);

        if (!$result) {
            echo "Query failed: " . $connection->error;
        }

        $data = [];

        while ($row = $result->fetch_assoc()) {
            $data[] = (object) $row;
        }

        $result->free();
        $connection->close();

        return $data;
    }
}
