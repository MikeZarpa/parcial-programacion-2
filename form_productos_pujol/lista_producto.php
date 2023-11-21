<div class="container">
  <h2>Lista de Productos</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>id_producto</th>
        <th>descripcion</th>
        <th>precio</th>
        <th>id_rubro</th>
        <th>id_marca</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $scon = mysqli_connect('localhost', 'root', '', 'pujol_e_hijos_srl');

      if (!$scon) {
          die("Connection failed: " . mysqli_connect_error());
      }

      $sql = "SELECT id_producto, descripcion,precio FROM productos";

      $result = mysqli_query($scon, $sql);

     
      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            
              echo "<tr>";
                echo "<td>" . $row["id_producto"] . "</td>";
                echo "<td>" . $row["descripcion"] . "</td>";
                echo "<td>" . $row["precio"] . "</td>";
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
  <a class="add-button" href="#">Agregar Nuevo Producto</a>
</div>