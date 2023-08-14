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

        require("../../src/query/ejecuta.php");
        require("../../src/query/select.php");
        require("../../src/data/database.php");
        require '../../Vista_Usuario/src_2/Exception.php';
        require '../../Vista_Usuario/src_2/PHPMailer.php';
        require '../../Vista_Usuario/src_2/SMTP.php';
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
        use MyApp\query\Ejecuta;
        use MyApp\query\Select;
        use MyApp\Data\MysqlConexion;

        if (!empty($_POST["nombre"]) and !empty($_POST["apellidos"]) and !empty($_POST["correo"]) and !empty($_POST["pass"]) and !empty($_POST["tel_celular"]) )
        {
             // Crea una instancia de la clase Ejecuta
            $usuarios = new ejecuta();
            $query = new Select();
            extract($_POST);

            $ROL = 0;
            $token = mt_rand(2000,3000);

            $cadena = "INSERT INTO persona(nombre,apellidos,ROL,tel_celular,token) 
            VALUES('$nombre','$apellidos', $ROL,'$tel_celular','$token')";
            $usuarios->ejecutar($cadena);

            /* - -- - - -- - - -- - - --  */
          
            // Crea una instancia de la clase MysqlConexion

            $cadenaz = "SELECT id_persona FROM persona WHERE tel_celular = '$tel_celular'";
            $tabla = $query->seleccionar($cadenaz);
            foreach ($tabla as $dato) {
                $persona = $dato->id_persona;
            }
            /* - -- - - -- - - -- - - --  */

            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $cadenas = "INSERT INTO usuario(correo,pass,persona) 
            VALUES('$correo','$hash', $persona)";
            $usuarios->ejecutar($cadenas);
            try {
            //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                
                extract($_POST);
                


                    //Configuracion del servidor
                
                    $mail -> SMTPDebug = 0;
                    $mail->isSMTP();
                    $mail->Host      ='smtp.gmail.com';
                    $mail->SMTPAuth  = true;
                    $mail->Username = 'sharkshoputt@gmail.com';
                    $mail->Password = 'smkynztgnmseafkp';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port      = 587;
                    $mail->isHTML(true);
                    
                
                    $correo = htmlentities($correo);
                    $nombre = htmlentities($nombre);
                    $apellidos = htmlentities($apellidos);

                    //Destinatario
                    $mail->setFrom($correo);
                    $mail->addAddress($correo);
                
                    $mail->CharSet = 'UTF-8';
                    $mail->Encoding = 'base64';

                    $subject = "Verificacion de Correo Electronico de ".($nombre)." ".($apellidos);                
                    $body='<html>
                    <head>
                        <style>
                        
                            body {
                                font-family: Arial, sans-serif;
                            
                            }
                            .container {
                                max-width: 600px;
                                margin: 0 auto;
                                padding: 20px;
                                background-color: #f4f4f4;
                                border-radius: 10px;
                                box-shadow: 0px 1rem 1rem darkorchid;
                            }
                            .logo {
                                display: block;
                                margin: 0 auto;
                            }
                            

                        </style>
                    </head>
                    <body>
                        <div class="container">
                            <h1 style="font-family: Arial, sans-serif;">Bienvenido/a a SharkShop '.$nombre.' '.$apellidos.'!</h1>
                            <h2 style="font-family: Arial, sans-serif;">
                            Sea bienvenido/a a nuestra tienda SharkShop, esperemos disfrute de su estadia.
                            </h2>
                            <h3 style="font-family: Arial, sans-serif;">Te damos un codigo de verificacion para dar de alta tu correo.</h3>
                            <h3 style="font-family: Arial, sans-serif;">Este es tu codigo de verificacion:</h2>
                            <h2 style="font-family: Arial, sans-serif;">'.$token.'</h2>
                            <p style="font-family: Arial, sans-serif;">Favor de copiar y pegar el codigo</p>
                            <p style="font-family: Arial, sans-serif;">Muchas gracias por pertencer a nuestra pagina, tenga un excelente día.</p>
                            </div>
                        </body>
                    </html>';    
                    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $mail->Subject = $subject;
                    $mail->Body = $body;

                    $mail->send();
                    echo 'El mensaje se envio';
                    } catch (Exception $e) {
                        echo "Hubo un error: {$mail->ErrorInfo}";
                    }
           "<div class='alert alert-success'> Usuario Registrado </div>";
           header("Location: ../../Vista_Usuario/verificacodigo.php");
        }
        else
        {
            echo "<div class='alert alert-danger'> Falto Agregar un campo </div>";
            header("Location: ../../Vista_Usuario/registershark.php");
        }

        
        $conexion->cerrar();
        ?>

    </div>
</body>
</html>