<?php
// Configuración de la conexión a la base de datos
$servername = "";
$username = "id21136453_quetzal";
$password = "DQuetzal_127";
$dbname = "id21136453_shark";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$cadenaso = "SELECT * FROM productos WHERE existencia > 0 ORDER BY existencia DESC LIMIT 10";
$tabla = $conn->query($cadenaso);

if ($tabla->num_rows > 0) {
    echo "<div class='row'>";

    foreach ($tabla as $datos) {
        echo "
        <div class='col-md-4'>
            <div class='card m-2'>
                <a href='./producto.php?id={$datos["cve_prod"]}'>
                    <img src='../fotos/{$datos["imagen"]}' style='width:250px; height:350px' class='card-img-top' height='300' alt='Product'/>
                </a>
                <div class='card-body'>
                    <p class='card-text fw-bold'>{$datos["nombre_pro"]}</p>
                    <small class='text-secondary'>$ {$datos["precio"]}</small>
                    <br>
                    <br>
                    <a href='./login.php'><button class='btn btn-sm btn-dark' type='button' style='height:30px;'>Agregar al carrito</button></a>
                </div>
            </div>
        </div>
        ";
    }

    echo "</div>";
} else {
    echo "No se encontraron productos con existencia.";
}

// Cerrar la conexión
$conn->close();
?>


<?php


require_once 'mysqlconexion.php'; // Asegúrate de tener la ruta correcta

class Select
{
    public function seleccionar($qry)
    {
        $cc = new Mysqlconexion("sharkshop", "root", "");
        $connection = $cc->getConexion();

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
