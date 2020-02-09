<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MainModel');
        $this->load->library('email');
        $this->load->library('session');
        $this->load->library('cart');
        $this->load->helper('form');
        $this->load->library('pdf');

        date_default_timezone_set('Asia/Dhaka');

        $visitor['client_ip'] = $_SERVER['REMOTE_ADDR'];
        $visitor['date'] = date('Y-m-d');
        $result = $this->MainModel->visitorCount($visitor['client_ip'], $visitor['date']);
        if (empty($result)) {
            $result = $this->MainModel->insertData('hitcounter', $visitor);

        }


    }

    public function index()
    {
        $data['page_name'] = 'home';
        $data['seo_title'] = get_option('home_seo_title');
        $data['seo_keywords'] = get_option('home_seo_keywords');
        $data['seo_content'] = get_option('home_seo_content');
        $data['class'] = 'main_wrapper';
        $data['mobile_bottom_menu_active'] = 'active';
        $data['mobile_single_page_menu_solve'] = 'mobile_single_page_menu_solve';
        $data['home'] = $this->load->view('website/home_content', $data, true);
        $this->load->view('website/home', $data);
    }

    public function ajax_search_items()
    {
        $search_query = trim($this->input->post('search_query'));
        $search_query = strtolower($search_query);
        $discount = '';

        $result = get_result("SELECT * FROM product WHERE product_title LIKE '%$search_query%' OR sku LIKE '$search_query%' limit 0, 6");
        $html = '';


        //	echo $result->num_rows();

        if ($result) {
            $i = 0;
            foreach ($result as $prod) {
                $product_link = base_url() . 'product/' . $prod->product_name;
                // product price
                $product_price = $prod->product_price;
                $product_title = $prod->product_title;
                $product_discount = $prod->discount_price;
                $sku = $prod->sku;
                if ($product_discount) {
                    $discount = $product_price;
                    $sell_price = $product_discount;
                } else {
                    $sell_price = $product_price;
                }
                $image = get_product_thumb($prod->product_id);

                if ($i <= 7) {
                    $html .= '<li class="search-item">
                            <a href="'.$product_link.'">
                                <div class="image">
                                    <img src="'.$image.'">
                                </div>
                                <div class="name">'.$product_title.'</div><div class="price">';
                    if ($product_discount) {
                        $html.='<span ><del>'.formatted_price($discount).'</del></span>&nbsp&nbsp&nbsp';
                    }

                    $html.='<span>'.formatted_price($sell_price).'</span></div>
                            </a>
                        </li>';
                }

                $i++;
            }


            $resultx = get_result("SELECT * FROM product WHERE product_title LIKE '%$search_query%' OR sku LIKE '$search_query%' ");

            if (sizeof($resultx) > 7) {
                $html .= '<li class="search-item"><a class="btn btn-info btn-sm" href="' . base_url() . 'search?q=' . $search_query . '">' . (sizeof($resultx) - 6) . ' more results</a></li>';
            }
        } else {
            $html .= '<tr style="padding:10px;"><td>No results found!</td></tr>';
        }

        echo json_encode(array("status" => "success", "return_value" => $html));
        die();
    }


    public function cart()
    {

        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->MainModel->getSingleData('user_id', $user_id, 'affiliate_users', '*');
        $data['page_name'] = 'home';
        $districts_query = "SELECT name FROM `districts` order by id ASC ";
        $data['districts'] = $this->MainModel->AllQueryDalta($districts_query);
        $data['home'] = $this->load->view('website/cart', $data, true);
        $this->load->view('website/home', $data);


    }


    public function checkout()
    {
        date_default_timezone_set('Asia/Dhaka');

        if ($this->input->post()) {

            $userid = $this->session->userdata('user_id');
            if ($userid) {
                $user_id = $this->session->userdata('user_id');
            } else {
                $user_id = 0;
            }

            $row_data['order_total'] = $this->input->post('order_total');
            $row_data['created_by'] = 'customer';
            $row_data['products'] = serialize($this->input->post('products'));
            $row_data['thana'] = $this->input->post('thana');
            $row_data['payment_type'] = $this->input->post('payment_type');
            $row_data['shipping_charge'] = $this->input->post('shipping_charge');
            $row_data['customer_name'] = $this->input->post('customer_name');
            $row_data['customer_phone'] = $this->input->post('customer_phone');
            $row_data['customer_email'] = $this->input->post('customer_email');
            $row_data['customer_address'] = $this->input->post('customer_address');
            $row_data['order_area'] = $this->input->post('order_area');
//            $row_data['delevery_address'] = $this->input->post('delevery_address');
//            $row_data['bkash_payment'] = $this->input->post('bkash_payment');
//            $row_data['city'] = $this->input->post('city');
            $row_data['affiliate_user_id'] = $user_id;
            $row_data['shipment_time'] = date("Y-m-d h:i:s");
            $row_data['created_time'] = date("Y-m-d h:i:s");
            $row_data['modified_time'] = date("Y-m-d");
            $order_id = $this->MainModel->returnInsertId('order_data', $row_data);
            if ($order_id) {

                
                $this->cart->destroy();


                redirect('checkout/thank-you/?order_id=' . $order_id, 'refresh');
            }


        } else {

            $user_id = $this->session->userdata('user_id');
            $data['user'] = $this->MainModel->getSingleData('user_id', $user_id, 'affiliate_users', '*');
            $data['districts'] = $this->MainModel->getAllData('', 'districts', '*', 'id ASC');

            $data['page_name'] = 'home';

            $data['home'] = $this->load->view('website/checkout', $data, true);
            $this->load->view('website/home', $data);
        }

    }


    public function thank_you()
    {
        $data['page_name'] = 'home';
        $order_id = $_GET['order_id'];
        $data['page_name'] = 'home';
        $order = $this->MainModel->getSingleData('order_id', $order_id, 'order_data', '*');
        $checkout_type = $order->payment_type;
        $products = unserialize($order->products);
        $order_total = $order->order_total;

        $billing_name = $order->customer_name;
        $billing_email = $order->customer_email;
        $billing_address = $order->customer_address;
        $delivery_address = $order->delevery_address;
        $shipping_charge = $order->shipping_charge;

        //send order confirmation email to customer
        $customer_email = $billing_email;
        $site_title = get_option('site_title');
        $site_email = get_option('email');
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);
        $this->email->from($site_email, $site_title);
        $this->email->to($customer_email, 'ok');
        $this->email->subject('Order Confirmation');

        $order_status = 'new';
        $product_items = $products;
        $payment_method = ucwords(str_replace('_', ' ', $checkout_type));
        $order_number = $order_id;
        $customer_name = $billing_name;
        $customer_address = $billing_address;
        $delivery_address = $delivery_address;

        ob_start();
        include('application/views/emails/email-header.php');
        include('application/views/emails/new-order.php');
        include('application/views/emails/email-footer.php');
        $email_body = ob_get_clean();

        //  echo $email_body;
        $this->email->message($email_body);
        $this->email->send();
        if ($this->email->send()) {

            // echo 'ok';
            //  exit();
        } else {
            // echo 'false';
            // exit();
        }

        $data['order'] = $order;

        $data['home'] = $this->load->view('website/thank_you', $data, true);
        $this->load->view('website/home', $data);

    }

public function  orderPrint($id){
    $data['order'] =$this->MainModel->getSingleData('order_id', $id, 'order_data', '*');

     $this->load->view('order_print_page', $data);


}


    public function category($category_name)
    {
        //$uri_string = explode("/", uri_string());
        //  $category_name = end($uri_string);
        $category_data = $this->MainModel->getSingleData('category_name', $category_name, 'category', 'parent_id,category_id,category_title,category_name,seo_title,seo_meta_title,seo_keywords,seo_content,seo_meta_content');

        $data['mobile_bottom_menu_active'] = 'active';
        if(empty($category_data)){
            redirect('/');
        }

        $data['breadcumb_category'] = $category_data->category_title;
        $data['breadcumb_category_link'] = $category_data->category_name;
        $data['category_id'] = $category_data->category_id;
        $data['parent_id'] = $category_data->parent_id;
        $category_name = $category_data->category_name;
        $this->load->model("CategoryModel");
        // $data['products']= $this->CategoryModel->scroll_pagination_product($category_data->category_id);


        $data['seo_title'] = $category_data->seo_title;
        $data['seo_keywords'] = $category_data->seo_keywords;
        $data['seo_content'] = $category_data->seo_content;
        $data['page_title'] = ucwords(str_replace("-", " ", $category_name));



      //  $data['home'] = $this->load->view('website/category_products', $data, true);
        $this->load->view('website/header', $data);
        $this->load->view('website/category_products', $data);
        $this->load->view('website/footer', $data);


    }

    public function product($product_name)
    {

        //$uri_string = explode("/", uri_string());
        // $product_name = end($uri_string);
        $post = $this->MainModel->getSingleData('product_name', $product_name, 'product', 'product_availability,product_name,product_id,product_title,product_price,discount_price,product_description,sku,product_stock,product_of_size,product_color,discount_type,product_video,seo_title,seo_keywords,seo_content,product_terms,product_summary');
        if($post) {
            $data['prod_row'] = $post;
            $data['page_title'] = $post->product_title;
            $product_id = $post->product_id;
            $data['seo_title'] = $post->seo_title;
            $data['seo_keywords'] = $post->seo_keywords;
            $data['seo_content'] = $post->seo_content;
            $sql = "SELECT category_title,category_name FROM `term_relation` join category on category.category_id=term_relation.term_id
WHERE product_id=$post->product_id limit 1";
            $category = get_result($sql);
            $data['specifications'] = $this->MainModel->allDataById("product_id", $product_id, 'product_specification', '*');

            $data['breadcumb_category'] = $category[0]->category_title;
            $data['breadcumb_category_link'] = 'category/' . $category[0]->category_name;
            $data['mobile_single_page_menu_solve']=1;



            $data['home'] = $this->load->view('website/product_font_view', $data, true);
            $this->load->view('website/home', $data);

        } else {
            redirect('/');
        }


    }

    public function pages()
    {
        $uri_string = explode("/", uri_string());
        $product_name = end($uri_string);

        $post = get_uri_not_found_data(end($uri_string));
        $data['class'] = 'page';


        $data['page_title'] = $post->page_name;
        $data['page_name'] = $post->page_link;
        $data['page_content'] = $post->page_content;

        $template = $post->page_template;
        $template = $template == 'default' ? 'website/pages/page' :'website/pages/'.$template;


        $data['home'] = $this->load->view($template, $data, true);
        $this->load->view('website/home', $data);


    }

    public function search()
    {
        //WHERE interests LIKE '%sports%' OR interests LIKE '%pub%'
        $search = $this->input->get_post('q');
        $track_id_id = $this->input->get_post('track_id_id');
        $data['track_id_id'] = $this->input->get_post('track_id_id');

        $data['page_title'] = 'Track Order';
        if($search) {
            $data['search'] = $search;
            $sql = "SELECT * FROM `product` WHERE `product_title` LIKE '%$search%'  OR sku LIKE '$search%'  ORDER BY product_id DESC";
            $data['products'] = get_result($sql);


            $data['home'] = $this->load->view('website/search', $data, true);
            $this->load->view('website/home', $data);
        } else {

            $data['home'] = $this->load->view('website/pages/page_track', $data, true);
            $this->load->view('website/home', $data);
        }
    }

    public function popular_product()
    {
        $data['breadcumb_category_link']='popular';
        $data['breadcumb_category']='Popular Items This Month';
        $data['category_id']=1;



        $data['home'] = $this->load->view('website/popular_products', $data, true);
        $this->load->view('website/home', $data);
    }


    public function tend_product()
    {
        $data['breadcumb_category_link']='tend';
        $data['breadcumb_category']='Latest Products';
        $data['category_id']=1;

        $this->load->view('website/header');
        $this->load->view('website/tend_products',$data);
        $this->load->view('website/footer');

        $data['home'] = $this->load->view('website/tend_products', $data, true);
        $this->load->view('website/home', $data);
    }

    public function affiliate_check_controller($route_name = null, $product_key = null, $user_id = null)
    {
        $unique_number = (mt_rand(10000, 999999));
        $cookie = array(
            'name' => 'unique_code',
            'value' => $unique_number,
            'expire' => time() + (86400 * 7),
            'secure' => false
        );
        $this->input->set_cookie($cookie);
        $result = $this->MainModel->select_product_id($product_key);
        $data = array(
            'user_id' => $user_id,
            'product_id' => $result->product_id,
            'unique_number' => $unique_number
        );
        $this->MainModel->insertData('product_hit_count', $data);
        $base_url = base_url();
        $get_link = $base_url . $route_name . "/" . $product_key;
        redirect($get_link);
    }

    public function pdf($order_id)
    {


        $order = $this->MainModel->getSingleData('order_id', $order_id, 'order_data', '*');
        $data['order'] = $order;


        $this->pdf->load_view('website/pdf', $data);
        $this->pdf->render();
        $this->pdf->stream($order_id . ".pdf");

    }

    public function password_reset()
    {


        //mail('suzonice15@gmail.com','ok','ffgggggggggggggggggggggg','gjjgjg','bfbfb');
        if ($this->input->post('email')) {
            $email = $this->input->post('email');
            if (is_numeric($email)) {
                $mobile = $email;
                $mobile_data['mobile'] = $mobile;
                $mobile_check = preg_match('/^[0-9]{11}+$/', $mobile);
                if ($mobile_check) {
                    $insert_id = $this->MainModel->returnInsertId('password_reset_request', $mobile_data);
                    if ($insert_id) {
                        $data['success'] = 'Thank you Within few hours we contact with you';


                        $this->load->view('website/header');
                        $this->load->view('affiliate/passord_reset', $data);
                        $this->load->view('website/footer');
                    }
                } else {
                    $data['error'] = 'Invalid phone number: must have exactly 11 digits and begin with 01';


                    $this->load->view('website/header');
                    $this->load->view('affiliate/passord_reset', $data);
                    $this->load->view('website/footer');

                }
            } else {
                $query = "SELECT * FROM `affiliate_users` WHERE user_email='$email'";
                $results = get_result($query);
                if ($results) {
                    $name = $results[0]->user_f_name;
                    $resetPassLink = base_url() . 'home/new_password/' . $email;
                    $data['success'] = 'To reset password varify  your email address';
                    $message = "Dear $name, 
                Recently a request was submitted to reset a password for your account. If this was a mistake, just ignore this email and nothing will happen.
               To reset your password, visit the following link: $resetPassLink
               Regards,
               Ekusheshop.com";
                    // $message='To reset password <a href="">click</a>here';
                    mail($email, 'Password Reset', $message);


                    $this->load->view('website/header');
                    $this->load->view('affiliate/passord_reset', $data);
                    $this->load->view('website/footer');

                } else {
                    $data['error'] = 'There are no account associate with this account';
                    $this->load->view('website/header');
                    $this->load->view('affiliate/passord_reset', $data);
                    $this->load->view('website/footer');
                }
            }

        } else {
            $this->load->view('website/header');
            $this->load->view('affiliate/passord_reset');
            $this->load->view('website/footer');
        }

    }


    public function new_password()
    {
        $uri_string = explode("/", uri_string());
        $uri_email = end($uri_string);

        $data['email'] = $uri_email;
        $this->load->view('website/header');
        $this->load->view('affiliate/new_password', $data);
        $this->load->view('website/footer');


    }

    public function new_update_password()
    {

        $email = $this->input->post('email');
        $data['email'] = $email;

        $passord = $this->input->post('passord');
        $row['user_password'] = $passord;
        $npassord = $this->input->post('npassord');
        if (strlen($passord) < 8) {
            $data['error'] = "Enter at least 8 digit alphabets";

            $this->load->view('website/header');
            $this->load->view('affiliate/new_password', $data);
            $this->load->view('website/footer');
        }
        if ($passord != $npassord) {
            $data['error'] = "New password and confirm password does not match";

            $this->load->view('website/header');
            $this->load->view('affiliate/new_password', $data);
            $this->load->view('website/footer');
        } else {
            $this->MainModel->updateData('user_email', $email, 'affiliate_users', $row);
            $data['success'] = "Your password has been changed";
            $this->load->view('website/header');
            $this->load->view('affiliate/new_password', $data);
            $this->load->view('website/footer');
        }


    }
    public  function trackorder($id){

        $data['track_id']=$id;
        $data['page_title']='Track Order';
        $this->load->view('website/header', $data);
        $this->load->view('website/pages/trackorder', $data);
        $this->load->view('website/footer', $data);

    }
    public function subscribe(){
        $data['newsletter_email']=$this->input->post('email');
        $data['created_time']=date("Y-m-d h:i:s");
        $data['status']=0;

        $this->MainModel->insertData('newsletter', $data);

    }

}
