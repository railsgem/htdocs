<?php
class Product extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->library('ion_auth');
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
        $this->form_validation->set_rules('product_name', 'Product Name', 'trim|xss_clean');
        $this->form_validation->set_rules('barcode', 'Barcpde', 'trim|xss_clean');

        //$config['num_links'] = 5;
        //$config['page_query_string'] = false;
        $config['uri_segment'] = 3;
        $config['base_url'] = '/index.php/product/index/';
        $config['total_rows'] = $this->product_model->get_product_list(NULL,NULL,TRUE);
        //echo 'xxx'.$this->product_model->get_product_list(NULL,NULL,TRUE);
        $config['per_page'] = 20; 

        $this->pagination->initialize($config); 

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['product'] = $this->product_model->get_product_list($page,$config["per_page"],FALSE);
        $data["page_section"] = $this->pagination->create_links();

        //$data['brand'] = $this->brand_model->get_brand();
        //$data['category'] = $this->category_model->get_category();

        $data['total'] = $this->product_model->get_product_list(NULL,NULL,TRUE);


        $this->load->view('templates/header');
        $this->load->view('product/index', $data);
        $this->load->view('templates/footer'); 
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->helper('security');
        $this->load->library('form_validation');


        $this->form_validation->set_rules('product_name', 'product_name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('chemist_price', 'cost price', 'trim|required|xss_clean');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('product/create');
            $this->load->view('templates/footer');
        }
        else
        {

            $this->product_model->set_product();

            $this->load->view('templates/header');
            $this->load->view('product/success');
            $this->load->view('templates/footer');
        }
    }



}