<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pengiriman_model');
	}

	public function index()
	{
		$data['title'] = "DASHBOARD";
		$data['layout'] = "dashboard";

		$data['diproses'] = $this->pengiriman_model->getJumlah(1);
		$data['dikirim'] = $this->pengiriman_model->getJumlah(2);
		$data['diterima'] = $this->pengiriman_model->getJumlah(3);


		$filter = new StdClass();
		$filter->status = 1;
		$data['data_diproses'] = $this->pengiriman_model->getAll($filter, 5, 0, 'id_pengiriman', 'desc')[0];
		$filter->status = 2;
		$data['data_dikirim'] = $this->pengiriman_model->getAll($filter, 5, 0, 'id_pengiriman', 'desc')[0];


		// echo "<pre>";
		// var_dump($data['diproses']);
		// echo "</pre>";
		// die();

		$this->load->view('template', $data); 
	}
}