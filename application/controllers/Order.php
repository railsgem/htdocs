<?php
class Order extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('order_model');
                $this->load->model('product_model');
                $this->load->model('consumer_model');
                $this->load->model('address_model');
                $this->load->model('postage_model');
                $this->load->model('postage_company_model');
                $this->load->model('stock_model');
                $this->load->library('ion_auth');
                $this->load->helper('url');
                if (!$this->ion_auth->logged_in())
                {
                    redirect('auth/login');
                }                
        }
        
        public function index()
        {

            $this->load->helper('form');
            $this->load->helper('security');
            $this->load->library('form_validation');
            $this->load->library('pagination');
            $data['update_success'] ='';
            $this->form_validation->set_rules('order_id', 'order ID', 'required|integer');

            //delete order
            $delete_order_id = $this->input->get('delete_order_id');
            if ($delete_order_id !='')
            {
                $this->order_model->delete_order($delete_order_id);
                $data['update_success'] ='Delete Successfully.';
            }

            $config['uri_segment'] = 3;
            $config['base_url'] = '/index.php/order/index/';
            $config['total_rows'] = $this->order_model->get_order_list(NULL,NULL,TRUE,FALSE);
            $config['per_page'] = 5; 

            $this->pagination->initialize($config); 

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['order'] = $this->order_model->get_order_list($page,$config["per_page"],FALSE,FALSE);
            $data["page_section"] = $this->pagination->create_links();
            $data['total'] = $this->order_model->get_order_list(NULL,NULL,TRUE,FALSE);
            $data['order_echart'] = $this->order_model->get_order_list(NULL,NULL,FALSE,TRUE);

            $this->load->view('templates/header');
            $this->load->view('order/index', $data);
            $this->load->view('templates/footer'); 

        
        }

        public function edit($order_id = FALSE)
        {
            if ($order_id !== FALSE)
            {
                $this->load->helper('form');
                $this->load->helper('security');
                $this->load->library('form_validation');

                $this->form_validation->set_rules('post_address_id', 'post_address_id', 'required|integer');
                
                if ($this->form_validation->run() === FALSE)
                {
                    $data['update_success'] ='';
                    $data['order'] = $this->order_model->get_order($order_id);
                    $data['address'] = $this->address_model->get_address();
                    $data['product'] = $this->order_model->order_product_list($order_id);

                    $this->load->view('templates/header');
                    $this->load->view('order/edit',$data);
                    $this->load->view('templates/footer');
                }
                else
                {
                    $this->order_model->update_order($order_id);

                    $data['order'] = $this->order_model->get_order($order_id);
                    $data['product'] = $this->order_model->order_product_list($order_id);

                    $data['update_success'] ='Save Successfully.';

                    $this->load->view('templates/header');
                    $this->load->view('order/edit', $data);
                    $this->load->view('templates/footer');
                }
            }
        }



        public function create()
        {
            $this->load->helper('form');
            $this->load->helper('security');
            $this->load->library('form_validation');
            //test from here
            $this->form_validation->set_rules('consumer_id', 'consumer_id', 'required|integer');
            
            $data['product'] = $this->product_model->get_product();
            $data['consumer'] = $this->consumer_model->get_agent();
            $data['address'] = $this->address_model->get_address();
            $data['cart_product'] = $this->order_model->get_cart_product();
            if ($this->form_validation->run() === FALSE)
            {   
                $this->load->view('templates/header');
                $this->load->view('order/create',$data);
                $this->load->view('templates/footer');
            }
            else
            {

                $this->order_model->set_order();

               // $data['consumer_json'] = $this->consumer_model->get_consumer($consumer_id);
                $this->load->view('templates/header');
                $this->load->view('order/success');
                $this->load->view('templates/footer');
            }
        }

        public function add_product_to_cart()
        {
            $this->order_model->add_product_to_cart();
        }

        public function delete_cart_product()
        {
            $this->order_model->delete_cart_product();
           
        }
        public function delete_order_product()
        {
            $this->order_model->delete_order_product();
           
        }
        public function add_order_product()
        {
            $this->order_model->add_order_product();
           
        }
        public function order_product_list($order_id = FALSE)
        {
            $this->load->helper('form');
            $this->load->helper('security');
            $this->load->library('form_validation');
            //test from here
            $this->form_validation->set_rules('order_id', 'order_id', 'required|integer');
                        
            
            $data['order_id'] = $order_id;
            $data['product'] = $this->order_model->order_product_list($order_id);
            $data['consumer'] = $this->consumer_model->get_agent();
            $data['address'] = $this->address_model->get_address();
            $data['cart_product'] = $this->order_model->get_cart_product();


            if ($this->form_validation->run() === FALSE)
            {   
                $this->load->view('templates/header');
                $this->load->view('order/order_product_list',$data);
                $this->load->view('templates/footer');
            }
            else
            {

                //$this->order_model->set_order();

               // $data['consumer_json'] = $this->consumer_model->get_consumer($consumer_id);
                $this->load->view('templates/header');
                $this->load->view('order/success');
                $this->load->view('templates/footer');
            }
        }


    //activate the order
    function activate($order_id)
    {
        $order_id = (int) $order_id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('order_id', 'order_id', 'required|integer');

        if ($this->form_validation->run() == FALSE)
        {
            $this->order_model->activate($order_id);

            //redirect them back to the auth page
            $this->load->view('templates/header'); 
            redirect('order', 'refresh');
            $this->load->view('templates/footer'); 
        }
        else
        {
            $this->order_model->activate($order_id);

            //redirect them back to the auth page
            $this->load->view('templates/header'); 
            redirect('order', 'refresh');
            $this->load->view('templates/footer'); 
        }
    }

    //deactivate the order
    function deactivate($order_id = NULL)
    {

        $order_id = (int) $order_id;

        $this->order_model->deactivate($order_id);

        //redirect them back to the auth page
        $this->load->view('templates/header'); 
        redirect('order', 'refresh');
        $this->load->view('templates/footer'); 
    }

    function postage($order_id = NULL)
    {

        $this->load->helper('form');
        $this->load->helper('security');
        $this->load->library('form_validation');


        $this->form_validation->set_rules('postage_company_id', 'postage_company_id', 'required|integer');
        $this->form_validation->set_rules('postage_date', 'postage_date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('postage_code', 'postage_code', 'trim|required|xss_clean');
        
        $data['postage_company'] = $this->postage_company_model->get_postage_company_list(NULL,NULL,FALSE,FALSE);
        $data['order_id'] = $order_id;

        if ($this->form_validation->run() === FALSE)
        {   
            
            $data['postage'] = $this->order_model->get_order_postage_list($order_id);
            $this->load->view('templates/header');
            $this->load->view('order/postage',$data);
            $this->load->view('templates/footer');
        }
        else
        {

            $this->order_model->set_postage($order_id);
            $this->load->view('templates/header');
            //$this->load->view('postage/success');
            redirect('order/postage/'.$order_id, 'refresh');
            $this->load->view('templates/footer');
        }
    }

    function despatch($order_id = NULL)
    {

        $this->load->helper('form');
        $this->load->helper('security');
        $this->load->library('form_validation');


        $this->form_validation->set_rules('despatch_id', 'despatch_id', 'required|integer');
        $this->form_validation->set_rules('stock_id', 'stock_id', 'required|integer');
        $this->form_validation->set_rules('despatch_num', 'despatch_num', 'required|integer');
        
        //$data['postage_company'] = $this->postage_company_model->get_postage_company_list(NULL,NULL,FALSE,FALSE);
        $data['order_id'] = $order_id;

        if ($this->form_validation->run() === FALSE)
        {   
            $data['update_success'] ='';            
            $data['order'] = $this->order_model->get_order($order_id);
            $data['product'] = $this->order_model->order_product_list($order_id);
            $data['stock'] = $this->stock_model->get_stock_by_order_id($order_id);
           /* print_r($data['stock']);
            exit;*/
            //$data['postage'] = $this->order_model->get_order_postage_list($order_id);
            $this->load->view('templates/header');
            $this->load->view('order/despatch',$data);
            $this->load->view('templates/footer');
        }
        else
        {
            $data['update_success'] ='despatch Successfully';  

            $this->order_model->set_despatch($order_id);

            $data['order'] = $this->order_model->get_order($order_id);
            $data['product'] = $this->order_model->order_product_list($order_id);

            $this->load->view('templates/header');
            //$this->load->view('postage/success');
            redirect('order/despatch/'.$order_id, 'refresh');
            $this->load->view('templates/footer');
        }
    }

}