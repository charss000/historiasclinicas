<?php

$this->layout('../plantilla/index',['titulo'=>'SISCLINICA -  Configuración'])
?>
<?php $this->start('contenido'); ?>

<div class="container">
    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <span class="fs-4 fw-bold">Configuración</span>
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <form role="form"  action="" method="post" enctype="multipart/form-data">
         <div class="row">
           <div class="col-md-6">
                         <div class="mb-3">
                        <label>Razon Social:</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <i class="fa fa-pencil"></i>
                            </div>
                            <input type="text" class="form-control" name="txtr" autocomplete="off"required placeholder="ingrese la razon social" value="<?php echo "$razon"; ?>" >
                        </div>
                     </div>


                            <div class="mb-3">
                                <label>Simbolo Monetario:</label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-dollar"></i>
                                    </div>
                                    <input type="text" class="form-control" name="s_mon" required autocomplete="off"placeholder="ingrese el simbolo monetario" maxlength="5"value="<?php echo "$mon_simbolo"; ?>">
                                </div>
                                </div>

                            <div class="mb-3">
                                 <label>Telefono:</label>
                                 <div class="input-group">
                                     <div class="input-group-text">
                                         <i class="fa fa-phone"></i>
                                     </div>
                                     <input type="text" class="form-control" name="tel" required autocomplete="off" placeholder="ingrese el telefono" maxlength="15" value="<?php echo "$tel"; ?>">
                                 </div>
                                 </div>

                                 <div class="mb-3">
                                        <label>Responsable:</label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <input type="text" class="form-control" name="res" required autocomplete="off" placeholder="ingrese el responsable" maxlength="100" value="<?php echo "$res"; ?>">
                                        </div>
                                        </div>

                                 <div class="mb-3">
                        <label>Logo:</label>
                        <div class="input-group">
                          <div class="input-group-text">
                            <i class="fa fa-camera"></i>
                          </div>
                          <input type="file" name="imagen" size="44" accept="image/jpeg" class="form-control" id="field-file">
                          <input id="funcion" name="funcion" value="registrar" type="hidden">
                        </div>
                        <p class="help-block">Archivos Permitidos(.jpg y.png)</p>
                      </div>
                                <div class="mb-3">
                                         <img src="/asset/img/foto/<?php echo $logo?>" width="160px" height="140px" border="1">
                                         <input type="hidden" name="img_eliminar_1" value="<?php echo $logo ?>">
                                </div>

           </div>
               <div class="col-md-6">

                                                     <div class="mb-3">
                                                            <label>Ruc:</label>
                                                            <div class="input-group">
                                                                <div class="input-group-text">
                                                                    <i class="fa fa-edit"></i>
                                                                </div>
                                                                <input type="text" class="form-control" name="ruc" required autocomplete="off"placeholder="ingrese el ruc" maxlength="11" value="<?php echo "$ruc"; ?>">
                                                            </div>
                                                            </div>
                                 <div class="mb-3">
                                    <label>Moneda:</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <i class="fa fa-dollar"></i>
                                        </div>
                                        <select class='form-select' name="mon" required>
                                                                 <option value="SOLES" <?php if($moneda=='SOLES'){ echo 'selected'; } ?>>SOLES</option>
                                                                 <option value="DOLARES" <?php if($moneda=='DOLARES'){ echo 'selected'; } ?>>DOLARES</option>
                                                                 <option value="PESOS" <?php if($moneda=='PESOS'){ echo 'selected'; } ?>>PESOS</option>
                                                                 <option value="EUROS" <?php if($moneda=='EUROS'){ echo 'selected'; } ?>>EUROS</option>
                                                                 <option value="QUETZALES" <?php if($moneda=='QUETZALES'){ echo 'selected'; } ?>>QUETZALES</option>
                                                                 <option value="COLONES" <?php if($moneda=='COLONES'){ echo 'selected'; } ?>>COLONES</option>
                                                                 <option value="GUARANIES" <?php if($moneda=='PESOS'){ echo 'selected'; } ?>>GUARANIES</option>

                             </select>
                                    </div>
                                    </div>

                                 <div class="mb-3">
                                     <label>Impuesto:</label>
                                     <div class="input-group">
                                         <div class="input-group-text">
                                             <i class="fa fa-percent"></i>
                                         </div>
                                         <input type="number" min="0" class="form-control" name="in" required autocomplete="off"placeholder="ej:18" maxlength="5"value="<?php echo "$in"; ?>">
                                     </div>
                                     </div>

                                     <div class="mb-3">
                                         <label>Sigla del Impuesto:</label>
                                         <div class="input-group">
                                             <div class="input-group-text">
                                                 <i class="fa fa-edit"></i>
                                             </div>
                                             <input type="text" class="form-control" name="il" required autocomplete="off"placeholder="ejemplo: IGV,IVA,..." maxlength="5"value="<?php echo "$il"; ?>">
                                         </div>
                                         </div>

                                         <div class="mb-3">
                                             <label>Direccion:</label>
                                             <div class="input-group">
                                                 <div class="input-group-text">
                                                     <i class="fa fa-edit"></i>
                                                 </div>
                                                 <input type="text" class="form-control" name="dir" required autocomplete="off" placeholder="ingrese su direccion" maxlength="100" value="<?php echo "$dir"; ?>">
                                             </div>
                                             </div>

                                 <div class="mb-3">
                                 <label>Zona Horaria:</label>
                                 <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <select class='form-select' name="zona" required>
                                                             <option value="Africa/Cairo" <?php if($zona=='Africa/Cairo'){ echo 'selected'; } ?>>Africa/Cairo</option>
                                                             <option value="America/Bogota" <?php if($zona=='America/Bogota'){ echo 'selected'; } ?>>America/Bogota</option>
                                                             <option value="America/Buenos_Aires" <?php if($zona=='America/Buenos_Aires'){ echo 'selected'; } ?>>America/Buenos_Aires</option>
                                                             <option value="America/Caracas" <?php if($zona=='America/Caracas'){ echo 'selected'; } ?>>America/Caracas</option>
                                                             <option value="America/Chihuahua" <?php if($zona=='America/Chihuahua'){ echo 'selected'; } ?>>America/Chihuahua</option>
                                                             <option value="America/Costa_Rica" <?php if($zona=='America/Costa_Rica'){ echo 'selected'; } ?>>America/Costa_Rica</option>
                                                             <option value="America/El_Salvador" <?php if($zona=='America/El_Salvador'){ echo 'selected'; } ?>>America/El_Salvador</option>
                                                             <option value="America/Guatemala" <?php if($zona=='America/Guatemala'){ echo 'selected'; } ?>>America/Guatemala</option>
                                                             <option value="America/La_Paz" <?php if($zona=='America/La_Paz'){ echo 'selected'; } ?>>America/La_Paz</option>
                                                             <option value="America/Lima" <?php if($zona=='America/Lima'){ echo 'selected'; } ?>>America/Lima</option>
                                                             <option value="America/Mazatlan" <?php if($zona=='America/Mazatlan'){ echo 'selected'; } ?>>America/Mazatlan</option>
                                                             <option value="America/Mexico_City" <?php if($zona=='America/Mexico_City'){ echo 'selected'; } ?>>America/Mexico_City</option>
                                                             <option value="America/Monterrey" <?php if($zona=='America/Monterrey'){ echo 'selected'; } ?>>America/Monterrey</option>
                                                             <option value="America/Santiago" <?php if($zona=='America/Santiago'){ echo 'selected'; } ?>>America/Santiago</option>
                                                             <option value="America/Guayaquil" <?php if($zona=='America/Guayaquil'){ echo 'selected'; } ?>>America/Guayaquil</option>
                                                             <option value="America/Tijuana" <?php if($zona=='America/Tijuana'){ echo 'selected'; } ?>>America/Tijuana</option>
                                                             <option value="America/Asuncion" <?php if($zona=='America/Asuncion'){ echo 'selected'; } ?>>America/Asuncion</option>
                                                             <option value="Asia/Almaty" <?php if($zona=='Asia/Almaty'){ echo 'selected'; } ?>>Asia/Almaty</option>
                                                             <option value="Atlantic/Stanley" <?php if($zona=='Atlantic/Stanley'){ echo 'selected'; } ?>>Atlantic/Stanley</option>
                                                             <option value="Canada/Atlantic"<?php if($zona=='Canada/Atlantic'){ echo 'selected'; } ?>>Canada/Atlantic</option>
                                                             <option value="Canada/Newfoundland"<?php if($zona=='Canada/Newfoundland'){ echo 'selected'; } ?>>Canada/Newfoundland</option>
                                                             <option value="Canada/Saskatchewan"<?php if($zona=='Canada/Saskatchewan'){ echo 'selected'; } ?>>Canada/Saskatchewan</option>
                                                             <option value="Europe/Amsterdam" <?php if($zona=='Europe/Amsterdam'){ echo 'selected'; } ?>>Europe/Amsterdam</option>
                                                             <option value="Europe/Berlin" <?php if($zona=='Europe/Berlin'){ echo 'selected'; } ?>>Europe/Berlin</option>
                                                             <option value="Europe/London" <?php if($zona=='Europe/London'){ echo 'selected'; } ?>>Europe/London</option>
                                                             <option value="Europe/Madrid"<?php if($zona=='Europe/Madrid'){ echo 'selected'; } ?> >Europe/Madrid</option>
                                                             <option value="Europe/Minsk" <?php if($zona=='Europe/Minsk'){ echo 'selected'; } ?>>Europe/Minsk</option>
                                                             <option value="Europe/Moscow" <?php if($zona=='Europe/Moscow'){ echo 'selected'; } ?>>Europe/Moscow</option>
                                                             <option value="Europe/Paris" <?php if($zona=='Europe/Paris'){ echo 'selected'; } ?>>Europe/Paris</option>
                                                             <option value="Greenland" <?php if($zona=='Greenland'){ echo 'selected'; } ?>>Greenland</option>
                                                             <option value="Pacific/Auckland" <?php if($zona=='Pacific/Auckland'){ echo 'selected'; } ?>>Pacific/Auckland</option>
                                                             <option value="Pacific/Fiji" <?php if($zona=='Pacific/Fiji'){ echo 'selected'; } ?>>Pacific/Fiji</option>
                                                             <option value="Pacific/Guam"<?php if($zona=='Pacific/Guam'){ echo 'selected'; } ?>>Pacific/Guam</option>
                                                             <option value="Pacific/Port_Moresby"<?php if($zona=='Pacific/Port_Moresby'){ echo 'selected'; } ?>>Pacific/Port_Moresby</option>
                                                             <option value="US/Alaska"<?php if($zona=='US/Alaska'){ echo 'selected'; } ?>>US/Alaska</option>
                                                             <option value="US/Arizona"<?php if($zona=='US/Arizona'){ echo 'selected'; } ?>>US/Arizona</option>
                                                             <option value="US/Central"<?php if($zona=='US/Central'){ echo 'selected'; } ?>>US/Central</option>
                                                             <option value="US/East-Indiana" <?php if($zona=='US/East-Indiana'){ echo 'selected'; } ?>>US/East-Indiana</option>
                                                             <option value="US/Eastern" <?php if($zona=='US/Eastern'){ echo 'selected'; } ?>>US/Eastern</option>
                                                             <option value="US/Hawaii"<?php if($zona=='US/Hawaii'){ echo 'selected'; } ?>>US/Hawaii</option>
                                                             <option value="US/Mountain" <?php if($zona=='US/Mountain'){ echo 'selected'; } ?>>US/Mountain</option>
                                                             <option value="US/Pacific" <?php if($zona=='US/Pacific'){ echo 'selected'; } ?>>US/Pacific</option>
                                                             <option value="US/Samoa" <?php if($zona=='US/Samoa'){ echo 'selected'; } ?>>US/Samoa</option>

                     </select>
                                 </div>
                                </div>

         </div>
       </div>
       <div class="box-footer">
             <center>
                <button type="submit" value="modificar" class="btn btn-success"><i class="fa fa-pencil"></i> Ingresar</button>
                 <input type="hidden" name="funcion" id="funcion" value="modificar"/>

             </center>
            </div>
    </form>            
          </div>
        </div>
      </div>
      
    </div>
</div>

<?php $this->stop(); ?>