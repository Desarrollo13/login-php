<?php 

    require 'database.php';

    $message = '';

    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $sql = "INSERT INTO users (email , password) VALUES (:email , :password)";
        $stmt = $conn->prepare($sql); /* ejecuta sentencia de sql */
        $stmt->bindParam(':email',$_POST['email']); /* vincula los atributos email, password */
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); /* cifrar la contraseña */
        $stmt->bindParam('password',$password);

        if($stmt->execute()){
            $message = 'Successfully created new user';

        }else{
            $message = 'Sorry there must have beed an issue creating your account';

        }
       
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?> <!-- si el mensaje no esta vacio -->
        <p> <?= $message ?> </p>
    <?php endif; ?>    

    <h1>SignUp</h1>
    <span>or <a href="login.php">Login</a></span>

    <form action="signup.php" method="POST">
        <input type="text" name="email" placeholder="Enter you email">
        <input type="password" name="password" placeholder="Enter you password">
        <input type="password" name="confirm_password" placeholder="Confirm you password">
        <input type="submit" value="Send">

    </form>
    
</body>

</html>