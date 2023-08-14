<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi Cuenta - SharkShop</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="Vista_Usuario/style_index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<style>
    /* Estilos generales */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
  }
  
  .container {
   
 max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
  }
  
  /* Estilos para la barra lateral */
  .sidebar {
    background-color: #f0f0f0;
    padding: 20px;
  }
  
  .user-info img {
    display: block;
    margin: 0 auto;
    width: 100px; 
    height: auto;
    border-radius: 50%;
    margin-bottom: 10px;
  }
  
  .user-info h2 {
    margin: 0;
  }
  
  .account-options li {
    list-style: none;
    margin-bottom: 10px;
  }
  
  .logout-btn {
    display: block;
    margin-top: 20px;
    text-decoration: none;
    color: #fff;
    background-color: #ff0000;
    padding: 10px 15px;
    border-radius: 5px;
  }
  
  .logout-btn:hover {
    background-color: #cc0000;
  }
  
  /* Estilos para el contenido principal */
  .cv-details {
    padding: 20px;
    background-color: #f9f9f9;
    min-height: 400px;
  }
  
  .section-title {
    margin-top: 0;
    margin-bottom: 20px;
  }
  
  /* Estilos para el encabezado y pie de página */
  .header, .footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
  }
</style>
<body>
    <?php
    require("../../src/query/select.php");

    use MyApp\query\Select;
    session_start();
    if(isset($_SESSION["correo"]))
    {
    ?>
    <header class="header">
        <div class="container">
        <h1><a href="../../index.php" style="text-decoration: none; color:white;">SharkShop</a></h1>
        </div>
    </header>
    <main class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar">
                        <div class="user-info">
                            <a href='../../Vista_Usuario/micuenta.php'><img src="../../src/imgs/logo_sinfondo.png" alt="Logo de SharkShop"></a>
                            
                        </div>
                        <ul class="account-options">
                            <li><a href="./modificar.php"><button type="button" class="btn btn-dark">Editar perfil</button></a></li>
                            <li><a href="./passnew.php"><button type="button" class="btn btn-dark">Cambiar contraseña</button></a></li>
                            <li><a href="./misventas.php"><button type="button" class="btn btn-dark">Historial de compras</button></a></li>
                        </ul>
                        <a href="../../views/scripts/cerrar.php" style="text-decoration: none;" class="logout-btn">Cerrar sesión</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="cv-details">
                        <h2 class="section-title">Cambiar password</h2>
                        <?php
                        

                       
                        $correo = $_SESSION["correo"];
                        $telefono = $_SESSION["tel_celular"];

                        $query = new Select();
                        $cadena = "SELECT * FROM persona INNER JOIN usuario ON persona.id_persona = usuario.persona WHERE tel_celular = '$telefono' ";
                        $consulta = $query->seleccionar($cadena);
                        foreach($consulta as $datos)

                        {
                        echo "
                        <form action='modipass.php' method='POST'>
                            <div class='row g-3'>
                                <div class='col-auto'>
                                    <label class=''>Password anterior</label>
                                </div>
                                <div class='col-auto'>
                                    <input type='password' class='form-control' name='original'>
                                </div>
                            </div>
                            <br>
                            <div class='row g-3'>
                                <div class='col-auto'>
                                    <label class=''>Password nuevo</label>
                                </div>
                                <div class='col-auto'>
                                    <input type='password' class='form-control' name='pass'>
                                </div>
                            </div>
                           
                            <br>
                        ";
                        }
                        ?>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-dark mb-3">Confirmar cambio</button>
                            </div>

                        </form>
                    </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    }
    else
    {
    ?>
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading" style="margin-left: 40px;">No hay sesion activa!!!</h4>
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 30px; margin-top: -75px;" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <p>No cuentas con una cuenta, te pedimos amablemente salir de esta URL dirigiendote a: <a href="../index.php"><button class="btn btn-dark"> Inicio </button></a>.</p>
            <hr>
            <p class="mb-0">Muchas gracias por entender y disfrute de la estadia en la pagina.</p>
        </div>
    <?php
    }
    ?>
</body>
</html>