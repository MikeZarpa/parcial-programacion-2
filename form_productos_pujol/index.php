  <script>
    function validarFormulario() {

      var descripcion = document.getElementById("descripcion").value;
      var precio = document.getElementById("precio").value;
      var id_rubro = document.getElementById("id_rubro").value;
      var id_marca = document.getElementById("id_marca").value;

      if (descripcion.trim() === "") {
        alert("Por favor, ingrese la descripcion del producto.");
        return false;
      }
      if (precio.trim() === "") {
        alert("Por favor, ingrese el precio del producto.");
        return false;
      }
      if(id_marca == "null" || id_rubro=="null")
        return window.confirm("Estas por ingresar un producto sin seleccionar la Marca o el Rubro, ¿deseas continuar?");

      return true; // El formulario se enviará si todos los campos están completos.
    }
  </script>
  <div class="container">
    <h2>Formulario de Productos</h2>
    <form action="form_productos_pujol/datos_recibidos.php" method="post">
      <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion"  class="form-control" required>
      </div>
      <div class="form-group">
        <label for="precio">Precio:</label>
        <input type="text" id="precio" name="precio" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="id_rubro">Rubro:</label>
        <select name="id_rubro" id="id_rubro" class="form-control">
          <option value="null">Seleccione una opción</option>
          <?php
            $scon = mysqli_connect('localhost', 'root', '', 'pujol_e_hijos_srl');
              
            if (!$scon) {
              die("Connection failed: " . mysqli_connect_error());
            }
            
            $sql = "SELECT id_rubro, descripcion FROM rubro";
            
            $result = mysqli_query($scon, $sql);
            
            
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {                  
                $value = $row["id_rubro"];
                $descripcion = $row["descripcion"];
                echo "<option value='$value'>$descripcion </option>";
              }
            }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="id_marca">Marca:</label>
        <select name="id_marca" id="id_marca" class="form-control">
          <option value="null">Seleccione una opción</option>
          <?php
                        
            $sql = "SELECT id_marca, descripcion FROM marca";
            
            $result = mysqli_query($scon, $sql);
            
            
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {                  
                $value = $row["id_marca"];
                $descripcion = $row["descripcion"];
                echo "<option value='$value' >$descripcion </option>";
              }
            }
            
            mysqli_close($scon);
            ?>
        </select>
      </div>
     
      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
  </div>
  <script>
    $(document).ready(function () {
      //Seleccionamos algún formulario en pantalla, esperemos que haya solo 1...
      $("form").submit(function (event) {
          //Evitamos que salga con su comportamiento por defecto.
          event.preventDefault();

          //Validamos el formulario
          if(!validarFormulario()){
            return;
          }
  
          //Obtenemos la direccion escrita en el atributo action del formulario.
          var urlDestino = $("form").attr("action");
  
          // Obtener los datos del formulario en formato de cadena de consulta
          var formData = $("form").serialize();
          
          // Realizar la solicitud AJAX para verificar la autenticación
          $.ajax({
              type: "POST",
              url: urlDestino,
              data: formData,
              success: function (response) {
                  // Inserta la respuesta
                  $("#scripts").html(response);
                  // Resetear el formulario
                  $("form")[0].reset();
              }
          });
        });
    });
  </script>
  <div id="scripts"></div>