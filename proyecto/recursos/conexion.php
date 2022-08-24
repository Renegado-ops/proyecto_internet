<?php

// CONEXION LOCALHOST
$hostname = "localhost";
$username = "root";
$passwrd  ="";
$database = "sakila";


    
$conexion = mysqli_connect($hostname, $username, $passwrd, $database) or die("No se puede conectar a la base de datos " . mysqli_connect_error());