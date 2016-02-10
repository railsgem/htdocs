<?php
class Stock extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('stock_model');
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

            $this->form_validation->set_rules('stock_id', 'Stock ID', 'required|integer');

            if ($this->form_validation->run() === FALSE)
            {
                $data['update_success'] ='';
                $config['uri_segment'] = 3;
                $config['base_url'] = '/index.php/stock/index/';
                $config['total_rows'] = $this->stock_model->get_stock_list(NULL,NULL,TRUE);
                $config['per_page'] = 5; 

                $this->pagination->initialize($config); 

                $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                //$data['record'] = $this->stock_model->get_record_list($page,$config["per_page"],FALSE);
                $data["page_section"] = $this->pagination->create_links();

                $data['total'] = $this->stock_model->get_stock_list(NULL,NULL,TRUE);
                $data['stock'] = $this->stock_model->get_stock_list($page,$config["per_page"],FALSE);

                $this->load->view('templates/header');
                $this->load->view('stock/index', $data);
                $this->load->view('templates/footer');          
            }
            else
            {
                $stock_id = $this->input->post('stock_id');
                $this->stock_model->delete_stock($stock_id);

                $config['uri_segment'] = 3;
                $config['base_url'] = '/index.php/stock/index/';
                $config['total_rows'] = $this->stock_model->get_stock_list(NULL,NULL,TRUE);
                $config['per_page'] = 5; 

                $this->pagination->initialize($config); 

                $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                //$data['record'] = $this->stock_model->get_record_list($page,$config["per_page"],FALSE);
                $data["page_section"] = $this->pagination->create_links();

                $data['total'] = $this->stock_model->get_stock_list(NULL,NULL,TRUE);
                $data['stock'] = $this->stock_model->get_stock_list($page,$config["per_page"],FALSE);
                $data['update_success'] ='Delete Successfully.';
                $this->load->view('templates/header');
                $this->load->view('stock/index', $data);
                $this->load->view('templates/footer'); 
            }
        }

        public function edit($stock_id = FALSE)
        {
            if ($stock_id !== FALSE)
            {
                $this->load->helper('form');
                $this->load->helper('security');
                $this->load->library('form_validation');

                $this->form_validation->set_rules('stock_id', 'Stock ID', 'trim|required|xss_clean');

                if ($this->form_validation->run() === FALSE)
                {
                    $data['update_success'] ='';
                    $data['stock'] = $this->stock_model->get_stock($stock_id);
                    $this->load->view('templates/header');
                    $this->load->view('stock/edit',$data);
                    $this->load->view('templates/footer');
                }
                else
                {
                    $this->stock_model->update_stock($stock_id);

                    $data['stock'] = $this->stock_model->get_stock($stock_id);

                    $data['update_success'] ='Save Successfully.';

                    $this->load->view('templates/header');
                    $this->load->view('stock/edit', $data);
                    $this->load->view('templates/footer');
                }
            }
        }


        public function create()
        {
            $this->load->helper('form');
            $this->load->helper('security');
            $this->load->helper('url');
            $this->load->library('form_validation');

            $data['update_success'] ='';
            $data['product'] = $this->product_model->get_product();

            $this->form_validation->set_rules('os_product_id', 'os_product_id', 'required|integer');

            if ($this->form_validation->run() === FALSE)
            {
                $data['title'] ='Stock list';
                $this->load->view('templates/header');
                $this->load->view('stock/create',$data);
                $this->load->view('templates/footer');
            }
            else
            {
                $data['update_success'] ='Create success';
                $this->stock_model->set_Stock();

                $data['title'] ='Stock list';
                $data['stock'] = $this->stock_model->get_Stock();
                redirect('stock/index');
            }
        }

        
        public function get_product_json()
        {
            $data['product_json'] = $this->product_model->get_product_by_name();
            print_r(json_encode($data['product_json']));
        }

        public function order_list()
        {
            $this->load->helper('form');
            $this->load->helper('security');
            $this->load->library('form_validation');
            $this->load->library('pagination');
            $data['update_success'] ='';

            $this->form_validation->set_rules('stock_id', 'Stock ID', 'required|integer');

            $config['uri_segment'] = 3;
            $config['base_url'] = '/index.php/stock/order_list/';
            $config['total_rows'] = $this->stock_model->get_order_list(NULL,NULL,TRUE);
            $config['per_page'] = 5; 

            $this->pagination->initialize($config); 

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            //$data['record'] = $this->stock_model->get_record_list($page,$config["per_page"],FALSE);
            $data["page_section"] = $this->pagination->create_links();

            $data['total'] = $this->stock_model->get_order_list(NULL,NULL,TRUE);
            $data['order'] = $this->stock_model->get_order_list($page,$config["per_page"],FALSE);
            $this->load->view('templates/header');
            $this->load->view('stock/order_list', $data);
            $this->load->view('templates/footer');       
        }



}