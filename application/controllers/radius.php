<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Radius extends Admin_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model("radius_model");
		$this->cekLoginStatus("admin",true);
    }
	public function index()
	{
		$data['title'] = "DATA RADIUS";
		$data['layout'] = "radius/index";
			
		$filter = new StdClass();
		$filter->keyword = trim($this->input->get('keyword'));
		
		$orderBy = $this->input->get('orderBy');
		$orderType = $this->input->get('orderType');
		$page = $this->input->get('page');
		
		$limit = 15;
		if(!$page)
			$page = 1;
		
		$offset = ($page-1) * $limit;
		
		list($data['data'],$total) = $this->radius_model->getAll($filter,$limit,$offset,$orderBy,$orderType);
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("radius?");
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		$config['query_string_segment'] = 'page';
		$config['use_page_numbers']  = TRUE;
		$config['page_query_string'] = TRUE;
		
		$this->pagination->initialize($config);
		$this->load->view('template',$data);
	}
	
	public function manage($id = "")
	{
		$data['title'] = "FORM radius";
		$data['layout'] = "radius/manage";

		$data['data'] = new StdClass();
		$data['data']->id_radius = "";
		$data['data']->radius = "";
		$data['data']->autocode = $this->generate_code();
		
		if($id)
		{
			$dt =  $this->radius_model->get_by("id_radius",$id,true);
			if(!empty($dt))
				$data['data'] = $dt;
		}
		
		$this->load->view('template',$data);
	}
	
	public function save()
	{
		$data = array();
		$post = $this->input->post();
		
		if($post)
		{
			$error = array();
			$id = $post['id'];
			
			if(!empty($post['id_radius']))
				$data['id_radius'] = $post['id_radius'];
			else
				$error[] = "id tidak boleh kosong"; 
				
			if(!empty($post['radius']))
				$data['radius'] = $post['radius'];
			else
				$error[] = "nama tidak boleh kosong"; 
			
		
			if(empty($error))
			{
				if(empty($id))
				{
					$cekradius = $this->radius_model->get_by("id_radius",$post['id_radius']);
					if(!empty($cekradius))
						$error[] = "id sudah terdaftar"; 
					
					$cek = $this->radius_model->get_by("radius",$post['radius']);
					if(!empty($cek))
						$error[] = "radius sudah terdaftar"; 
				}
				else
				{
					$cek = $this->radius_model->cekName($id,$post['radius']);
					if(!empty($cek))
						$error[] = "radius sudah terdaftar";
				}	
			}
			
			if(empty($error))
			{
				$save = $this->radius_model->save($id,$data,false);
				$this->session->set_flashdata('admin_save_success', "data berhasil disimpan");
				
				if($post['action'] == "save")
					redirect("radius/manage/".$id);
				else
					redirect("radius");
			}
			else
			{
				$err_string = "<ul>";
				foreach($error as $err)
					$err_string .= "<li>".$err."</li>";
				$err_string .= "</ul>";
				
				$this->session->set_flashdata('admin_save_error', $err_string);
				redirect("radius/manage/".$id);
			}
		}
		else
		  redirect("radius");
	}
	
	public function delete($id = "")
	{
		if(!empty($id))
		{
			$cek = $this->radius_model->get_by("id_radius",$id,true);
			if(empty($cek))
			{
				$this->session->set_flashdata('admin_save_error', "ID tidak terdaftar");
				redirect("radius");
			}
			else
			{
				$cek = $this->radius_model->cekAvalaible($id);
				if(!empty($cek))
				{
					$this->session->set_flashdata('admin_save_error', "data sedang digunakan");
					redirect("radius");
				}
				else
				{
					$this->radius_model->remove($id);
					
					$this->session->set_flashdata('admin_save_success', "data berhasil dihapus");
					redirect("radius");
				}
			}
		}
		else
			redirect("radius");
	}
	
	public function generate_code()
	{
		$prefix = "RDS";
		$code = "01";
		
		$last = $this->radius_model->get_last();
		if(!empty($last))
		{
			$number = substr($last->id_radius,3,2) +1;
			$code = str_pad($number, 2, "0", STR_PAD_LEFT);
		}
		return $prefix.$code;
	}
	
}
