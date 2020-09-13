<?php 


    session_start();/* inicializo la variable de sesion */

    if (isset($_SESSION['user_id'])) {/* aca redirecciono para que una vez registrado me muestre la raiz*/ 
        header('Location: /php-login');
      }

    require 'database.php';

    if(!empty($_POST['email']) && !empty($_POST['password'])){ /* compruebo que no estan vacios los datos */
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
        $records->bindParam(':email',$_POST['email']);
        $records->execute();/* con esto estamos ejecutando la consulta */
        $results = $records->fetch(PDO::FETCH_ASSOC);  /* vamos a obtener los datos del usuario con fetch */

        $message= '';

        if(count($results) > 0 && password_verify($_POST['password'], $results['password'])){/*  si count trae el valor de las contraseñas */
              $_SESSION['user_id'] = $results['id'];/* agrego un variable de sesion donde almaceno la variable users_id del usuario*/
               header('location: /loguin-php'); /* voy a redireccionar el id */

        }else{
            $message ='Sorry, Those credential do not mach';
        }


    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require 'partials/header.php' ?>

    <h1>Login</h1>
    <span>or <a href="signup.php">Signup</a></span>

    <?php if(!empty($message)): ?>
    <p><?= $message ?> </p>
    <?php endif; ?>

    <form action="login.php" method="post">
        <input type="text" name="email" placeholder="Enter you email">
        <input type="password" name="password" placeholder="Enter you password">
        <input type="submit" value="Send">
    </form>
    
</body>
</html>