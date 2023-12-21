<?php

namespace App;



class Controller
{
    //renderiza las plantillas
    public function render($viewName)
    {

        require_once 'app/vistas/' . $viewName . '.php';
    }

    public function renderTemplate($directory)
    {
        //carga el directorio de la plantilla
        $this->templates = new \League\Plates\Engine(RAIZ . 'app/vistas/' . $directory);
        if (isset($_SESSION['login'])) {
            if($_SESSION['tipo']=='administrador'){
                $this->templates->addData(['btnAside'=>[['Inicio','active','/','fa-solid fa-house'],['Historias','','/historia/','fa-solid fa-clock-rotate-left'],['Paciente','','/paciente/','fa-solid fa-wheelchair'],['Pagos','','/venta/','fa-solid fa-dollar'],['Servicio-Producto','','/servicio/','fa-solid fa-edit'],['Citas','','/cita/','fa-regular fa-clock'],['Modulo Usuario','','','fa-solid fa-stethoscope',[['Usuario Medico','','/usuario/','fa-solid fa-users'],['especialidad','','/especialidad/','fa-solid fa-stethoscope']]],['Reportes','','','fa-solid fa-signal',[['Ingresos','','/reporte/','fa-solid fa-money']]],['Respaldo','','/historias/','fa-solid fa-database'],['Configuracion','','/configuracion/','fa-solid fa-cogs']]]);
            }else if($_SESSION['tipo']=='laboratorio'){
                $this->templates->addData(['btnAside'=>[['Laboratorio','active','/','fa fa-flask']]]);
            }else{
                $this->templates->addData(['btnAside'=>[['Calendario','active','/','fa fa-calendar'],['Historias','','/historia/','fa-solid fa-clock-rotate-left'],['Historial','','/historia/historial/','fa fa-address-card'],['laboratorio','','/laboratorio/','fa fa-flask'],['Documentos','','/documento/','fa fa-file'],['Proxima Cita','','/cita/usuario/','fa-regular fa-clock']]]);
            }
        }
    }

    public function loadDAO($name)
    {
        //carga las conecciones a la base de datos
        $url = 'app/daos/' . lcfirst($name) . 'DAO.php';
        if (file_exists($url)) {
            $daoName = 'App\\Daos\\' . $name . 'DAO';
            $this->dao = new $daoName;
        }
    }
}
