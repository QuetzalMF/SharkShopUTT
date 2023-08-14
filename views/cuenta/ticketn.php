<?php
    require("../../src/query/ejecuta.php");
    require("../../src/query/select.php");

    use MyApp\query\Select;
    use MyApp\query\Ejecuta;

    require("../../vendor/autoload.php");
    session_start();
    $tel_celular = $_SESSION["tel_celular"];
    require_once('../../tcpdf/tcpdf.php');

    $subtotal = 0; // Inicializar el subtotal


        /* Obtener datos del carrito */
    
     $queryD = new Select();
     $cadenaD = "SELECT * from usuario INNER JOIN persona ON usuario.persona = persona.id_persona where tel_celular = '$tel_celular' ";
     $miconsultaD = $queryD->seleccionar($cadenaD);
     foreach( $miconsultaD as $dato)
     {
        $usuario = $dato->id_usr;
        $nombre = $dato->nombre;
        $apellido = $dato->apellidos;
     }
    $id=$_GET["id"];
    $query = new Select();
    $cadena = "SELECT * FROM orden Orr INNER JOIN detalle_orden D ON Orr.de_orden = D.reg_det 
    INNER JOIN productos P ON P.cve_prod = D.producto WHERE reg = '$id' AND D.id_usuario = '$usuario' AND D.estado = 1 ";
    $tabla = $query->seleccionar($cadena);
    foreach($tabla as $datos)
    {
        $producto = $datos->cve_prod;
        $unidades = $datos->unidades;
        $de_orden = $datos->reg_det;
        $nombre = $datos->nombre_pro;
        $talla = $datos->talla; 
        $calor =$datos->color;
        $genero = $datos->genero;
   
        $reg = $datos->reg;

        $precio = $datos->precio;
        $subtotal = $subtotal + $precio;
    }
        /* Obtener datos del carrito */

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
        $fecha_actual = date('Y-m-d'); // Cambia el formato si es necesario

        // Agregar una página
        $pdf->AddPage();

        // Contenido del PDF
        $contenido = "
        <h1> Ticket de Compra </h1>
        <h1> N'Orden de confirmacion: $reg </h1>
        <h1> Fecha: $fecha_actual </h1>
        <table border='1'>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Unidades a comprar</th>
                    <th>Talla</th>
                    <th>Color</th>
                    <th>Genero</th>
                 
                </tr>
            </thead>
            <tbody>";

            foreach ($tabla as $datos) {
                $contenido .= "
                    <tr>
                        <td>" . (isset($datos->nombre_pro) ? $datos->nombre_pro : '') . "</td>
                        <td>" . (isset($datos->precio) ? $datos->precio : '') . "</td>
                        <td>" . (isset($datos->unidades) ? $datos->unidades : '') . "</td>
                        <td>" . (isset($datos->talla) ? $datos->talla : '') . "</td>
                        <td>" . (isset($datos->color) ? $datos->color : '') . "</td>
                        <td>" . (isset($datos->genero) ? $datos->genero : '') . "</td>
                        <td>" . (isset($datos->prenda) ? $datos->prenda : '') . "</td>
                    </tr>";
            }

        $contenido .= "
            </tbody>
        </table>
        <p><strong>EL SUBTOTAL es:</strong> " . number_format($subtotal) . "</p>
        <p><strong>EL IVA es:</strong> " . number_format($IVA) . "</p>
        <p><strong>EL TOTAL es:</strong> " . number_format($total) . "</p>
        <p><strong>Pasar por su compra en:</strong>or favor, recoge tu compra en un plazo máximo de 15 días.</p> 
        <p>Dirrección: Paseo del Tecnológico, Torreón Centro, México, 27297</p> 
        <p>Número telefónico: 87-14-87-03-45 </p>
        <p>Ante cualquier duda o aclaración sobre errores, por favor contáctanos en la sección 'Contáctanos' en nuestro sitio web. </p>
        ";

        // Escribir el contenido en el PDF
        $pdf->writeHTML($contenido, true, false, true, false, '');

        // Salida del PDF (descarga o visualización)
        $pdf->Output('ticket_compra.pdf', 'I');
        

?>


    
       