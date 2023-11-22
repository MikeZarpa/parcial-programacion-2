<div class="container">
  <h2>Lista de Productos</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>id_producto</th>
        <th>Descripcion</th>
        <th>Marca</th>
        <th>Precio</th>
        <th>Rubro</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $scon = mysqli_connect('localhost', 'root', '', 'pujol_e_hijos_srl');

      if (!$scon) {
          die("Connection failed: " . mysqli_connect_error());
      }

      $sql = "SELECT 
        productos.id_producto, 
        productos.descripcion AS nombre, 
        COALESCE(marca.descripcion, '-') AS marca, 
        COALESCE(rubro.descripcion, '-') AS rubro, 
        precio 
      FROM 
          productos
      LEFT JOIN 
          marca ON marca.id_marca = productos.id_marca
      LEFT JOIN 
          rubro ON productos.id_rubro = rubro.id_rubro
      ORDER BY 
          productos.descripcion;
  ";

      $result = mysqli_query($scon, $sql);

     
      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            
              echo "<tr>";
                echo "<td>" . $row["id_producto"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["marca"] . "</td>";
                echo "<td>" . $row["precio"] . "</td>";
                echo "<td>" . $row["rubro"] . "</td>";
                echo '<td class="actions"><a href="#">Editar</a> | <a href="#">Eliminar</a></td>';
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='3'>No hay prodducto disponible.</td></tr>";
      }

      mysqli_close($scon);
      ?>
    </tbody>
  </table>
  <!-- <a class="add-button" href="#">Agregar Nuevo Producto</a> -->
</div>