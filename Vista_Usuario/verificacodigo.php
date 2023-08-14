<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONTACTOS</title>
    <link rel="shortcut icon" href="imgs/logo_sinfondo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">

    <style>
                form{
    width: 400px;
    margin:auto;
}
        body {
            background-image: url("../src/imgs/flr.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding-top: 100px;
           background-color: aliceblue;
           border-radius: 10px;

        }

        img.logo {
            display: block;
            margin: 0 auto;
            width: 150px;
            margin-top: 10px;
        }

        h3 {
            text-align: center;
            margin-top: 10px;
        }

        .form-label {
            font-weight: bold;
            
        }

        .form-control {
            margin-bottom: 10px;
        }

        .btn {
            width: 100%;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
<?php
    session_start();
    if(!isset($_SESSION["correo"]))
    {
    ?>
    <div class="container">
        <img src="../src/imgs/logo_sinfondo.png" alt="" class="logo">
        <h3>Verificar codigo</h3>
        <br>
        <form action="../views/scripts/verficar.php" method="post" id="formIniciar">
            <div class="mb-3">
                <label for="codigo" class="form-label">Te enviamos un codigo de confirmacion</label>
                <input type="text" class="form-control" name="codigo" placeholder="Escribe el codigo">
            </div>
            <div class="mb-3">
                 <button  type="submit" class="btn btn-success">Registrate</button>
            </div>
        </form>
    </div>

    <script src="./funciones.js"></script>
    <script src="./app.login.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
    }
    else
    {
    ?>
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading" style="margin-left: 40px;">Cuenta activa!!!</h4>
            <svg xmlns="http://www.w3.org/2000/svg" style="width: 30px; margin-top: -75px;" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <p>Ya cuentas con una cuenta, te pedimos amablemente salir de esta URL dirigiendote a: <a href="../index.php"><button class="btn btn-dark"> Pagina </button></a>.</p>
            <hr>
            <p class="mb-0">Muchas gracias por entender y disfrute de la estadia en la pagina.</p>
        </div>
    <?php
    }
    ?>
</body>
<script>
// Esta función se ejecutará cuando la página termine de cargarse
window.onload = function() {
  alert("Te hemos enviado tu codigo por correo");
};
</script>
</html>
