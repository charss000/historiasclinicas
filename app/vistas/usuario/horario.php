<?php

$this->layout('../plantilla/index',['titulo'=>'SISCLINICA - Horario Usuario'])
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
                <b>ASIGNAR HORARIOS AL USUARIO : <?php echo "$no_usu"; ?></b>
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="" method="post">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Horarios</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="card-body no-padding">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th style="width: 10px">Atiende</th>
                                            <th style="width: 80px">Día</th>
                                            <th style="width: 50px">Hora De inicio</th>
                                            <th style="width: 50px">Hora De Fin</th>
                                            <th style="width: 30px">Duración(min)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1.</td>
                                            <td><input name="estado[1]" type="checkbox" <?php if($estado1=='1') {echo "checked='checked'";}?>></td>
                                            <td>Lunes</td>
                                            <td><input type="time" name="hora_inicio[1]" value="<?php echo "$hi1"; ?>"></td>
                                            <td><input type="time" name="hora_fin[1]"  value="<?php echo "$hf1"; ?>"></td>
                                            <td><input type="number" min="0" max="60" name="duracion[1]" value="<?php echo "$d1"; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td><input name="estado[2]" type="checkbox" <?php if($estado2=='1') {echo "checked='checked'";}?>></td>
                                            <td>Martes</td>
                                            <td><input type="time" name="hora_inicio[2]" value="<?php echo "$hi2"; ?>"></td>
                                            <td><input type="time" name="hora_fin[2]" value="<?php echo "$hf2"; ?>"></td>
                                            <td><input type="number" min="0" max="60" name="duracion[2]" value="<?php echo "$d2"; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>3.</td>
                                            <td><input name="estado[3]" type="checkbox" <?php if($estado3=='1') {echo "checked='checked'";}?>></td>
                                            <td>Miercoles</td>
                                            <td><input type="time" name="hora_inicio[3]" value="<?php echo "$hi3"; ?>"></td>
                                            <td><input type="time" name="hora_fin[3]" value="<?php echo "$hf3"; ?>"></td>
                                            <td><input type="number" min="0" max="60" name="duracion[3]" value="<?php echo "$d3"; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>4.</td>
                                            <td><input name="estado[4]" type="checkbox" <?php if($estado4=='1') {echo "checked='checked'";}?>></td>
                                            <td>Jueves</td>
                                            <td> <input type="time" name="hora_inicio[4]" value="<?php echo "$hi4"; ?>"></td>
                                            <td><input type="time" name="hora_fin[4]" value="<?php echo "$hf4"; ?>"></td>
                                            <td> <input type="number" min="0" max="60" name="duracion[4]" value="<?php echo "$d4"; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>5.</td>
                                            <td><input name="estado[5]" type="checkbox" <?php if($estado5=='1') {echo "checked='checked'";}?>></td>
                                            <td>Viernes</td>
                                            <td> <input type="time" name="hora_inicio[5]" value="<?php echo "$hi5"; ?>"></td>
                                            <td><input type="time" name="hora_fin[5]" value="<?php echo "$hf5"; ?>"></td>
                                            <td> <input type="number" min="0" max="60" name="duracion[5]" value="<?php echo "$d5"; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>6.</td>
                                            <td><input name="estado[6]" type="checkbox" <?php if($estado6=='1') {echo "checked='checked'";}?>></td>
                                            <td>Sabado</td>
                                            <td> <input type="time" name="hora_inicio[6]" value="<?php echo "$hi6"; ?>"></td>
                                            <td><input type="time" name="hora_fin[6]" value="<?php echo "$hf6"; ?>"></td>
                                            <td> <input type="number" min="0" max="60" name="duracion[6]" value="<?php echo "$d6"; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td>7.</td>
                                            <td><input name="estado[7]" type="checkbox" <?php if($estado7=='1') {echo "checked='checked'";}?>></td>
                                            <td>Domingo</td>
                                            <td> <input type="time" name="hora_inicio[7]" value="<?php echo "$hi7"; ?>"></td>
                                            <td><input type="time" name="hora_fin[7]" value="<?php echo "$hf7"; ?>"></td>
                                            <td> <input type="number" min="0" max="60" name="duracion[7]" value="<?php echo "$d7"; ?>"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="card-footer">
                           <center>
                            <button type="submit" value="modificar" class="btn btn-success"><i class="fa fa-pencil"></i> Ingresar</button>
                             <input type="hidden" name="funcion" id="funcion" value="modificar"/>
                             <input type="hidden" name="idusu" value="<?php echo $idusu;?>"/>
                             <a href="index.php" class="btn btn-light btn-sm btn-outline-dark"><i class="fa fa-close"></i> Cancelar </a>

                           </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
if (isset($ok)) { ?>
    <script>
        Swal.fire({
                      icon: 'success',
                      title: 'Su Información Fue guardado',
                      showConfirmButton: false,
                      timer: 1500
                    }).then(j=>{
                        location.href='/usuario/'
                    })
    </script>
<?php }
 ?>
<?php $this->stop(); ?>