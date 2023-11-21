<?php
$scon = mysqli_connect('localhost', 'root', '', 'pujol_e_hijos_srl');

if (!$scon) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Conexion realizada correctamente";

$descripcion = $_POST["descripcion"];
$precio = $_POST["precio"];
$id_rubro = $_POST["id_rubro"];
$id_marca = $_POST["id_marca"];

echo "<h2>Detalles del Formulario de Productos:</h2>";
echo "<p><strong>Descripcion:</strong> $descripcion</p>";
echo "<p><strong>Precio:</strong> $precio</p>";
echo "<p><strong>Rubro:</strong> $id_rubro</p>";
echo "<p><strong>Marca:</strong> $id_marca</p>";

// Consulta para verificar si el producto ya existe
$check_query = "SELECT * FROM productos WHERE descripcion = '$descripcion'";
$result = mysqli_query($scon, $check_query);

if (mysqli_num_rows($result) > 0) {
    echo "El producto '$descripcion' ya existe en la base de datos.";
} else {
    // Insertar la rubro si no existe
    $sql = "INSERT INTO productos (descripcion,precio,id_rubro,id_marca) VALUES ('$descripcion','$precio','$id_rubro','$id_marca')";

    if (mysqli_query($scon, $sql)) {
        echo "Producto insertado correctamente";
    } else {
        echo "Error en la inserción: " . mysqli_error($scon);
    }
}

mysqli_close($scon);

echo "<p><a href='lista_producto.php'> Ver Lista Productos </a></p> ";
?>
