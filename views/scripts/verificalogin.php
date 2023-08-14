<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   
    <title>Login</title>
</head>
<body>
    <div class="container">

        <?php
       
            require("../../src/query/login.php");
            require("../../src/data/database.php");

            use MyApp\query\Login;
            use MyApp\data\Database;
            
            $usuarios = new Login();

            extract($_POST);

            $usuarios->verificalogin("$correo","$pass","$tel_celular");

        ?>
    </div>
</body>
</html>