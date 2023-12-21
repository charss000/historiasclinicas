<?php 
namespace App\Daos;
use App\DAO;

use App\Models\UsuarioModel;
use App\Models\DiaUsuarioModel;
use App\Models\ServicioModel;
use App\Models\CitaModel;
use Illuminate\Database\Capsule\Manager as DB;


class usuarioDAO extends DAO
{
	
	function __construct()
	{
		$this->loadEloquent();
	}
	public function usuarioExiste($user)
	{
		$rs = UsuarioModel::where('usuario', '=', $user)->get();
		if ($rs->count() == 1) {
			return true;
		}else{
			return false;
		}
	}
	public function password($usuario)
    {
        $contr = UsuarioModel::select('clave')->where('usuario', '=', $usuario)->get();
        return array_column($contr->toArray(), 'clave');
    }
    public function getUsuario($field,$user)
    {
    	return UsuarioModel::where($field, '=', $user)->get();
    }
    public function nums()
    {
    	return UsuarioModel::selectRaw('count(*) as n')->get()[0]->n;
    }
    public function getUsuariosEspecialidad()
    {
    	return UsuarioModel::select('usuario.*','especialidad.especialidad')->join('especialidad','usuario.idespecialidad','=','especialidad.idespecial')->get();
    }
    public function getUsuarioEspecialidad($idu)
    {
        return UsuarioModel::select('usuario.*','especialidad.especialidad')->join('especialidad','usuario.idespecialidad','=','especialidad.idespecial')->where('idusu','=',$idu)->get();
    }
    public function getUsuarioServicio($idu)
    {
        return ServicioModel::where('idusu','=',$idu)->get();
    }

    public function setUsuario($arr)
    {
    	return UsuarioModel::insertGetId($arr);
    }
    public function updateUsuario($arr,$field,$cond)
    {
    	UsuarioModel::where($field,'=',$cond)->update($arr);
    }

    public function setDiaUsuario($arr)
    {
    	DiaUsuarioModel::insert($arr);
    }
    public function getDiasUsuario($idu)
    {
        $dd1=DiaUsuarioModel::select('id','estado', 'hora_inicio', 'hora_fin', 'duracion')->selectRaw("'idd1' as variable")->selectRaw('idd as valor')->where('idd','=','1')->where('idu','=',$idu);
        $dd2=DiaUsuarioModel::select('id','estado', 'hora_inicio', 'hora_fin', 'duracion')->selectRaw("'idd2' as variable")->selectRaw('idd as valor')->where('idd','=','2')->where('idu','=',$idu);
        $dd3=DiaUsuarioModel::select('id','estado', 'hora_inicio', 'hora_fin', 'duracion')->selectRaw("'idd3' as variable")->selectRaw('idd as valor')->where('idd','=','3')->where('idu','=',$idu);
        $dd4=DiaUsuarioModel::select('id','estado', 'hora_inicio', 'hora_fin', 'duracion')->selectRaw("'idd4' as variable")->selectRaw('idd as valor')->where('idd','=','4')->where('idu','=',$idu);
        $dd5=DiaUsuarioModel::select('id','estado', 'hora_inicio', 'hora_fin', 'duracion')->selectRaw("'idd5' as variable")->selectRaw('idd as valor')->where('idd','=','5')->where('idu','=',$idu);
        $dd6=DiaUsuarioModel::select('id','estado', 'hora_inicio', 'hora_fin', 'duracion')->selectRaw("'idd6' as variable")->selectRaw('idd as valor')->where('idd','=','6')->where('idu','=',$idu);
        $dd7=DiaUsuarioModel::select('id','estado', 'hora_inicio', 'hora_fin', 'duracion')->selectRaw("'idd7' as variable")->selectRaw('idd as valor')->where('idd','=','7')->where('idu','=',$idu);
        return $dd1->union($dd2)->union($dd3)->union($dd4)->union($dd5)->union($dd6)->union($dd7)->get();
    }
    public function getDiaUsuario($idu,$idd)
    {
        return DiaUsuarioModel::where('idu','=',$idu)->where('idd','=',$idd)->get();
    }

    public function getCitaPacienteUsuario($idusu)
    {
        return CitaModel::select('cita.fecha', 'cita.hora', 'paciente.paciente', 'cita.idpaciente', 'cita.idcita', 'usuario.idusu')->join('paciente','cita.idpaciente', '=', 'paciente.idpaciente')->join('usuario','cita.idusuario', '=', 'usuario.idusu')->where('usuario.idusu','=',$idusu)->orderBy('cita.fecha', 'asc')->get();
    }
    public function updateDiaUsuario($idu,$idd,$arr)
    {
        DiaUsuarioModel::where('idd','=',$idd)->where('idu','=',$idu)->update($arr);
    }

    public function getConfiguracion()
    {
        return DB::select("SELECT * FROM configuracion WHERE idconfi='1'");
    }
}