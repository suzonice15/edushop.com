<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class OrderController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('cart');
        $this->load->model('OrderModel', 'order');
        $this->load->model('MainModel');

        $this->load->library('Ajax_pagination');
        $this->perPage = 5;
        $userType=$this->session->userdata('user_type');

        if($userType !='super-admin' && $userType !='admin' && $userType !='office-staff'){
            redirect('admin');
        }
    }

    public function index()
    {


        $data['main'] = "Orders ";
        $data['active'] = "View Order ";
      $query="SELECT * FROM `order_data` where order_status ='new'  ORDER BY `order_id`  desc";
        $data['orders'] =  $this->MainModel->AllQueryDalta($query);
        $data['pageContent'] = $this->load->view('order/orders/orders_index', $data, true);
        $this->load->view('layouts/main', $data);


    }

    public function all_payment_request()
    {
        $data['payment_request'] = $this->MainModel->select_all_request_for_admin();
        $data['pageContent'] = $this->load->view('order/orders/all_payment_request', $data, true);
        $this->load->view('layouts/main', $data);
    }

    public function approved_payment($id)
    {
        $data = array(
            'status' => 0
        );
        $result = $this->MainModel->update_payment($data, $id);
        if ($result) {
            echo "Payment approved successfully.";
        }
    }




    function create()
    {
        date_default_timezone_set("Asia/Dhaka");

        $data['main'] = "Orders ";
        $total_cost=0;

        $data['active'] = "Add Order ";
        $data['title'] = " Order  registration form";
        $productQuery = "select product.product_id,product.product_title,sku from product 
";
        $data['orders'] = $this->MainModel->AllQueryDalta($productQuery);
        $data['user_id'] = 2;
        $districts_query = "SELECT id,name FROM `districts` order by id ASC ";
        $data['districts'] = $this->MainModel->AllQueryDalta($districts_query);

        $data['couriers'] = $this->MainModel->getAllData("courier_status=1", 'courier', '*', 'courier_id desc');
        if ($this->input->post()) {
            $shipping_charge = $this->input->post('shipping_charge');

            $total_cost =$this->input->post('order_total')+$shipping_charge ;
            $row_data['order_total'] = $total_cost;
            $row_data['created_by'] =$this->session->userdata('user_name');

            $row_data['products'] = serialize($this->input->post('products'));
            $row_data['payment_type'] = $this->input->post('payment_type');
            $row_data['shipping_charge'] = $this->input->post('shipping_charge');
            $row_data['customer_name'] = $this->input->post('customer_name');
            $row_data['customer_phone'] = $this->input->post('customer_phone');
            $row_data['customer_email'] = $this->input->post('customer_email');
            $row_data['customer_address'] = $this->input->post('customer_address');
            $row_data['delevery_address'] = $this->input->post('delevery_address');
            $row_data['shipment_time'] = date("Y-m-d H:i:s");
            $row_data['created_time'] = date("Y-m-d H:i:s");
            $row_data['modified_time'] = date("Y-m-d");
            $row_data['order_area'] = $this->input->post('order_area');
            $row_data['thana'] = $this->input->post('thana');
 

            $customer_name = $row_data['customer_name'];
            $customer_email = $row_data['customer_email'];
            $site_title = get_option('site_title');
            $site_email = get_option('email');
            $row_data['staff_id'] = $this->input->post('staff_id');

            $row_data['order_status'] = 'new';//$this->input->post('order_status');
            $this->form_validation->set_rules('customer_name', 'name', 'trim|required');
            $this->form_validation->set_rules('customer_phone', 'phone', 'trim|required');

            if ($this->form_validation->run() == FALSE) {

                $this->session->set_flashdata('error', 'Fill Up all the Required field    !');
                redirect('order-create');
            } else {
                $order_id = $this->MainModel->returnInsertId('order_data', $row_data);
                if ($order_id) {

                    // send order confirmation email to customer
                    $site_title = get_option('site_title');
                    $site_email = get_option('email');

                    $config['protocol'] = 'sendmail';
                    $config['charset'] = 'utf-8';
                    $config['wordwrap'] = TRUE;
                    $config['mailtype'] = 'html';
                    $this->email->initialize($config);

                    $this->email->from($site_email, $site_title);
                    $this->email->to($customer_email);
                    $this->email->subject('Order Confirmation');

                    $order_status = 'new';

                    ob_start();
                    include('applications/views/emails/email-header.php');
                    include('applications/views/emails/new-order.php');
                    include('applications/views/emails/email-footer.php');
                    $email_body = ob_get_clean();

                    //echo $email_body;
                    $this->email->message($email_body);
                    $this->email->send();

                    $this->session->set_flashdata('message', "Order created successfully-- Order Number :$order_id");
                    redirect('order-create');
                } else {
                    $this->session->set_flashdata('error', 'Order does not completed try again');
                    redirect('order-create');
                }
            }
        } else {
            $data['pageContent'] = $this->load->view('order/orders/orders_create', $data, true);
            $this->load->view('layouts/main', $data);
        }

    }

    public function tryorder()
    {
        $data['main'] = " Try Orders ";
        $data['active'] = "try Order ";
        $data['title'] = "";
        $data['pageContent'] = $this->load->view('order/orders/order_try', $data, true);
        $this->load->view('layouts/main', $data);


    }

    public function try_view($order_id)
    {

        $data['order'] = $this->MainModel->getSingleData('order_id', $order_id, 'order_data', '*');
        $data['try_order'] = $this->MainModel->try_view($order_id);
        $data['pageContent'] = $this->load->view('order/orders/order_try_view', $data, true);
        $this->load->view('layouts/main', $data);


    }

    public function update()
    {

        $order_data=array();
        $product_data=array();
        $order_number = $this->input->post('row_id');
        $data['order_status'] = $this->input->post('order_status');

        $order_status = $this->input->post('order_status');
        $shipping_charge = $this->input->post('shipping_charge');
        $shipping_charge_in_ajax = $this->input->post('shipping_charge_in_ajax');
        $data['modified_time'] = date("Y-m-d H:i:s");
        if($shipping_charge_in_ajax>0) {
            $data['order_total'] = $this->input->post('order_total') + $shipping_charge;
        } else {

            $data['order_total'] = $this->input->post('order_total') ;
        }
        $data['products'] = serialize($this->input->post('products'));
       // $data['order_area'] = $this->input->post('order_area');
       // $data['thana'] = $this->input->post('thana');
        $data['customer_name'] = $this->input->post('customer_name');
        $data['customer_phone'] = $this->input->post('customer_phone');
        $data['customer_email'] = $this->input->post('customer_email');
        $data['customer_address'] = $this->input->post('customer_address');
        $data['delevery_address'] = $this->input->post('delevery_address');
        $data['shipping_charge'] = $this->input->post('shipping_charge');
        $data['discount'] = $this->input->post('discount');
        $data['order_note'] = $this->input->post('order_note');

        $data['shipment_time'] = date("Y-m-d H:i:s", strtotime($this->input->post('shipment_time')));


        if ($order_status == 'completed') {
          $order_status= $this->MainModel->getSingleData('order_id',$order_number,'order_data','order_status');
            $order_status=$order_status->order_status;
           $product_id=$this->input->post('product_id');
           $product_price=$this->input->post('product_price');
           $quantity=$this->input->post('quantity');

            if($order_status !='completed') {
                for($i=0;$i<count($product_id);$i++){

                   $product_stock_data= $this->MainModel->getSingleData('product_id',$product_id[$i],'product','product_stock');
                    if($product_stock_data) {
                        $product_stock = $product_stock_data->product_stock;
                        //echo $product_stock;exit();
                        $productQuantiy=$product_stock-$quantity[$i];
                        if($productQuantiy) {
                            $product_data['product_stock'] = $productQuantiy;
                            $this->MainModel->updateData('product_id', $product_id[$i], 'product', $product_data);
                        }
                        $product_stock_data= $this->MainModel->getSingleData('product_id',$product_id[$i],'product','product_stock');

                        $product_stock = $product_stock_data->product_stock;
                    

                        $order_data['product_id'] = $product_id[$i];
                        $order_data['order_id'] = $order_number;
                        $order_data['product_price'] = $product_price[$i];
                        $order_data['quantity'] =$quantity[$i];
                        $order_data['quantity'] = $quantity[$i];
                        $order_data['modified_time'] = date("Y-m-d H:i:s");
                        $this->MainModel->insertData('order_report',$order_data);
                    }



                }




            }


        }

        $customer_name = $data['customer_name'];
        $customer_email = $data['customer_email'];
        $site_title = get_option('site_title');
        $site_email = get_option('email');
        $config['protocol'] = 'sendmail';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from($site_email, $site_title);
        $this->email->to($customer_email);
        $this->email->subject('Order Status');

        if ($order_status == 'cancled') {
            ob_start();
            include('applications/views/emails/email-header.php');
            include('applications/views/emails/cancle-order.php');
            include('applications/views/emails/email-footer.php');
            $email_body = ob_get_clean();
        } elseif ($order_status == 'completed') {
            ob_start();
            include('applications/views/emails/email-header.php');
            include('applications/views/emails/complete-order.php');
            include('applications/views/emails/email-footer.php');
            $email_body = ob_get_clean();
        } else {
            ob_start();
            include('applications/views/emails/email-header.php');
            include('applications/views/emails/order-content.php');
            include('applications/views/emails/email-footer.php');
            $email_body = ob_get_clean();
        }
        $order_data = $this->MainModel->updateData('order_id', $order_number, 'order_data', $data);


        if ($order_data) {
            $this->session->set_flashdata('message', 'Order updated successfully !!!');
            redirect('order-list', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Failed to Update the data !!!');
            $this->edit($order_number);
        }


    }


    public function order_view($order_id)
    {
        $data['main'] = "Orders ";
        $data['active'] = "View Single Order ";
        $data['order'] = $this->MainModel->getSingleData('order_id', $order_id, 'order_data', '*');
        $data['pageContent'] = $this->load->view('order/orders/orders_view', $data, true);
        $this->load->view('layouts/main', $data);

    }

    public function OptionName($option_name)
    {
        $curiar = $this->MainModel->getSingleData('option_name', $option_name, 'options', 'option_value');
        $data = unserialize($curiar);
        var_dump($data);


    }




    






    public function productSelection()
    {
        $item_count=0;
        $product_ids = explode(",", $this->input->post('product_id'));
        $qty = $this->input->post('product_quantity');
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where_in('product_id', $product_ids);
        $query = $this->db->get();
        $products = $query->result();
        $html = 'No Products Info. Found!';
        if (count($products) > 0) {
            $html = '<table class="table table-striped table-bordered">
				<tr>
					<th class="name" width="30%">Product</th>
                                            <th class="name" width="5%">Code</th>
                                            <th class="image text-center" width="5%">Image</th>
                                            <th hidden class="image text-center" width="10%">Size</th>
                                            <th  hidden class="image text-center" width="15%">Color</th>
                                            <th class="quantity text-center" width="10%">Qty</th>
                                            <th class="price text-center" width="10%">Price</th>
                                            <th class="total text-right" width="10%">Sub-Total</th>
				</tr>';
            foreach ($products as $prod) {

                $sell_price = floatval($prod->product_price);
                $this->db->select('product_of_size');
                $this->db->where('product_id', $prod->product_id);
                $productSize = $this->db->get('product')->result();
                foreach ($productSize as $product) {
                    $proSizeList = $product->product_of_size;
                }
                $productSize_OF = explode(',', $proSizeList);
                $this->db->select('product_color');
                $this->db->where('product_id', $prod->product_id);
                $productColor = $this->db->get('product')->result();
                foreach ($productColor as $product_co) {
                    $proColorlist = $product_co->product_color;
                }
                $productColor = explode(',', $proColorlist);
                if($prod->discount_price){
                    $sell_price = floatval($prod->discount_price);
                    $sell_price=$sell_price;

                } else {
                    $sell_price = floatval($prod->product_price);
                    $sell_price=$sell_price;



                }
                $subtotal = ($sell_price * $qty);
                $totalamout[] = $subtotal;
                $featured_image = get_product_thumb($prod->product_id, 'thumb');
                $html .= '<tr>
						<td>' . $prod->product_title . '</td>
						<td>'.$prod->sku.'</td>
						<td class="image text-center">
							<img src="' . $featured_image . '" height="30" width="30">
						</td>
						
								<td hidden>
								<select name="products[items][' . $prod->product_id . '][Size]"  id="productSize" class="form-control item_Size" >';
                foreach ($productSize_OF as $key => $product_size_id_of):
                    $html .= '<option value="' . $product_size_id_of . '">' . $product_size_id_of . '</option>';
                endforeach;
                $html .= '</select> 	</td>';
                $html .= '<td hidden>
								<select name="products[items][' . $prod->product_id . '][Color]"  id="productSize" class="form-control item_color" >';
                foreach ($productColor as $key => $productCol):
                    $html .= '<option value="' . $productCol . '">' . $productCol . '</option>';
                endforeach;
                $html .= '</select></td>
						<td class="text-center">
							<input type="number" name="products[items][' . $prod->product_id . '][qty]" class="form-control item_qty" value="' . $qty . '" data-item-id="' . $prod->product_id . '" style="width:60px;">
						</td>
						<td class="text-center">৳ ' . $sell_price . '.00</td>
						<td class="text-right">৳ ' . $subtotal . '.00</td>
					</tr>';
                $html .= form_hidden('products[items][' . $prod->product_id . '][featured_image]', $featured_image);
                $html .= form_hidden('products[items][' . $prod->product_id . '][price]', $sell_price);
                $html .= form_hidden('products[items][' . $prod->product_id . '][name]', $prod->product_title);
                $html .= form_hidden('products[items][' . $prod->product_id . '][subtotal]', $subtotal);
                $html .='<input type="hidden" class="shipping_charge_in_dhaka"
                                                       value="'.get_product_delevery_price_in_dhaka($prod->product_id).'"> 
                                                       <input type="hidden" class="shipping_charge_out_of_dhaka"
                                                       value="'.get_product_delevery_price_out_dhaka($prod->product_id).'">
                                                         <input type="hidden" id="quantity_list" value="'.$item_count.'">';
            }
            $html .= '</table>';
            $html .= '<a class="btn btn-primary pull-right update_items">Change</a><br><br><br>';
            $order_total = array_sum($totalamout);
            $delivery_cost = 0;//get_option('shipping_charge_in_dhaka');
            $delivery_cost_Out_Side_Dhaka = 0;//get_option('shipping_charge_out_of_dhaka');
            $order_total = $order_total + $delivery_cost;
            $html .= '<table class="table table-striped table-bordered">
				<tbody>
					<tr>
						<td>
							<span class="extra bold">Sub-Total</span>
						</td>
						<td class="text-right">
							<span class="bold">৳ 
								<span id="subtotal_cost">
									' . array_sum($totalamout) . '.00
								</span>
							</span>
						</td>
					</tr>
					<tr>
						<td>
							<span class="extra bold">Delivery Cost</span>
						</td>
						<td  class="text-right">
							<span class="bold"><span id="delivery_cost"><input type="text" id="shipping_charge_suzon" name="shipping_charge" class="form-control"></span></span>
							
						
						</td>
					</tr>
					<tr>
						<td>
							<span class="extra bold totalamout">Total</span>
						</td>
						<td class="text-right">
							<span class="bold totalamout">৳ <span id="total_cost">' . $order_total . '.00</span></span>
							' . form_hidden('order_total', $order_total) . '
							' . form_hidden('checkout_type', 'cash_on_delivery') . '
						</td>
					</tr>';
            $html .= '</tbody>
			</table>';
        }
        echo json_encode(array("html" => $html));
        die();
    }




    function productSelectionChange()
    {
        $total_quntity=0;
        $subtotall=0;
        $product_ids = explode(",", $this->input->get_post('product_ids'));
        $product_qtys = explode(",", $this->input->get_post('product_qtys'));
        $shipping_charge =  $this->input->get_post('shipping_charge');
        $size = $this->input->get_post('size');
        $pqty = array_combine($product_ids, $product_qtys);

        $this->db->select('*');
        $this->db->from('product');
        $this->db->where_in('product_id', $product_ids);
        $query = $this->db->get();
        $products = $query->result();
        $html = 'No Products Info. Found!';
        if (count($products) > 0) {
            $html = '<table class="table table-striped table-bordered">
				<tr>
					 <th class="name" width="30%">Product</th>
                                            <th class="name" width="5%">Code</th>
                                            <th class="image text-center" width="5%">Image</th>
                                            <th hidden class="image text-center" width="10%">Size</th>
                                            <th hidden class="image text-center" width="15%">Color</th>
                                            <th class="quantity text-center" width="10%">Qty</th>
                                            <th class="price text-center" width="10%">Price</th>
                                            <th class="total text-right" width="10%">Sub-Total</th>
				</tr>';
            foreach ($products as $prod) {
                $qty = $pqty[$prod->product_id];
                $total_quntity=$qty+$pqty[$prod->product_id];;
                $this->db->select('product_of_size');
                $this->db->where('product_id', $prod->product_id);
                $productSize = $this->db->get('product')->result();
                foreach ($productSize as $product) {
                    $proSizeList = $product->product_of_size;
                }
                $productSize_OF = explode(',', $proSizeList);
                $this->db->select('product_color');
                $this->db->where('product_id', $prod->product_id);
                $productColor = $this->db->get('product')->result();
                foreach ($productColor as $product_co) {
                    $proColorlist = $product_co->product_color;
                }
                $productColor = explode(',', $proColorlist);
                if($prod->discount_price){
                    $sell_price = floatval($prod->discount_price);
                    $sell_price=$sell_price.'.00';

                } else {
                    $sell_price = floatval($prod->product_price);
                    $sell_price=$sell_price.'.00';



                }

             

                $subtotal = ($sell_price * $qty);
                $subtotall = $subtotal.'.00';
                $totalamout[] = $subtotal;
               // $totalamout[] = $totalamout[].'.00';
                $product_link = base_url() . 'product/' . $prod->product_name;
                $featured_image = get_product_thumb($prod->product_id, 'thumb');

                $html .= '<tr>
						<td><a href="'.$product_link.'">' . $prod->product_title . '</a></td>
						<td>'.$prod->sku.'</td>
						<td class="image text-center">
							<img src="' . $featured_image . '" height="30" width="30">
						</td>
							<td hidden>
								<select name="products[items][' . $prod->product_id . '][Size]"  id="productSize" class="form-control item_Size" >';
                foreach ($productSize_OF as $key => $product_size_id_of):
                    $html .= '<option value="' . $product_size_id_of . '">' . $product_size_id_of . '</option>';
                endforeach;
                $html .= '</select></td>';
                $html .= '<td hidden >
								<select name="products[items][' . $prod->product_id . '][Color]"  id="productSize" class="form-control item_color" >';
                foreach ($productColor as $key => $productCol):
                    $html .= '<option value="' . $productCol . '">' . $productCol . '</option>';
                endforeach;
                $html .= '</select></td>
						<td class="text-center">
							<input type="number" name="products[items][' . $prod->product_id . '][qty]" class="form-control item_qty" value="' . $qty . '" data-item-id="' . $prod->product_id . '" style="width:60px;">
						</td>
						<td class="text-center">৳ ' . $sell_price .'</td>
						<td class="text-right">৳ ' . $subtotall . '</td>
					</tr>';
                $html .= form_hidden('products[items][' . $prod->product_id . '][featured_image]', $featured_image);
                //$html.=form_hidden('products[items]['.$prod->product_id.'][qty]', $qty);
                $html .= form_hidden('products[items][' . $prod->product_id . '][price]', $sell_price);
                $html .= form_hidden('products[items][' . $prod->product_id . '][name]', $prod->product_title);
                $html .= form_hidden('products[items][' . $prod->product_id . '][subtotal]', $subtotall);
            }
            $html .= '</table>';
            $html .= '<a class="btn btn-primary pull-right update_items">Change</a><br><br><br>';
            $order_total = array_sum($totalamout);
            $delivery_cost = $shipping_charge;//get_option('shipping_charge_in_dhaka');
            $delivery_cost_Out_Side_Dhaka = 0;// get_option('shipping_charge_out_of_dhaka');
            $order_total = $order_total + $delivery_cost;
            $order_total =$order_total.'.00' ;
            $html .= '<table class="table table-striped table-bordered">
				<tbody>
					<tr>
						<td>
							<span class="extra bold">Sub-Total</span>
						</td>
						<td class="text-right">
							<span class="bold">৳ 
								<span id="subtotal_cost">
									' . array_sum($totalamout) . '.00
								</span>
							</span>
						</td>
					</tr>
					<tr>
						<td >
							<span class="extra bold">Delivery Cost</span>
						</td>
						<td class="text-right">
							<span  class="bold"><span id="delivery_cost"><input type="text"  id="shipping_charge_suzon" name="shipping_charge" class="form-control">
							<input type="hidden"  id="shipping_charge_suzon" name="shipping_charge_in_ajax" value="10" class="form-control">
							</span></span>
						
						
						</td>
					</tr>
					<tr>
						<td>
							<span class="extra bold totalamout">Total</span>
						</td>
						<td class="text-right">
							<span class="bold totalamout">৳ <span id="total_cost">' . $order_total . '</span></span>
							' . form_hidden('order_total', $order_total) . '
							' . form_hidden('checkout_type', 'cash_on_delivery') . '
						</td>
					</tr>
				</tbody>
			</table>';
        }
        echo json_encode(array("html" => $html));
        die();
    }


    function productSelectionUpdate()
    {
        $product_ids = explode(",", $this->input->get_post('product_ids'));
        $product_qtys = explode(",", $this->input->get_post('product_qtys'));
        $shipping_charge =  $this->input->get_post('shipping_charge');
        $size = $this->input->get_post('size');
        $pqty = array_combine($product_ids, $product_qtys);

        $this->db->select('*');
        $this->db->from('product');
        $this->db->where_in('product_id', $product_ids);
        $query = $this->db->get();
        $products = $query->result();
        $html = 'No Products Info. Found!';
        if (count($products) > 0) {
            $html = '<table class="table table-striped table-bordered">
				<tr>
					 <th class="name" width="30%">Product</th>
                                            <th class="name" width="5%">Code</th>
                                            <th class="image text-center" width="5%">Image</th>
                                            <th class="image text-center" width="10%">Size</th>
                                            <th class="image text-center" width="15%">Color</th>
                                            <th class="quantity text-center" width="10%">Qty</th>
                                            <th class="price text-center" width="10%">Price</th>
                                            <th class="total text-right" width="10%">Sub-Total</th>
				</tr>';
            foreach ($products as $prod) {
                $qty = $pqty[$prod->product_id];
                $this->db->select('product_of_size');
                $this->db->where('product_id', $prod->product_id);
                $productSize = $this->db->get('product')->result();
                foreach ($productSize as $product) {
                    $proSizeList = $product->product_of_size;
                }
                $productSize_OF = explode(',', $proSizeList);
                $this->db->select('product_color');
                $this->db->where('product_id', $prod->product_id);
                $productColor = $this->db->get('product')->result();
                foreach ($productColor as $product_co) {
                    $proColorlist = $product_co->product_color;
                }
                $productColor = explode(',', $proColorlist);
                if($prod->discount_price){
                    $sell_price = floatval($prod->discount_price);

                } else {
                    $sell_price = floatval($prod->product_price);


                }

                $subtotal = ($sell_price * $qty);
                $totalamout[] = $subtotal;
                $product_link = base_url() . 'product/' . $prod->product_name;

                $featured_image = get_product_thumb($prod->product_id, 'thumb');


                $html .= '<tr>
						<td><a href="'.$product_link.'">' . $prod->product_title . '</a></td>
						<td>'.$prod->sku.'</td>
						<td class="image text-center">
							<img src="' . $featured_image . '" height="30" width="30">
						</td>
							<td>
								<select name="products[items][' . $prod->product_id . '][Size]"  id="productSize" class="form-control item_Size" >';
                foreach ($productSize_OF as $key => $product_size_id_of):
                    $html .= '<option value="' . $product_size_id_of . '">' . $product_size_id_of . '</option>';
                endforeach;
                $html .= '</select></td>';
                $html .= '<td>
								<select name="products[items][' . $prod->product_id . '][Color]"  id="productSize" class="form-control item_color" >';
                foreach ($productColor as $key => $productCol):
                    $html .= '<option value="' . $productCol . '">' . $productCol . '</option>';
                endforeach;
                $html .= '</select></td>
						<td class="text-center">
							<input type="number" name="products[items][' . $prod->product_id . '][qty]" class="form-control item_qty" value="' . $qty . '" data-item-id="' . $prod->product_id . '" style="width:60px;">
						</td>
						<td class="text-center">৳ ' . $sell_price . '</td>
						<td class="text-right">৳ ' . $subtotal . '</td>
					</tr>';
                $html .= form_hidden('products[items][' . $prod->product_id . '][featured_image]', $featured_image);
                //$html.=form_hidden('products[items]['.$prod->product_id.'][qty]', $qty);
                $html .= form_hidden('products[items][' . $prod->product_id . '][price]', $sell_price);
                $html .= form_hidden('products[items][' . $prod->product_id . '][name]', $prod->product_title);
                $html .= form_hidden('products[items][' . $prod->product_id . '][subtotal]', $subtotal);
            }
            $html .= '</table>';
            $html .= '<a class="btn btn-primary pull-right update_items">Change</a><br><br><br>';
            $order_total = array_sum($totalamout);
            $delivery_cost = $shipping_charge;//get_option('shipping_charge_in_dhaka');
            $delivery_cost_Out_Side_Dhaka = 0;// get_option('shipping_charge_out_of_dhaka');
            $order_total = $order_total + $delivery_cost;
            $html .= '<table class="table table-striped table-bordered">
				<tbody>
					<tr>
						<td>
							<span class="extra bold">Sub-Total</span>
						</td>
						<td class="text-right">
							<span class="bold">৳ 
								<span id="subtotal_cost">
									' . array_sum($totalamout) . '
								</span>
							</span>
						</td>
					</tr>
					<tr>
						<td >
							<span class="extra bold">Delivery Cost </span>
						</td>
						<td class="text-right">
							<span  class="bold"> <input type="text" name="shipping_charge" class="form-control"></span>
							
							' . form_hidden('shipping_charge_Out', $delivery_cost_Out_Side_Dhaka) . '
						</td>
					</tr>
					<tr>
						<td>
							<span class="extra bold totalamout">Total</span>
						</td>
						<td class="text-right">
							<span class="bold totalamout">৳ <span id="total_cost">' . $order_total . '</span></span>
							' . form_hidden('order_total', $order_total) . '
							' . form_hidden('checkout_type', 'cash_on_delivery') . '
						</td>
					</tr>
				</tbody>
			</table>';
        }
        echo json_encode(array("html" => $html));
        die();
    }

    public function CourierSelection()
    {
        $courier_id = $this->input->post('courier_id');
        $data['couriers'] = $this->MainModel->getAllData("courier_status=$courier_id", 'courier', '*', 'courier_id desc');
        $html = '<select name="courier_service" id="courier_service" class="form-control">';
        foreach ($data['couriers'] as $courier):
            $html .= '<option value="' . $courier->courier_name . '">' . $courier->courier_name . '</option>';
        endforeach;
        $html .= '<select>';
        echo $html;

    }

    public function delete($orderId)
    {

        if (isset($orderId)) {
            $result = $this->MainModel->deleteData('order_id', $orderId, 'order_data');
            if ($result) {

                $this->session->set_flashdata('message', ' Order deleted    successfully!');
                redirect('order-list');

            } else {
                $this->session->set_flashdata('error', ' Order Does not deleted    successfully!');
                redirect('order-list');


            }
        }

    }

    public function totalOrderReport()
    {

        
        $data['option'] = $this->input->post('order_status');
        $customer_phone= $this->input->post('customer_phone');
        $data['customer_phone']= $this->input->post('customer_phone');
        $option = $this->input->post('order_status');
        $data['order_by'] = $this->input->post('order_by');
        $optionBy = $data['order_by'];
        $data['date_to'] = date('Y-m-d', strtotime($this->input->post('date_to')));
        $date_to = date('Y-m-d', strtotime($this->input->post('date_to')));
        $data['date_from'] = date('Y-m-d', strtotime($this->input->post('date_from')));
        $date_from = date('Y-m-d', strtotime($this->input->post('date_from')));

if($customer_phone){
    $query = "SELECT * FROM `order_data` WHERE
`customer_phone` =$customer_phone order by `order_id` DESC ";
}
    elseif   ($option==1) {
            $query = "SELECT * FROM `order_data`  order by `order_id` DESC ";
        } elseif(empty($option)) {
            $query = "SELECT * FROM `order_data`  
WHERE   order_status !='try' and try_status=0 and `modified_time` >= '$date_from' and  `modified_time` <= '$date_to'
order by `order_id` DESC";

        } else {
            $query = "SELECT * FROM `order_data`  
WHERE  order_status !='try' and try_status=0 and  `order_status`='$option' and `modified_time` >= '$date_from' and  `modified_time` <= '$date_to'
order by `order_id` DESC";
        }

        $data['orders'] = $this->MainModel->AllQueryDalta($query);
//        echo '<pre>';
//        print_r($data['orders']);
//        exit();


        $data['main'] = "Orders ";
        $data['active'] = "View Order ";

        $data['pageContent'] = $this->load->view('order/orders/orders_index', $data, true);
        $this->load->view('layouts/main', $data);


    }


    public function multipleDelete()
    {
        $order = $this->input->post('order_id');
        for ($i = 0; $i < sizeof($order); $i++) {
            $result = $this->MainModel->deleteData('order_id', $order[$i], 'order');
        }

        if ($result) {

            echo('Multiple order deleted succefully');
        } else {
            echo('Multiple order does not  deleted succefully');

        }

    }


    public function orderToday()
    {

        $data = array();    //get the posts data
        $data['orders'] = $this->order->orderRows(array('limit' => $this->perPage));
        $totalRec = count($this->order->orderRows());
        //pagination configuration
        $config['target'] = '#data_list';
        $config['base_url'] = base_url() . 'order/OrderController/ajax_pagination_data';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $config['link_func'] = 'searchFilter';
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        //$data['products']		= $this->prod->get_products(array('limit'=>$this->perPage));
        $data['orders'] = $this->order->orderRows(array('limit' => $this->perPage));


        $data['pageContent'] = $this->load->view('order/orders/orders_today', $data, true);
        $this->load->view('layouts/main', $data);


    }

    function ajax_pagination_data()
    {
        $conditions = array();

        $page = $this->input->post('page');
        $offset = (!$page) ? 0 : $page;
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');

        if (!empty($keywords)) {
            $conditions['search']['keywords'] = $keywords;
        }

        if (!empty($sortBy)) {
            $conditions['search']['sortBy'] = $sortBy;
        }

        //total rows count
        $totalRec = count($this->order->orderRows($conditions));

        //set limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;

        //pagination configuration
        $config['target'] = '#data_list';
        $config['base_url'] = base_url() . 'order/OrderController/ajax_pagination_data';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $this->perPage;
        $config['link_func'] = 'searchFilter';
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $data['orders'] = $this->order->orderRows($conditions);

        $this->load->view('order/orders/orders_today', $data, false);


    }

    
    //    new code here 2019-10-02

   
    
    
    

    public function try_delete($orderId)
    {

        if (isset($orderId)) {
            $result = $this->MainModel->deleteData('order_id', $orderId, 'order_data');
            if ($result) {

                $this->session->set_flashdata('message', ' Try  Order deleted    successfully!');
                redirect('order/OrderController/tryorder');

            } else {
                $this->session->set_flashdata('error', ' Order Does not deleted    successfully!');
                redirect('order/OrderController/tryorder');


            }
        }

    }
    

    public function try_update()
    {

        date_default_timezone_set("Asia/Dhaka");
        $order_total = $this->input->post('order_total');
        $order_id_check= $this->input->post('order_id');

        $row_data['order_total']		=	$order_total;
        $row_data['customer_name']					=	$this->input->post('customer_name');
        $row_data['customer_phone']					=	$this->input->post('customer_phone');
        $row_data['order_status']					=	$this->input->post('order_status');

        $row_data['shipment_time']		=	date("Y-m-d H:i:s");
        $row_data['created_time']		=	date("Y-m-d H:i:s");
        $row_data['modified_time']		=	date("Y-m-d H:i:s");
        if(isset($order_id_check)) {
            $order_data = $this->MainModel->updateData('order_id', $order_id_check, 'order_data', $row_data);
            $product_name = $this->input->post('product_name');
            $product_price = $this->input->post('product_price');
            $product_color = $this->input->post('product_color');
            $product_featured_image = $this->input->post('product_image');
            $product_qty = $this->input->post('product_qnt');
            $product_size = $this->input->post('product_size');
            for ($count = 0; $count < count($product_name); $count++) {
                $row_dataa['product_name'] = $product_name[$count];
                $row_dataa['product_price'] = $product_price[$count];
                $row_dataa['product_color'] = $product_color[$count];
                $row_dataa['product_image'] = $product_featured_image[$count];
                $row_dataa['product_size'] = $product_size[$count];
                $row_dataa['product_qnt'] = $product_qty[$count];
                $row_dataa['order_id'] = $order_id_check;
                print_r($row_dataa);
                $order_data = $this->MainModel->updateData('order_id', $order_id_check, 'tryorder', $row_dataa);

            }
            $this->session->set_flashdata('message', ' Try  Order updated    successfully!');
            redirect('order/OrderController/tryorder');
        }

    }




}
