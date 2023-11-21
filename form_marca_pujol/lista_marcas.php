<div class="container">
  <h2>Lista de Marcas</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>id_marca</th>
        <th>descripcion</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $scon = mysqli_connect('localhost', 'root', '', 'pujol_e_hijos_srl');

      if (!$scon) {
          die("Connection failed: " . mysqli_connect_error());
      }

      $sql = "SELECT id_marca, descripcion FROM marca";

      $result = mysqli_query($scon, $sql);

     
      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            
              echo "<tr>";
                echo "<td>" . $row["id_marca"] . "</td>";
                echo "<td>" . $row["descripcion"] . "</td>";
                echo '<td class="actions"><a href="#">Editar</a> | <a href="#">Eliminar</a></td>';
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='3'>No hay marcas disponibles.</td></tr>";
      }

      mysqli_close($scon);
      ?>
    </tbody>
  </table>
  <!-- <a class="add-button" href="#">Agregar Nueva Marca</a> -->
</div>
