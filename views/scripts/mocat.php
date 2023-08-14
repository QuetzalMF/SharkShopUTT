<?php



if (!empty($_POST["btnmodifcar"])) 
{
    if (!empty($_POST["prenda"]))
    {
        $queryM = new Ejecuta();
        extract($_POST);

        $id=$_POST["id"];
        $nombre_pro=$_POST["prenda"];
        
        $update = "UPDATE categoria_prenda SET prenda='$prenda' WHERE cve_pcat = $id";
        $consulta = $queryM->ejecutar($update);
        if ($consulta = true)
        {
            echo "<div class='alert alert-success'> Producto Modificado exitosamente </div>";   
            header("refresh:2; ../Administrador/agcat.php");
        }
        else
        {
            echo "<div class='alert alert-danger'> Error al modificar producto </div>";   
            header("refresh:2; ../Administrador/agcat.php");
        }
    }
}
?>
