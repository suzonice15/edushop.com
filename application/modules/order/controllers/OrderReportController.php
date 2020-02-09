<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class OrderReportController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('cart');
        $this->load->model('OrderModel', 'order');
        $this->load->model('MainModel');

    }
    function report()
    {

        $data['main'] = "Order Reports ";
        $data['active'] = "View Order report ";
        $data['user_type'] = "admin";
        $data['page_title'] = 'Order Report';
        $data['form_title'] = 'Update';
        $data['pageContent'] = $this->load->view('order/orders/orders_report', $data, true);
        $this->load->view('layouts/main', $data);

    }


    public function orderReport( ){

        $from= date('Y-m-d',strtotime($this->input->post('from')));
      $to= date('Y-m-d',strtotime($this->input->post('to')));
        $data['product']=$this->order->orderReport($from,$to);
        
        echo json_encode($data);

    }
    public function sellProduct(){

        $data['product'] = $this->MainModel->getAllData("status='Published'", 'product', 'product_title,product_id', 'product_id DESC');
        $data['main'] = "Single Product Reports ";
        $data['active'] = "View Product report ";
        $data['user_type'] = "admin";
        $data['page_title'] = 'Order Report';
        $data['form_title'] = 'Update';
        $data['pageContent'] = $this->load->view('order/orders/orders_sell_product', $data, true);
        $this->load->view('layouts/main', $data);


    }
    public function sellProductReport(){

        $product_id= $this->input->post('product_id');       
        $data['product']=$this->order->sellProductReport($product_id);

        echo json_encode($data);


    }

    public function sellProductReportByDate(){

        $product_id= $this->input->post('product_id');
        $from= date('Y-m-d',strtotime($this->input->post('from')));
        $to= date('Y-m-d',strtotime($this->input->post('to')));

        $data['product']=$this->order->sellProductReportByDate($product_id,$from,$to);

        echo json_encode($data);


    }


}



