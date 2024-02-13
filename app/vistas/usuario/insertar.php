<?php

$this->layout('../plantilla/index',['titulo'=>'CS TINTAY PUNCO - Insertar Usuario'])
?>

<?php $this->push('script_librerias1'); ?>
  <script src="/asset/libs/jquery-3.7.1.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<?php $this->end(); ?>
<?php $this->start('contenido'); ?>

<div class="container-fluid mt-3">
    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <b>USUARIO- MEDICO</b>
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <div class="container">
                <form action="usuario/addUsuario" method="post" id="insertar">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="fw-bold">Apellidos y Nombres(*):</label>
                        <div class="input-group">
                          <div class="input-group-text">
                            <i class="fa fa-user"></i>
                          </div>
                          <input type="text" class="form-control" name="na" placeholder="Por ejemplo,Juan Perez Perez" required />
                        </div>
                      </div>

                      <div class="mb-3">
                        <label class="fw-bold" for="inputEmail3">Fecha de Nacimiento(*):</label>
                        <div class="input-group">
                          <div class="input-group-text">
                            <i class="fa fa-edit"></i>
                          </div>
                          <input type="date" class="form-control"  placeholder="Ejemplo,Lima peru" name="fecha" required max="<?php echo date("Y-m-d"); ?>" />
                        </div>
                      </div>

                      <div class="mb-3">
                        <label class="fw-bold" for="inputEmail3">Direccion:</label>
                        <div class="input-group">
                          <div class="input-group-text">
                            <i class="fa fa-edit"></i>
                          </div>
                          <input type="text" class="form-control"  placeholder="Ejemplo,Lima peru" name="direccion">
                        </div>
                      </div>

                      <div class="mb-3">
                        <label class="fw-bold" for="inputEmail3">Email:</label>
                        <div class="input-group">
                          <div class="input-group-text">
                          <i class="fa fa-envelope"></i>
                          </div>
                          <input type="email" class="form-control"  placeholder="Ejemplo,sistemassuccessr@ejemplo.com" name="mail" >
                        </div>
                      </div>

                      <div class="mb-3">
                         <label class="fw-bold">Usuario(*):</label>
                         <div class="input-group">
                           <div class="input-group-text">
                             <i class="fa fa-pencil"></i>
                           </div>
                           <input type="text" class="form-control" name="usuario" required autocomplete="off" maxlength="50">
                         </div>
                      </div>

                      <div class="mb-3">
                          <label class="fw-bold">Tipo(*):</label>
                          <select class="form-select" style="width: 100%;" required="true" name="tipo" id="tipo">
                            <option value="">SELECCIONE</option>
                            <option value="administrador">administrador</option>
                            <option value="usuario">usuario</option>
                            <option value="laboratorio">laboratorio</option>
                          </select>
                      </div>

                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label class="fw-bold">Sexo(*):</label>
                        <select class="form-select" style="width: 100%;" required="true" name="sexo">
                          <option value="masculino">masculino</option>
                          <option value="femenino">femenino</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="fw-bold" for="inputEmail3">Documento(*):</label>
                        <div class="input-group">
                          <div class="input-group-text">
                            <i class="fa fa-edit"></i>
                          </div>
                          <input type="text" class="form-control"  placeholder="Ejemplo,12345678" name="documento" required>
                        </div>
                      </div>
                      <!-- especialidad -->
                      <div class="mb-3">
                        <label class="fw-bold">Telefono:</label>
                        <div class="input-group">
                          <div class="input-group-text">
                            <i class="fa fa-phone"></i>
                          </div>
                          <input type="text" class="form-control" name="tel" placeholder="Numero de telefono o celular">
                        </div>
                      </div>

                      <div class="mb-3">
                        <label class="fw-bold">Estado(*):</label>
                        <select class="form-select" style="width: 100%;" required="true" name="es">
                          <option value="activo">activo</option>
                          <option value="inactivo">inactivo</option>
                        </select>
                      </div>

                      <div class="mb-3">
                        <label class="fw-bold">Clave(*):</label>
                        <div class="input-group">
                          <div class="input-group-text">
                            <i class="fa fa-unlock"></i>
                          </div>
                          <input type="password" class="form-control" name="cla" placeholder="ingrese una clave segura min.de 6 digitos" required >
                        </div>
                      </div>

                      <div class="mb-3" id="idesp">
                        <label class="fw-bold">Especialidad(*):</label>
                        <select name="idesp" class='form-select' required>
                         <?php
                                           //   $result=$obj->consultar("SELECT * from especialidad where especialidad<>'administrador'");
                                           foreach($result as $row){
                                             echo '<option value="'.$row['idespecial'].'" >'.$row['especialidad'].'</option>';
                                              
                                           }
                           ?>
                        </select>
                      </div>

                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.box-body -->
                <!-- establecer horarios profesores -->
                <div class="mt-3">
                 <center><button type="submit" name="funcion" value="registrar" class="btn btn-success"><i class="fa fa-save"></i> Registrar </button>
                     <a href="/usuario/" class="btn btn-light btn-sm btn-outline-dark"><i class="fa fa-close"></i> Cancelar </a></button>
                 </center>
                  <!-- <small>(*)campos obligatorios</small> -->
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<script>
  $('#idesp').hide();
$('#tipo').change(function(){
    var tipo = $('#tipo').val();
    var idesp = $('#idesp').val();
          if (tipo=='administrador') {
              $('#idesp').hide();
          } else {
              $('#idesp').show('');
          }
});
$('#insertar').on('submit',evt=>{
  evt.preventDefault()
  var formData = new FormData(document.getElementById("insertar"));
  $.ajax({
    url:'/api/'+evt.target.attributes["action"].value,
    type: "post",
    dataType: "json",
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    beforeSend: function() {
      $('.msg').html("<img src='/asset/img/ajax-loader.gif' />");
    },
  }).done(response=>{
    if (response != 'error') {
        Swal.fire({
            title: 'Desea Registrar otro usuario?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Sí',
            denyButtonText: `No'`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                location.reload()
            } else if (result.isDenied) {
                self.location='/usuario/'
            }
        })
      }else{
        Swal.fire({
             icon: 'error',
            title: 'Ocurrió un error en el Servidor',
                            showConfirmButton: false,
                            timer: 2000
                        })
      }
  })
  
})
</script>
<?php $this->stop(); ?>