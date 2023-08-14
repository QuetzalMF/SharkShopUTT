<?php
include __DIR__.'/../data/database.php'; // Asegúrate de tener la ruta correcta
//__DIR__ . 
// /storage/ssd2/453/21136453/public_html/miniproyecto

class Login
{
    public function verificalogin($correo, $contra, $tel_celular)
    {
        try
        {
            $pase = 0;
            $rol = -1; // Inicializamos el valor del rol con un valor no válido
            $cc = new Mysqlconexion("id21136453_shark", "id21136453_quetzal", "DQuetzal_127");
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
                if ($rol == 10) {
                    $_SESSION["correo"] = $correo;
                    $_SESSION["tel_celular"] = $tel_celular;
                    $_SESSION["Rol"] = $rol;
                    echo "<div class='alert alert-sucess'>";
                    echo "<h1 style='visibility:hidden'>" . $_SESSION["Rol"] . "</h1>";
                    echo "<h1 style='visibility:hidden;'>" .  $_SESSION["tel_celular"] . "</h1>";
                    echo"<h2 align='center'>Bienvenido ".$_SESSION["correo"]. "</h2>";
                    echo "</div>";
                    //header("refresh:2;" .__DIR__."/../../index.php");
                } elseif ($rol == 5) {
                    $_SESSION["correo"] = $correo;
                    $_SESSION["tel_celular"] = $tel_celular;
                    $_SESSION["Rol"] = $rol;
                    echo "<div class='alert alert-sucess'>";
                    echo "<h1 style='visibility:hidden'>" . $_SESSION["Rol"] . "</h1>";
                    echo "<h1 style='visibility:hidden;'>" .  $_SESSION["tel_celular"] . "</h1>";
                    echo"<h2 align='center'>Bienvenido ".$_SESSION["correo"]. "</h2>";
                    echo "</div>";
                    //header("refresh:2;" .__DIR__."/../../index.php");
                } else {
                    // Redireccionar a una página por defecto si el rol no coincide con 10 ni 5 o sea 0
                    echo "<div class='alert alert-danger'>";
                    echo"<h2 align='center'> Verifique su cuenta </h2>";
                    echo "</div>";
                    //header("refresh:1".__DIR__."/../../Vista_Usuario/verificacodigo.php");
                }
            }
            else
            {
                echo "<div class='alert alert-danger'>";
                echo "<h2 align='center'>Usuario o password incorrecto</h2>";
                echo "</div>";
                header("refresh:2 " . __DIR__ . " /../../Vista_Usuario/login.php");
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