<?php

namespace MyApp\Query;
use mysqli_sql_exception;
use MyApp\Data\mysqlconexion;

class Login
{
    public function verificalogin($correo, $contra, $tel_celular)
    {
        try
        {
            $pase = 0;
            $rol = -1; // Inicializamos el valor del rol con un valor no válido
            $cc = new mysqlconexion("sharkshop", "root", "");
            $conexion = $cc->getConexion();

            $query = "SELECT * FROM usuario INNER JOIN persona ON persona.id_persona = usuario.persona WHERE tel_celular = '$tel_celular' ";
            $consulta = $conexion->query($query);

            while ($renglon = $consulta->fetch_assoc())
            {
                if (password_verify($contra, $renglon['pass'])) 
                {
                    $pase = 1;
                    $rol = $renglon['ROL']; // Obtener el rol del usuario
                }
            }
            
            if ($pase > 0)
            {


                session_start();
                $_SESSION["correo"] = $correo;
                $_SESSION["tel_celular"] = $tel_celular;
                $_SESSION["id_usr "] = $id_usr;

                if ($rol == 10) {
                    $_SESSION["Rol"] = $rol;
                    echo "<div class='alert alert-sucess'>";
                    echo "<h1 style='visibility:hidden'>" . $_SESSION["Rol"] . "</h1>";
                    echo "<h1 style='visibility:hidden;'>" .  $_SESSION["tel_celular"] . "</h1>";
                    echo"<h2 align='center'>Bienvenido ".$_SESSION["correo"]. "</h2>";
                    echo "</div>";
                    header("refresh:1 ../../index.php");
                } elseif ($rol == 5) {
                    $_SESSION["Rol"] = $rol;
                    echo "<div class='alert alert-sucess'>";
                    echo "<h1 style='visibility:hidden'>" . $_SESSION["Rol"] . "</h1>";
                    echo "<h1 style='visibility:hidden;'>" .  $_SESSION["tel_celular"] . "</h1>";
                    echo"<h2 align='center'>Bienvenido ".$_SESSION["correo"]. "</h2>";
                    echo "</div>";
                    header("refresh:1 ../../Administrador/index.php");
                } else {
                    // Redireccionar a una página por defecto si el rol no coincide con 10 ni 5 o sea 0
                    echo "<div class='alert alert-danger'>";
                    echo"<h2 align='center'> Verifique su cuenta </h2>";
                    echo "</div>";
                    header("refresh:1 ../../Vista_Usuario/verificacodigo.php");
                }
            }
            else
            {
                echo "<div class='alert alert-danger'>";
                echo "<h2 align='center'>Usuario o password incorrecto</h2>";
                echo "</div>";
                header("refresh:2 ../../Vista_Usuario/login.php");
            }
        }
        catch(mysqli_sql_exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function cerrarsesion()
    {
        session_start();
        session_destroy();
        header("Location: ../../index.php");
    }
}

?>
