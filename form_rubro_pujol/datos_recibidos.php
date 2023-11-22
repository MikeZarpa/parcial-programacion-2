<?php
$scon = mysqli_connect('localhost', 'root', '', 'pujol_e_hijos_srl');

if (!$scon) {
    die("Connection failed: " . mysqli_connect_error());
}

//echo "Conexion realizada correctamente";

$descripcion = mysqli_real_escape_string($scon, $_POST["descripcion"]);

//echo "<h2>Detalles del Formulario de Rubros:</h2>";
//echo "<p><strong>Descripcion:</strong> $descripcion</p>";

// Consulta para verificar si la rubro ya existe
$check_query = "SELECT * FROM rubro WHERE descripcion = '$descripcion'";
$result = mysqli_query($scon, $check_query);

if (mysqli_num_rows($result) > 0) {
    //echo "El rubro '$descripcion' ya existe en la base de datos.";
    echo "<script>
        $(document).ready(function () {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: `El rubro '$descripcion' ya existe en la base de datos.`,
                allowOutsideClick:true,
                backdrop:true,
                showConfirmButton: true,
                toast: false,
                showClass: {
                popup: 'animated bounceIn' 
                },
                hideClass: {
                popup: 'animated bounceOut'
                },
            });
        });</script>";
} else {
    // Insertar la rubro si no existe
    $sql = "INSERT INTO rubro (descripcion) VALUES ('$descripcion')";

    if (mysqli_query($scon, $sql)) {
        //echo "Rubro insertado correctamente";
        echo "<script>
        $(document).ready(function () {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Realizado Exitosamente',
                allowOutsideClick:true,
                backdrop:true,
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                toast: false,
                showClass: {
                popup: 'animated bounceIn' 
                },
                hideClass: {
                popup: 'animated bounceOut'
                },
            });
        });</script>";
    } else {
        //echo "Error en la inserción: " . mysqli_error($scon);
        $cuerpo = mysqli_error($scon);
        echo "<script>
        $(document).ready(function () {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Error en la inserción',
                text: '$cuerpo',
                allowOutsideClick:true,
                backdrop:true,
                showConfirmButton: true,
                toast: false,
                showClass: {
                popup: 'animated bounceIn' 
                },
                hideClass: {
                popup: 'animated bounceOut'
                },
            });
        });</script>";
    }
}

mysqli_close($scon);

//echo "<p><a href='lista_rubro.php'> Ver Lista Rubros </a></p> ";
?>
