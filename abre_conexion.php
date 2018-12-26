<?php
$servername = "localhost";
$username = "id7798627_grupomem";
$password = "12345";
$dbname = "id7798627_registro";

$conexion= mysqli_connect($servername, $username, $password,$dbname);
if(!$conexion){
    die("Conexion fallida:" . mysqli_connect_error());
}
