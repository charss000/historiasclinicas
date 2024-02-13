<?php

$this->layout('../plantilla/index',['titulo'=>'CS TINTAY PUNCO - Editar Usuario'])
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
                    <form action="usuario/updateUsuario" method="post" id="actualizar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Apellidos y Nombres(*):</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control" name="na" placeholder="Por ejemplo,Juan Perez Perez" required value="<?php echo "$no"; ?>">
                                    </div>
                                </div>

                                <div class="mb-3">
                                         <label for="inputEmail3">Fecha de Nacimiento(*):</label>
                                         <div class="input-group">
                                             <div class="input-group-text">
                                                 <i class="fa fa-edit"></i>
                                             </div>
                                         <input type="date" class="form-control"  placeholder="Ejemplo,Lima peru" name="fecha" required  value="<?php echo "$fecha"; ?>" max="<?php echo date("Y-m-d"); ?>">
                                         </div>
                                </div>

                                <div class="mb-3">
                                         <label for="inputEmail3">Direccion:</label>
                                         <div class="input-group">
                                             <div class="input-group-text">
                                                 <i class="fa fa-edit"></i>
                                             </div>
                                         <input type="text" class="form-control"  placeholder="Ejemplo,Lima peru" name="direccion"  value="<?php echo "$dir"; ?>">
                                         </div>
                                </div>

                                <div class="mb-3">
                                        <label for="inputEmail3">Email(*):</label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                        <input type="email" class="form-control"  placeholder="Ejemplo,sistemassuccessr@ejemplo.com" name="mail"  value="<?php echo "$email"; ?>">
                                        </div>
                                </div>

                                <div class="mb-3">
                                             <label>Usuario(*):</label>
                                             <div class="input-group">
                                                 <div class="input-group-text">
                                                     <i class="fa fa-pencil"></i>
                                                 </div>
                                                 <input type="text" class="form-control" name="usuario" required autocomplete="off" maxlength="50"  value="<?php echo "$usuario"; ?>">
                                             </div>
                                </div>

                                <div class="mb-3">
                                                 <label>Estado(*):</label>
                                                     <select class="form-select select2" style="width: 100%;" required="true" name="es">
                                                                                         <option value="activo" <?php if($estado=='activo'){ echo 'selected'; } ?>>activo</option>
                                                                                            <option value="inactivo" <?php if($estado=='inactivo'){ echo 'selected'; } ?>>inactivo</option>
                                                     </select>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="mb-3">
                                                        <label>Sexo(*):</label>
                                                            <select class="form-select select2" style="width: 100%;" required="true" name="sexo">
                                                                                                <option value="masculino"  <?php if($se=='masculino'){ echo 'selected'; } ?>>masculino</option>
                                                                                                 <option value="femenino"  <?php if($se=='femenino'){ echo 'selected'; } ?>>femenino</option>
                                                            </select>
                                </div>

                                <div class="mb-3">
                                                    <label for="inputEmail3">Documento(*):</label>
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-edit"></i>
                                                        </div>
                                                    <input type="text" class="form-control"  placeholder="Ejemplo,12345678" name="documento" required  value="<?php echo "$doc"; ?>">
                                                    </div>
                                </div>

                                <div class="mb-3">
                                                 <label>Especialidad(*):</label>
                                                 <select name="iform-select'form-control'required>
                                                        <?php
                                                            foreach($result as $row){
                                                                if($row['idespecial']==$idesp){
                                                                    echo '<option value="'.$row['idespecial'].'" selected>'.$row['especialidad'].'</option>';
                                                                }else{
                                                                                                    echo '<option value="'.$row['idespecial'].'">'.$row['especialidad'].'</option>';
                                                                                                }
                                                                                            }
                                                            ?>
                                                    </select>
                                </div>

                                <div class="mb-3">
                                            <label>Telefono:</label>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <input type="text" class="form-control" name="tel" placeholder="Numero de telefono o celular" value="<?php echo "$tel"; ?>">
                                            </div>
                                </div>

                                <div class="mb-3">
                                                    <label>Tipo(*):</label>
                                                        <select class="form-select select2" style="width: 100%;" required="true" name="tipo">
                                                                                            <option value="administrador" <?php if($tipo=='administrador'){ echo 'selected'; } ?>>administrador</option>
                                                                                             <option value="usuario" <?php if($tipo=='usuario'){ echo 'selected'; } ?>>usuario</option>
                                                                                             <option value="laboratorio" <?php if($tipo=='laboratorio'){ echo 'selected'; } ?>>laboratorio</option>
                                                        </select>
                                </div>

                                <div class="mb-3">
                                            <label>Clave(*):</label>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <i class="fa fa-unlock"></i>
                                                </div>
                                                <input type="password" class="form-control" name="cla" placeholder="ingrese una clave segura min.de 6 digitos" value="<?php echo "$cla"; ?>" >
                                            </div>
                                </div>

                            </div>
                                    <!-- /.row -->
                        </div>

                        <div class="box-footer">
                            <center>
                                <button type="submit" value="modificar" class="btn btn-success"><i class="fa fa-pencil"></i>Modificar</button>
                                <input type="hidden" name="funcion" id="funcion" value="modificar"/>
                                <input type="hidden" name="cod" value="<?php echo $cod;?>"/>
                                <a href="/usuario/" class="btn btn-default"><i class="fa fa-close"></i> Cancelar </a></button>
                            </center>
                            <small>(*)campos obligatorios</small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

$('#actualizar').on('submit',evt=>{
  evt.preventDefault()
  var formData = new FormData(document.getElementById("actualizar"));
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
            title: 'Actualición Exitosa',
            showDenyButton: false,
            showCancelButton: false,
            confirmButtonText: 'OK',
            denyButtonText: `No'`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
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