<?php

require_once "recursos/conexion.php";
require_once "recursos/funciones.php";
$pagina = "Actores";
$error ="";


try {



    //verificar si le da click al boton
    if (isset ($_POST['boton-guardar'])){
        

    //variables
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    //validaciones
    if(empty($first_name)){
        throw new Exception("El first name no puede estar vacio");
    }
    if (empty($last_name)){
        throw new Exception("El last name no puede estar vacio");
    }

    //guardar
    $query = "INSERT INTO actor (first_name,last_name) VALUE ('$first_name', '$last_name')";
    
    $resultado = $conexion-> query($query) or die ("Error en query");
    if ($resultado){
        $_SESSION['mensaje'] = "Datos insertados correctamente";
        $script_alerta = alerta ("Insertado", "Datos correcto", "success");
    }else{
        $script_alerta = alerta ("Error", "No pudo insertar", "Error");
        throw new Exception("No se puede insertar los datos");
    }
    //refrezcar

    refrezcar('actores.php');
}
} catch(Throwable $ex){
    $error = $ex ->getMessage();
}
require_once "vistas/vista_actores.php";
#no debe haber codigo despues de esta linea