<?php require_once "recursos/conexion.php"; ?>

<?php 

    //verificar si le da click al boton
    if (isset ($_POST['boton-guardar'])){
        

    //variables
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    //validaciones
    if(empty($first_name)){
       echo("El first name no puede estar vacio");
    }
    if (empty($last_name)){
       echo("El last name no puede estar vacio");
    }

    //guardar
    $query = "INSERT INTO persona (primer_Nombre,primer_Apellido) VALUE ('$first_name', '$last_name')";
    
    $resultado = $conexion-> query($query) or die ("Error en query: $query ") ;

    if ($resultado){
        echo "Insertado";
    }else{
        echo "No pudo insertar";
    }
  
}
        //actualizar
        $id= isset($_GET['id']) ? $_GET['id'] : "";

    //buscar info para editar
    if (isset($_GET['editar'])) {
        $id = $_GET['editar'];
        $query = "UPDATE persona SET primer_Nombre = '$primer_Nombre',primer_Apellido ='$Primer_Apellido' WHERE persona.id_Persona = '$id' ";
        $resultado = mysqli_query($conexion, $query) or die ("Error en query: $query");
        if ($resultado) {
            while ($fila == $resultado) {
                $id = $fila->id_Persona;
                $primer_Nombre = $fila->primer_Nombre;
                $Primer_Apellido = $fila->Primer_Apellido;
                print_r($fila);
            }
        }
        header("refresh:1; url=index.php"); 
    }

    if (isset($_GET['eliminar'])) {
        $id = $_GET['eliminar'];

        $query = "DELETE FROM persona WHERE id_Persona = '$id' ";
        $resultado = $conexion->query($query) or die("Error en query: $query");

        if ($resultado) {
            echo ("Datos eliminados");
        } else {
            echo ("No se pudo eliminar");
        }
    }
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Proyecto_E</title>
    <link rel="icon" href="letter-e.png">
</head>

<body>
    <?php require_once "vistas/parte_menu.php";?>
    <div class="container">
        <h3><?php echo $pagina; ?></h3>
        <div class="row">
            <form class="col-6" method="post">
                <div class="mb-3">
                    <label for="">Nombre</label>
                    <input type="text" name="first_name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Apellido</label>
                    <input type="text" name="last_name" class="form-control">
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" name="boton-guardar">Guardar</button>
                </div>
            </form>
            <?php if (!empty($error)): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo $error; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <form class="col-4 ">

                <div class="input-group mb-3">
                    <input type="text" name="buscador" class="form-control" placeholder="Buscador">
                    <button class="btn btn-outline-secondary" type="submit" name="boton-buscar"><i
                            class="bi bi-search"></i>Buscar</button>
                </div>

            </form>
        </div>
        <div class="row">
            <div class="col-12 ">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID Persona</th>
                            <th scope="col">Primer Nombre</th>
                            <th scope="col">Primer Apellido</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Query para traer los datos de la tabla
                        $query = "SELECT * FROM persona";

                        // codigo para buscar 
                        $buscador = isset($_GET['buscador']) ? $_GET['buscador'] : "";
                        if ($buscador != "") {
                            $query = "SELECT * FROM persona where primer_Nombre ='$buscador'";
                        }

                        // Ejecutar el query y guardar los datos en la variable resultado
                        $resultado = mysqli_query($conexion, $query) or die ("Error en query: $query");

                        if ($resultado) {

                            while ($fila = mysqli_fetch_object($resultado)) {
                                echo "
                                    <tr>
                                        <td>{$fila->id_Persona}</td>
                                        <td>{$fila->primer_Nombre}</td>
                                        <td>{$fila->Primer_Apellido}</td>
                                        <td>
                                        <a href='{$_SERVER['PHP_SELF']}?editar={$fila->id_Persona}'>Editar</a>
                                        <a href='{$_SERVER['PHP_SELF']}?eliminar={$fila->id_Persona}'>Eliminar</a>
                                    </td>
                                    </tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <footer class="pt-5 my-5 text-muted border-top">
            Created by the Bootstrap compadre &middot; &copy; 2022
        </footer>
    </div>
    <?php require_once "vistas/parte_footer.php"; ?>
</body>

</html>