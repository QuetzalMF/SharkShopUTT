<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../boostrap/css/bootstrap.min.css" type="text/css">
    <script src="../../../boostrap/js/bootstrap.min.js"></script>
    <title>Usuario</title>
</head>
<body>
    <div class="container">
        <?php
         // Requiere los archivos necesarios
require_once("../../src/query/ejecuta.php");
require_once("../../src/query/select.php");
require_once("../../src/data/database.php");
use MyApp\query\Ejecuta;
use MyApp\query\Select;
use MyApp\Data\MysqlConexion;

// Crea una instancia de la clase MysqlConexion
$conexion = new MysqlConexion();
$conexion->conectar();

// Verifica si el formulario ha sido enviado con el campo "codigo" no vacío
if (!empty($_POST["codigo"]))
{
    // Crea una instancia de la clase Ejecuta
    $usuarios = new Ejecuta();
    extract($_POST);
    
    // Crea una instancia de la clase Select para obtener el token de la base de datos
    $query = new Select();
    $consulta = "SELECT token FROM persona WHERE token = '$codigo' ";
    $boolean = $query->seleccionar($consulta);
    
    if ($boolean) 
    {
        // Hace un update al usuario.
        $queryC = new Ejecuta();
        $cadena = "UPDATE persona SET ROL = 10 WHERE token = '$codigo' ";
        $queryC->ejecutar($cadena);
        header("Location: ../../Vista_Usuario/login.php");
    } 
    else 
    {
        echo "El token es equivocado.";
        header("Location: ../../Vista_Usuario/register.php");
    }
    
    // Cierra la conexión a la base de datos
    $conexion->cerrar();
}

        /* aqui mismo hacer una comparacion entre el campo token de la base de datos y el ingresado dentro del formulario
            si es que coinciden me hagas un update al rol
            Rol = 0
            Aqui seria If = true = UPDATE ROL = 10 
        */
        
        ?>
    </div>
</body>
</html>



