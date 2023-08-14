<?php
require_once "../src/query/Ejecuta.php"; // Asegúrate de incluir la ubicación correcta del archivo Select.php
use MyApp\query\Ejecuta;


if (!empty($_POST["btnmodifcar"])) 
{
        $queryM = new Ejecuta();
        extract($_POST);

        $id=$_POST["id"];
        $nombre_pro=$_POST["nombre_pro"];
        $precio=$_POST["precio"];
        $existencia=$_POST["existencia"];
        $talla=$_POST["talla"];
        $color=$_POST["color"];
        $genero=$_POST["genero"];
        $descripcion=$_POST["descripcion"];
        $categoria=$_POST["categoria"];
 
                extract($_FILES);
                $dir       =  __DIR__.'/../../fotos/';
                $pathinfo  =  pathinfo($_FILES["imagen"]["name"]);
                $filename  =  $pathinfo["filename"];
               
                if($filename == "")
                {
                  $update = "UPDATE productos SET nombre_pro='$nombre_pro', precio='$precio', existencia='$existencia', talla='$talla', color='$color', genero='$genero', descripcion='$descripcion', categoria=$categoria WHERE cve_prod = $id";
                  $consulta = $queryM->ejecutar($update);
                  if ($consulta = true)
                  {
                      echo "<div class='alert alert-success'> Producto Modificado exitosamente </div>";   
                      header("refresh:2; ../Administrador/index.php");
                  }
                  else
                  {
                      echo "<div class='alert alert-danger'> Error al modificar producto </div>";   
                  }
                }
                else
                {
                  $extension =  $pathinfo["extension"];
                  $name      =  time() . ".{$extension}";
                  $real_path =  "{$dir}{$name}";
                  move_uploaded_file($_FILES["imagen"]["tmp_name"], $real_path);
                  $update = "UPDATE productos SET nombre_pro='$nombre_pro', precio='$precio', existencia='$existencia', talla='$talla', color='$color', genero='$genero', descripcion='$descripcion', imagen='$name', categoria=$categoria WHERE cve_prod = $id";
                  $consulta = $queryM->ejecutar($update);
                  if ($consulta = true)
                  {
                      echo "<div class='alert alert-success'> Producto Modificado exitosamente </div>";   
                      header("refresh:2; ../Administrador/index.php");
                  }
                  else
                  {
                      echo "<div class='alert alert-danger'> Error al modificar producto </div>";   
                  }

                }
                
                
                
       
              /* Si no se proporcionó ningún valor, establecer uno predeterminado
              if (!isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] === 0) 
              {
                echo $update = "UPDATE productos SET nombre_pro='$nombre_pro', precio='$precio', existencia='$existencia', talla='$talla', color='$color', genero='$genero', descripcion='$descripcion', categoria=$categoria WHERE cve_prod = $id";
              }
              else
              { 
              }
              
              if (!isset($_FILES["imagen"]["name"]))
                {
                            echo "no hay archivo";
                }
                else
                {
                }
                
            */
               
                
              

                      

        
       
}
?>
