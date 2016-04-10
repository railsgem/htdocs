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

        foreach ($data['order'] as $order_item) {
            $order_id = $order_item['order_id'];
            $data['product_'.$order_id] = $this->order_model->order_product_list($order_id);
            $data['product_count_'.$order_id] = count($data['product_'.$order_id]);
            $data['postage_'.$order_id] = $this->order_model->get_order_postage_list($order_id);
        
        }
        

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
                $agent_id = $data['order']['agent_id'];
                //$data['address'] = $this->address_model->get_address();
                $data['address'] = $this->address_model->get_address_by_agent_id($agent_id);
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
    public function edit_order_product()
    {
        $this->order_model->edit_order_product();
       
    }
    public function delete_order_product()
    {
        $this->order_model->delete_order_product();
       
    }
    public function add_order_product()
    {
        $this->order_model->add_order_product();
       
    }
    public function auto_despatch()
    {
        $this->order_model->auto_despatch();
       
    }
    public function order_product_list($order_id = FALSE)
    {
        $this->load->helper('form');
        $this->load->helper('security');
        $this->load->library('form_validation');
        //test from here
        $this->form_validation->set_rules('order_id', 'order_id', 'required|integer');
                    
        
        $data['order'] = $this->order_model->get_order($order_id);
        $data['order_id'] = $order_id;
        $data['product'] = $this->product_model->get_product();
        $data['order_product'] = $this->order_model->order_product_list($order_id);
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
        
        $data['order'] = $this->order_model->get_order($order_id);
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
            /*print_r($data['order']);
            exit;*/
            $data['product'] = $this->order_model->order_product_list($order_id);
            $data['stock'] = $this->stock_model->get_stock_by_order_id($order_id);
            $data['despatch'] = $this->stock_model->get_despatch_by_order_id($order_id);
            $data['despatch_cost'] = $this->stock_model->get_despatch_cost_by_order_id($order_id);

            $data['postage'] = $this->order_model->get_order_postage_list($order_id);
            
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
            $data['despatch_cost'] = $this->stock_model->get_despatch_cost_by_order_id($order_id);

            $this->load->view('templates/header');
            //$this->load->view('postage/success');
            redirect('order/despatch/'.$order_id, 'refresh');
            $this->load->view('templates/footer');
        }
    }
    public function quick_update_stock_take($stock_id = FALSE,$order_id = FALSE,$os_product_id = FALSE,$new_stocktake = FALSE)
    {
            //echo "store_id:".$store_id;
            //return;
        if ($stock_id !== FALSE AND $order_id !==FALSE ) 
        {
            $this->order_model->quick_update_stock_take($stock_id,$order_id,$os_product_id,$new_stocktake);
            echo "success";
        }
        else
        {
            echo "fail";
        }
    }   
    public function set_despatch_num($stock_id = FALSE,$order_id = FALSE,$os_product_id = FALSE,$new_stocktake = FALSE)
    {
            //echo "store_id:".$store_id;
            //return;
        if ($stock_id !== FALSE AND $order_id !==FALSE ) 
        {
            $this->order_model->set_despatch_num($stock_id,$order_id,$os_product_id,$new_stocktake);
            echo "success";
        }
        else
        {
            echo "fail";
        }
    }   
    public function save_new_address()
    {
        $recevier_name = $this->input->post('recevier_name');
        $address_detail = $this->input->post('address_detail');
        $phone = $this->input->post('phone');
        $recevier_nation_id = $this->input->post('recevier_nation_id');
        $agent_id = $this->input->post('agent_id');

        if ($recevier_name !== "" AND $address_detail !== ""  AND $phone !== ""  AND $recevier_nation_id !== "" AND $agent_id !== "" ) 
        {   
            $agent_address = $this->address_model->save_new_agent_address($agent_id, $recevier_name,$address_detail,$phone,$recevier_nation_id);
            echo json_encode($agent_address);
        }
        else
        {
            echo "fail";
        }
    }  
    public function get_agent_address_list()
    {
        $agent_id = $this->input->post('agent_id');

        if ($agent_id !== "" ) 
        {
            $address = $this->address_model->get_address_by_agent_id($agent_id);
            echo json_encode($address);
        }
        else
        {
            echo "fail";
        }
    }   

    public function delete_agent_address($agent_address_id = FALSE)
    {
        $agent_address_id = $this->input->post('agent_address_id');
        if ($agent_address_id !== "" ) 
        {
            $this->address_model->delete_agent_address($agent_address_id);
            echo "success";
        }
        else
        {
            echo "fail";
        }
    }

    public function edit_agent_address($order_id= FALSE , $address_id = FALSE)
    {
        
        if ($address_id !== FALSE and $order_id !== FALSE)
        {
            $this->load->helper('form');
            $this->load->helper('security');
            $this->load->library('form_validation');

            //$this->form_validation->set_rules('address_rep_date', 'address Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('address_detail', 'address_name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone', 'address_nation_id', 'trim|required|xss_clean');
            $this->form_validation->set_rules('recevier_name', 'address_address', 'trim|required|xss_clean');
            $this->form_validation->set_rules('recevier_nation_id', 'recevier_nation_id', 'trim|required|xss_clean');

            if ($this->form_validation->run() === FALSE)
            {
                $data['update_success'] ='';
                $data['order_id'] = $order_id;
                $data['address'] = $this->address_model->get_address($address_id);
                $this->load->view('templates/header');
                $this->load->view('order/edit_agent_address',$data);
                $this->load->view('templates/footer');
            }
            else
            {
                $this->address_model->update_address($address_id, $order_id);

                $data['order_id'] = $order_id;
                $data['address'] = $this->address_model->get_address($address_id);

                $data['update_success'] ='Save Successfully.';

                $this->load->view('templates/header');
                $this->load->view('order/edit_address_success', $data);
                $this->load->view('templates/footer');
            }
        }
    }
    
}