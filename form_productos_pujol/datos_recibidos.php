<?php
$scon = mysqli_connect('localhost', 'root', '', 'pujol_e_hijos_srl');

if (!$scon) {
    die("Connection failed: " . mysqli_connect_error());
}

//echo "Conexion realizada correctamente";

$descripcion = $_POST["descripcion"];
$precio = $_POST["precio"];
$id_rubro = $_POST["id_rubro"];
$id_marca = $_POST["id_marca"];

//echo "<h2>Detalles del Formulario de Productos:</h2>";
//echo "<p><strong>Descripcion:</strong> $descripcion</p>";
//echo "<p><strong>Precio:</strong> $precio</p>";
//echo "<p><strong>Rubro:</strong> $id_rubro</p>";
//echo "<p><strong>Marca:</strong> $id_marca</p>";

// Consulta para verificar si el producto ya existe
$check_query = "SELECT * FROM productos WHERE descripcion = '$descripcion' AND id_marca='$id_marca'";
$result = mysqli_query($scon, $check_query);

if (mysqli_num_rows($result) > 0) {
    //echo "El producto '$descripcion' ya existe en la base de datos.";
    echo "<script>
        $(document).ready(function () {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: `El producto '$descripcion' ya existe con esa marca en la base de datos.`,
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
    $sql = "INSERT INTO productos (descripcion,precio,id_rubro,id_marca) VALUES ('$descripcion','$precio','$id_rubro','$id_marca')";

    if (mysqli_query($scon, $sql)) {
        //echo "Producto insertado correctamente";
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

//echo "<p><a href='lista_producto.php'> Ver Lista Productos </a></p> ";
?>
