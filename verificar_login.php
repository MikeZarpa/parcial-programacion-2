<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "login_db";
    
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }

    // Obtén los datos del formulario
    $nombre_usuario = $_POST["nombre_usuario"];
    $contrasena = $_POST["contrasena"];
    $email = $_POST["email"];
    //Realizar la consulta
        //1-Preparamos la consulta
    
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$nombre_usuario' AND contrasena = '$contrasena' AND email = '$email'";

        //2 Ejecutamos y guardamos resultados

    $result = $conn->query($sql);

    //Actuamos según el resultado

    if ($result->num_rows > 0) {
        echo "¡Inicio de sesión exitoso!";
    } else {
        echo "Inicio de sesión fallido. Verifica tus credenciales.";
    }

    // Cerramos la conexión
    $conn->close();
?>
