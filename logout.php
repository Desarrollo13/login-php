<?php
session_start();


session_unset();/*u quitar esta sesion */

session_destroy();/* dsitruir la sesion */

header('location: /loguin-php');

?>