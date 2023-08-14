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
        $nombre = $dato->nombre;
        $apellido = $dato->apellidos;
     }


    $query = new Select();
    $cadena = "SELECT * from detalle_orden D INNER JOIN  productos P ON D.producto = P.cve_prod 
    INNER JOIN categoria_prenda C ON P.categoria = C.cve_pcat
    WHERE id_usuario = '$usuario' AND estado = 0";
    $tabla = $query->seleccionar($cadena);
    $reg = mt_rand(1000,2000);
    $subtotal = 0;

    
    foreach($tabla as $datos)
    {
        $producto = $datos->cve_prod;
        $unidades = $datos->unidades;
        $de_orden = $datos->reg_det;
        $nombre = $datos->nombre_pro;
        $talla = $datos->talla; 
        $calor =$datos->color;
        $genero = $datos->genero;
        $prenda = $datos->prenda;

        $precio = $datos->precio;
        
        /* Resta la unidades a comprar de las existencia del producto */
        $queryEJE = new Ejecuta();
        $update = "UPDATE productos SET existencia = existencia - '$unidades' WHERE cve_prod = '$producto'";
        $queryEJE->ejecutar($update);
        
        /* Resta la unidades a comprar de las existencia del producto */

        /* Actualiza el estado del producto a "comprado" = 1 */
        $queryESTA = new Ejecuta();
        $updateESTA = "UPDATE detalle_orden SET estado = 1 WHERE producto = '$producto'";
        $queryESTA->ejecutar($updateESTA);
        /* Actualiza el estado del producto a "comprado" = 1 */
        
        /* Genera un numero random para identificar el n.orden y insertar los registros */
        $insert = new Ejecuta();
        $fecha_actual = date('Y-m-d');
        $ordenes = "INSERT INTO orden(reg,fecha_orden, de_orden, Estado_v) VALUES ('$reg','$fecha_actual',$de_orden,'1')";
        $consulta = $insert->ejecutar($ordenes);
        /* Genera un numero random para identificar el n.orden y insertar los registros */


        
        $subtotal = $subtotal + $precio;
    }

    if ($consulta = true) {
        require_once('../../tcpdf/tcpdf.php');
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

        
    
        // Estilos personalizados para el PDF
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'Ticket de Compra', 0, 1, 'C');
    
        // Contenido del PDF
     // Contenido del PDF
$contenido = "
<h3>Número de Orden de Confirmación: $reg</h3>
<h3>Fecha: $fecha_actual</h3>
<table border='1'>
    <thead>
        <tr>
            <th><h2>Atributo</h2></th>
            <th><h2>Valor</h2></th>
        </tr>
    </thead>
    <tbody>";

foreach ($tabla as $datos) {
$contenido .= "
    <tr>
        <td><strong>Nombre:</strong></td>
        <td>" . (isset($datos->nombre_pro) ? $datos->nombre_pro : '') . "</td>
    </tr>
    <tr>
        <td><strong>Precio:</strong></td>
        <td>$" . (isset($datos->precio) ? number_format($datos->precio, 2) : '') . "</td>
    </tr>
    <tr>
        <td><strong>Unidades:</strong></td>
        <td>" . (isset($datos->unidades) ? $datos->unidades : '') . "</td>
    </tr>
    <tr>
        <td><strong>Talla:</strong></td>
        <td>" . (isset($datos->talla) ? $datos->talla : '') . "</td>
    </tr>
    <tr>
        <td><strong>Color:</strong></td>
        <td>" . (isset($datos->color) ? $datos->color : '') . "</td>
    </tr>
    <tr>
        <td><strong>Género:</strong></td>
        <td>" . (isset($datos->genero) ? $datos->genero : '') . "</td>
    </tr>
    <tr>
        <td><strong>Categoría:</strong></td>
        <td>" . (isset($datos->prenda) ? $datos->prenda : '') . "</td>
    </tr>";
}

$contenido .= "
</tbody>
</table>
<p><strong>Subtotal:</strong> $" . number_format($subtotal, 2) . "</p>
<p><strong>IVA:</strong> $" . number_format($IVA, 2) . "</p>
<p><strong>Total:</strong> $" . number_format($total, 2) . "</p>
<p><strong>Por favor, recoge tu compra en un plazo máximo de 15 días.</strong></p>
<p>Dirección: Paseo del Tecnológico, Torreón Centro, México, 27297</p>
<p>Número telefónico: 87-14-87-03-45</p>
<p>Ante cualquier duda o aclaración sobre errores, por favor contáctanos en la sección 'Contáctanos' en nuestro sitio web.</p>
";

        
        // Escribir el contenido en el PDF
        $pdf->writeHTML($contenido, true, false, true, false, '');
    
        // Salida del PDF (descarga o visualización)
        $pdf->Output('ticket_compra.pdf', 'I');
    }
    ?>