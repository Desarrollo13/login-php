<?php 
$_SERVER = 'localhost';
$user_name = 'root';
$password = '1234';
$database= 'login-php-database';
try{
    $conn=new PDO("mysql:host=$_SERVER;dbname=$database;",$user_name,$password);/* nos va almacenar la conexion a la base de datos en conn */


}catch(PDOException $e){
    die('Connected failed: '. $e->getMessage());

}
?>