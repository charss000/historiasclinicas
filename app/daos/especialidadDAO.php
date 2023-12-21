<?php 
namespace App\Daos;
use App\DAO;

use App\Models\EspecialidadModel;

class especialidadDAO extends DAO
{
	
	function __construct()
	{
		$this->loadEloquent();
	}
	public function getEspecialidadesNotAdmin()
    {
    	return EspecialidadModel::where('especialidad','<>','administrador')->get();
    }
    public function getEspecialidades()
    {
    	return EspecialidadModel::get();
    }
}