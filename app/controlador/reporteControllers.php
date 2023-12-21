<?php 
namespace App\Controllers;
use App\Controller;
use Dompdf\Dompdf;
/**
 * 
 */
class reporteControllers extends Controller
{
	
	function __construct()
	{
		
		$this->renderTemplate("reporte");
	}
	public function index($value='')
	{
		if($_SESSION['tipo']=='administrador'){

			/*$this->loadDAO('reporte');
			$p = $this->dao->listaVentas();
			$m = $this->dao->ventasPagos();
			$s = $this->dao->ventasNoPagos();
			$this->templates->addData(['m'=>$m,'s'=>$s,'p'=>$p]);
			*/
		}
		print $this->templates->render('index');
	}
	public function reporteRangoFechas($value='')
	{
		$this->loadDAO('venta');
		$desde = $_GET['desde'];
		$hasta =$_GET['hasta'];

		$verDesde = date('d/m/Y', strtotime($desde));
		$verHasta = date('d/m/Y', strtotime($hasta));
		$dompdf = new Dompdf();
		$this->templates->addData(['verDesde'=>$verDesde,'verHasta'=>$verHasta,'result'=>$this->dao->listaVentasByDates($desde,$hasta),'detalleventa'=>$this->dao->getDetalleVenta()->toArray()]);

		$dompdf->loadHtml($this->templates->render('reporteRangoFechas'));

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'portrait');

		// Render the HTML as PDF
		$dompdf->render();
		$pdf=$dompdf->output();
		// Output the generated PDF to Browser
		$dompdf->stream($pdf,array("Attachment"=>0));
	}

	public function ticketCita($value='')
	{
		print $this->templates->render('ticketCita');
	}

	public function error()
	{
		header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
		print $this->templates->render('404');
	}
}