<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registro";

$conexion= mysqli_connect($servername, $username, $password,$dbname);
if(!$conexion){
    die("Conexion fallida:" . mysqli_connect_error());
}
