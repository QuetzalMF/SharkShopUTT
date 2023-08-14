<?php

namespace MyApp\query;

class Select
{
    public function seleccionar($qry)
    {
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "sharkshop";

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
