<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SubscribeController extends MX_Controller {

	public function __construct()
	{
		$this->load->model('MainModel');

		$userType=$this->session->userdata('user_type');
		if($userType !='super-admin' &&  $userType !='admin'){
			redirect('admin');
		}
	}

	public function index()
	{

		$data['main'] = "Subscribe ";
		$data['active'] = "Subscribe" ;
		$data['newsletters'] = $this->MainModel->getAllData('', 'newsletter', '*', 'newsletter_id DESC');
		$data['pageContent'] = $this->load->view('subscribe/subscribe_index', $data, true);
		$this->load->view('layouts/main', $data);
	}

	public function status($id)
	{


		$data['status']=1;
		$this->session->set_flashdata('message', 'Update successfully');

		$this->MainModel->updateData('newsletter_id',$id,'newsletter', $data);
		$this->index();


	}


	public function store()
	{
		

	}


	public function query_form()
	{
		
	}

	public function edit($id)
	{

		

	}

	public function update()
	{

		

	}




	public function destroy($id)
	{
	}
		
	
}
