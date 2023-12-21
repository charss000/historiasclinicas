<?php

$this->layout('../plantilla/index',['titulo'=>'SISCLINICA - Insertar Paciente'])
?>

<?php $this->push('script_librerias1'); ?>
  <script src="/asset/libs/jquery-3.7.1.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<?php $this->end(); ?>
<?php $this->start('contenido'); ?>

<div class="container-fluid">
    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <b>PACIENTE</b>
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <div class="container">
                <form action="paciente/add" method="post" id="insertar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                               <label>Apellidos y Nombres(*):</label>
                               <div class="input-group">
                                 <div class="input-group-text">
                                   <i class="fa fa-user"></i>
                                 </div>
                                 <input type="text" class="form-control" name="no" placeholder="Por ejemplo,Juan Perez Perez" required>
                               </div>
                            </div>
                                                 <!-- <input type="time" name="" value="00:00 a.m."> -->

                            <div class="mb-3">
                            <label for="inputEmail3">Fecha de Nacimiento(*):</label>
                            <div class="input-group">
                              <div class="input-group-text">
                                <i class="fa fa-calendar"></i>
                              </div>
                            <input type="date" class="form-control"  placeholder="Ejemplo,Lima peru" name="fecha" required max="<?php echo (date('Y-m-d'));?>">
                            </div>
                           </div>

                           <div class="mb-3">
                             <label>Estado Civil(*):</label>
                               <select class="form-select select2" style="width: 100%;" required="true" name="ec">
                                                 <option value="soltero">soltero</option>
                                                  <option value="casado">casado</option>
                                                  <option value="viudo">viudo</option>
                                                  <option value="divorciado">divorciado</option>
                                                  <option value="conviviente">conviviente</option>
                               </select>
                          </div>

                          <div class="mb-3">
                          <label>Email:</label>
                          <div class="input-group">
                            <div class="input-group-text">
                              <i class="fa fa-envelope"></i>
                            </div>
                          <input type="email" class="form-control"  placeholder="Ejemplo,sistemassuccessr@ejemplo.com" name="mail">
                          </div>
                        </div>

                        <div class="mb-3">
                        <label>Apoderado:</label>
                        <div class="input-group">
                          <div class="input-group-text">
                            <i class="fa fa-users"></i>
                          </div>
                        <input type="text" class="form-control"  placeholder="Ejemplo,padre jose" name="apo">
                        </div>
                      </div>

                          </div>
                                  <div class="col-md-6">
                                <div class="mb-3">
                                  <label>Sexo(*):</label>
                                    <select class="form-control select2" style="width: 100%;" required="true" name="sexo">
                                                      <option value="masculino">masculino</option>
                                                       <option value="femenino">femenino</option>
                                    </select>
                               </div>

                               <div class="mb-3">
                                <label>Numero Documento(*):</label>
                                 <div class="input-group">
                                  <div class="input-group-text">
                                  <i class="fa fa-edit"></i>
                                </div>
                                <input type="text" class="form-control" name="num_docu" placeholder="ejemplo:12345678" required maxlength="15">
                                 </div>
                              </div>

                              <div class="mb-3">
                               <label>Direccion:</label>
                                <div class="input-group">
                                 <div class="input-group-text">
                                 <i class="fa fa-edit"></i>
                               </div>
                               <input type="text" class="form-control" name="dir" placeholder="ingrese su direccion">
                                </div>
                             </div>

                             <div class="mb-3">
                              <label>Telefono/celular:</label>
                               <div class="input-group">
                                <div class="input-group-text">
                                <i class="fa fa-phone"></i>
                              </div>
                              <input type="text" class="form-control" name="tel" placeholder="Numero de telefono o celular" >
                               </div>
                            </div>


                        </div>
                        <!-- /.row -->
                      </div>
                <!-- /.box-body -->
                <div class="box-footer">
                 <center><button type="submit" name="funcion" value="registrar" class="btn btn-success"><i class="fa fa-save"></i> Registrar </button>
                     <a href="index.php" class="btn btn-default"><i class="fa fa-close"></i> Cancelar </a></button>
                 </center>
                    <small>(*)campos obligatorios</small>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<script>

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
            title: 'Desea Registrar otro Paciente?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Sí',
            denyButtonText: `No'`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                location.reload()
            } else if (result.isDenied) {
                self.location='/paciente/'
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