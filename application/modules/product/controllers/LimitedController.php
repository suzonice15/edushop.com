<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LimitedController extends MX_Controller
{

	public function __construct()
	{
		$this->load->model('ProductModel');
		$this->load->model('MainModel');
		$this->load->library('image_lib');
		$userType=$this->session->userdata('user_type');
		if($userType !='super-admin' &&  $userType !='admin'  ){
			redirect('admin');
		}


	}

	
	function pagination()
	{
		$this->load->model("ProductModel");
		$this->load->library("pagination");
		$config = array();
		$config["base_url"] = "#";
		
	$search=$this->input->post('search');
		if($search){
			$config["total_rows"] = $this->ProductModel->count_all_by_search($search);


		} else {

			$config["total_rows"] = $this->ProductModel->count_all();
		}
		$config["per_page"] = 10;
		$config["uri_segment"] = 4;
		$config["use_page_numbers"] = TRUE;
		$config["full_tag_open"] = '<ul class="pagination">';
		$config["full_tag_close"] = '</ul>';
		$config["first_tag_open"] = '<li>';
		$config["first_tag_close"] = '</li>';
		$config["last_tag_open"] = '<li>';
		$config["last_tag_close"] = '</li>';
		$config['next_link'] = '&gt;';
		$config["next_tag_open"] = '<li>';
		$config["next_tag_close"] = '</li>';
		$config["prev_link"] = "&lt;";
		$config["prev_tag_open"] = "<li>";
		$config["prev_tag_close"] = "</li>";
		$config["cur_tag_open"] = "<li class='active'><a href='#'>";
		$config["cur_tag_close"] = "</a></li>";
		$config["num_tag_open"] = "<li>";
		$config["num_tag_close"] = "</li>";
		$config["num_links"] = 3;
		$this->pagination->initialize($config);
		if($search){
			$page =1;


		} else {

			$page = $this->uri->segment(4);
		}

		$start = ($page - 1) * $config["per_page"];

		if($search){

			$output = array(
				'pagination_link'  => $this->pagination->create_links(),
				'country_table'   => $this->ProductModel->fetch_product_by_search($config["per_page"], $start,$search)
			);


		} else {

			$output = array(
				'pagination_link'  => $this->pagination->create_links(),
				'country_table'   => $this->ProductModel->fetch_products($config["per_page"], $start)
			);
		}


		echo json_encode($output);
	}
	
	public function limited()
	{

		$data['main'] = "Limited Stock Products";
		$data['active'] = "View Products";
		$data['pageContent'] = $this->load->view('product/products/products_limited', $data, true);
		$this->load->view('layouts/main', $data);



	}
	
	public function limitedAjaxProduct(){

		$data = $this->ProductModel->limitedAjaxProduct();
		echo json_encode($data);
		
	}
	public  function  stock(){

		$data['active'] = "View Products";
		$data["products"] = $this->MainModel->getAllData('', 'product', '*', 'product_id DESC');;
		$data['pageContent'] = $this->load->view('product/products/products_stock', $data, true);
		$this->load->view('layouts/main', $data);


	}




	public  function update(){
		$data = array(
			$this->input->post('table_column') => $this->input->post('value')
		);
		$this->MainModel->updateData('product_id',$this->input->post('id'),'product',$data);


	}

	public  function limitedAjaxProductSearch(){

	 	$product_id=$this->input->post('product_id');
		$data['products'] = $this->ProductModel->limitedAjaxProductSearch($product_id);
		 $this->load->view('product/products/products_limited_by_ajax_search',$data);

	}


}
