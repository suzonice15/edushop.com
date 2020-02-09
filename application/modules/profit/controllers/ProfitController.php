<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfitController extends MX_Controller {

	public function __construct()
	{
		$this->load->model('MainModel');

		$userType=$this->session->userdata('user_type');
		if($userType !='super-admin' && $userType !='admin' && $userType !='office-staff'){
			redirect('admin');
		}

	}

	public function index()
	{



		$data['main'] = "Profit and los";
		$data['active'] = "Profit and los view" ;
		if($this->input->post()){
			$date_from=date('Y-m-d',strtotime($this->input->post('date_from')));
			$date_to=date('Y-m-d',strtotime($this->input->post('date_to')));
			$data['date_from']=$this->input->post('date_from');
			$data['date_to']=$this->input->post('date_to');
			$query="SELECT order_report.* , product.product_id,product.product_title,product.purchase_price,product.product_name FROM `order_report` join product on order_report.product_id=product.product_id 
WHERE order_report.modified_time >= '$date_from' and order_report.modified_time <= '$date_to'";
			$data['results']=get_result($query);

		}
		$data['pageContent'] = $this->load->view('profit/profit/profit_index', $data, true);
		$this->load->view('layouts/main', $data);
	}


	


}
