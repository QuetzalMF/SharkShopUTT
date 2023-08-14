<?php
require("../src/query/select.php");
require("../src/query/ejecuta.php");

use MyApp\query\Select;
use MyApp\query\Ejecuta;

require("../vendor/autoload.php");
require_once('../tcpdf/tcpdf.php');

session_start();

if (isset($_SESSION["correo"]) && isset($_SESSION["tel_celular"])) {
    $tel_celular = $_SESSION["tel_celular"];

    /* obtener id del usuario */
    $queryD = new Select();
    $cadenaD = "SELECT * FROM usuario INNER JOIN persona ON usuario.persona = persona.id_persona where tel_celular = '$tel_celular' ";
    $miconsultaD = $queryD->seleccionar($cadenaD);
    foreach ($miconsultaD as $dato) {
        $usuario = $dato->id_usr;
        $nombre = $dato->nombre;
        $apellido = $dato->apellidos;
    }

    /* Obtener datos del carrito */
    $subtotal = 0; // Inicializamos la variable $subtotal
    $query = new Select();
    $cadena = "SELECT * FROM detalle_orden D
                INNER JOIN productos P ON D.producto = P.cve_prod
                INNER JOIN categoria_prenda C ON P.categoria = C.cve_pcat
                WHERE id_usuario = '$usuario' AND D.estado = 0 ";
    $tabla = $query->seleccionar($cadena);
    foreach ($tabla as $datos) {
        $precio = $datos->precio;
        $subtotal = $subtotal + $precio;
        $dato_importante = $datos->unidades;
    }

    $IVA = $subtotal - ($subtotal / 1.21);
    $total = $subtotal + $IVA;

    // Crear el PDF
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    // Establecer información del documento
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('SharkShop');
    $pdf->SetTitle('Ticket de Compra');
    $pdf->SetSubject('Ticket');
    $pdf->SetKeywords('SharkShop, Ticket, Compra');

    // Agregar una página
    $pdf->AddPage();

    // Contenido del PDF
    $contenido = "
    <h1>Ticket de Compra</h1>
    <p><strong>Nombre:</strong> $nombre $apellido</p>
    <table border='1'>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades a comprar</th>
                <th>Talla</th>
                <th>Color</th>
                <th>Genero</th>
                <th>Imagen</th>
                <th>Categoria</th>
            </tr>
        </thead>
        <tbody>";

    foreach ($tabla as $datos) {
        $contenido .= "
            <tr>
                <td>" . (isset($datos->nombre_pro) ? $datos->nombre_pro : '') . "</td>
                <td>$precio</td>
                <td>" . (isset($datos->unidades) ? $datos->unidades : '') . "</td>
                <td>" . (isset($datos->talla) ? $datos->talla : '') . "</td>
                <td>" . (isset($datos->color) ? $datos->color : '') . "</td>
                <td>" . (isset($datos->genero) ? $datos->genero : '') . "</td>
                <td><img src='" . (isset($datos->imagen) ? $datos->imagen : '') . "' alt='Imagen' width='100'></td>
                <td>" . (isset($datos->prenda) ? $datos->prenda : '') . "</td>
            </tr>";
    }

    $contenido .= "
        </tbody>
    </table>
    <p><strong>EL SUBTOTAL es:</strong> " . number_format($subtotal) . "</p>
    <p><strong>EL IVA es:</strong> " . number_format($IVA) . "</p>
    <p><strong>EL TOTAL es:</strong> " . number_format($total) . "</p>";

    // Escribir el contenido en el PDF
    $pdf->writeHTML($contenido, true, false, true, false, '');

    // Salida del PDF (descarga o visualización)
    $pdf->Output('ticket_compra.pdf', 'I');
}
?>
