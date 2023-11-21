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

      return true; // El formulario se enviará si todos los campos están completos.
    }
  </script>
  <div class="container">
    <h2>Formulario de Productos</h2>
    <form action="form_productos_pujol/datos_recibidos.php" method="post" onsubmit="return validarFormulario();">
      <div class="form-group">
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion"  class="form-control">
      </div>
      <div class="form-group">
        <label for="precio">Precio:</label>
        <input type="text" id="precio" name="precio" class="form-control">
      </div>
      <div class="form-group">
        <label for="id_rubro">Rubro:</label>
        <select name="id_rubro" id="id_rubro" class="form-control">
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
                // Inserta la respuesta en un modal para mostrarla
                $("#myModal .modal-body").html(response);
                $("#myModal").modal("show");
                // Resetear el formulario después de mostrar el modal
                $("form")[0].reset();
            }
        });
      });
  });
</script>

<!-- Agrega el modal al final de tu cuerpo HTML -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
      <div class="modal-content">

          <!-- Cabecera del Modal -->
          <div class="modal-header">
              <h4 class="modal-title">Respuesta del Servidor</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Cuerpo del Modal -->
          <div class="modal-body">
              <!-- El texto de la respuesta se mostrará aquí -->
          </div>

          <!-- Pie del Modal -->
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
      </div>
    </div>
</div>