<?php 
namespace App\Daos;
use App\DAO;

use App\Models\ServicioModel;

class servicioDAO extends DAO
{
	
	function __construct()
	{
		$this->loadEloquent();
	}
	public function nums()
    {
    	return ServicioModel::selectRaw('count(*) as n')->get()[0]->n;
    }
    public function lista()
    {
    	return ServicioModel::get();
    }
}