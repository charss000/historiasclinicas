<?php
include("../central/header.php");
$obj=new clsConexion;
$result=$obj->consultar("SELECT idusu from usuario WHERE usuario='$usuario'");
  foreach((array)$result as $row){
    $idusuario=$row["idusu"];
  }
//mostrar las fechas en el fullCalendar
$events=$obj->consultar("SELECT paciente.paciente
     , cita.*
FROM
  cita
INNER JOIN paciente
ON cita.idpaciente = paciente.idpaciente
 WHERE idusuario='$idusuario'");

$result=$obj->consultar("SELECT count(*) as n from usuario");
  foreach((array)$result as $row){
    $m=$row["n"];
}
$result=$obj->consultar("SELECT count(*) as n from paciente");
  foreach((array)$result as $row){
    $p=$row["n"];
}
?>
<!DOCTYPE html>
<head>
<link rel="stylesheet" href="../plugins/fullcalendar/fullcalendar.css"/>
<script src="../plugins/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="../plugins/plugins/jQuery/jquery-ui.min.js"></script>
<script src="../plugins/fullcalendar/moment.min.js"></script>
<script src="../plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="../plugins/fullcalendar/locale/es.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="../plugins/dist/js/app.min.js"></script>
<script>

  $(document).ready(function() {
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next',
            center: 'title',
            right: 'month'
        },
        // defaultDate: '2019-07-09',
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        selectable: true,
        selectHelper: true,

        eventRender: function(eventObj, $el) {
        $el.popover({
          title: eventObj.title,
          content: eventObj.description,
          trigger: 'hover',
          placement: 'top',
          container: 'body'
        });
      },


        events: [
          <?php foreach((array)$events as $event):
    				$start = explode(" ", $event['fecha']);
    				// $end = explode(" ", $event['end']);
    				// if($start[1] == '00:00:00'){
    				// 	$start = $start[0];
    				// }else{
    				// 	$start = $event['fecha'];
    				// }
            $start = $event['fecha'];
    			?>
    				{
    				  title: '<?php echo $event['paciente'].' '.$event['hora']; ?>',
              description: 'haz clic en la (esquina superior derecha) dentro del recuadro para ver mas opciones',
    					start: '<?php echo $start; ?>',
    					color: '#FF5733',
    				},
    			<?php endforeach; ?>
            // {
            //     title: 'Ver Citas',
            //     start: '2021-05-25',
            //     color: '#FF5733',
            // }
        ],
        dayClick: function (date, jsEvent, view) {
            var date= date.format();
            window.location.href = 'cita_historia.php?date=' + date;
            // alert('Has hecho click en: '+ date.format());
        },
        // eventClick: function (calEvent, jsEvent, view) {
        //     $('#event-title').text(calEvent.title);
        //     $('#event-description').html(calEvent.description);
        //     $('#modal-event').modal();
        // },
    });
  });
  </script>
</head>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Accesos Directos
        <small>Panel De Control </small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
          <!-- <div class="container"> -->
             <div id="calendar"></div>
          <!-- </div> -->
        </div>

    </section>
    <!-- /.content -->
  </div>

<!-- primero se registran las funciones vitales y despues la historia del paciente -->
  <!-- avances de mañana citas por paciente -->
<!-- 1-se registra al paciente->2-se le asigna una cita al Paciente ->3-el medico registra la historia del paciente -->
