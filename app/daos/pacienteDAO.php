<?php 
namespace App\Daos;
use App\DAO;

use App\Models\PacienteModel;

class pacienteDAO extends DAO
{
	
	function __construct()
	{
		$this->loadEloquent();
	}
	public function nums()
    {
    	return PacienteModel::selectRaw('count(*) as n')->get()[0]->n;
    }
    public function historialFull()
    {
    	return PacienteModel::select('paciente.paciente','historia.fecha', 'historia.idpaciente', 'historia.idusuario', 'historia.idhistoria')->join('historia','historia.idpaciente', '=', 'paciente.idpaciente')->groupBy('historia.idpaciente')->orderBy('historia.idhistoria', 'DESC')->get();
    }
    public function lista()
    {
    	return PacienteModel::get();
    }
    public function getPaciente($field,$user)
    {
        return PacienteModel::where($field, '=', $user)->get();
    }
    public function search($p)
    {

        return PacienteModel::where('paciente', 'like', '%' .($p) . '%')->limit(100)->get();
    }
    public function setPaciente($arr)
    {
        return PacienteModel::insertGetId($arr);
    }
    public function updatePaciente($p,$arr)
    {
        PacienteModel::where('idpaciente','=',$p)->update($arr);
    }
}