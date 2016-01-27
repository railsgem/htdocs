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
            $this->load->library('form_validation');


            $this->form_validation->set_rules('stock_id', 'Stock ID', 'required|integer');
            if ($this->form_validation->run() === FALSE)
            {
                $data['update_success'] ='';
                $data['title'] ='Stock list';
                $data['stock'] = $this->stock_model->get_Stock();
                $this->load->view('templates/header');
                $this->load->view('stock/index', $data);
                $this->load->view('templates/footer');          
            }
            else
            {
                $Stock_id = $this->input->post('Stock_id');

                $data['title'] ='Stock list';
                $this->Stock_model->delete_Stock($Stock_id);

                $data['stock'] = $this->Stock_model->get_Stock();
                $data['update_success'] ='Delete Successfully.';
                $this->load->view('templates/header');
                $this->load->view('stock/index', $data);
                $this->load->view('templates/footer');
            }        
        
        }

        public function edit($Stock_id = FALSE)
        {
            if ($Stock_id !== FALSE)
            {
                $this->load->helper('form');
                $this->load->helper('security');
                $this->load->library('form_validation');

                $this->form_validation->set_rules('Stock_name', 'Stock Name', 'trim|required|xss_clean');

                if ($this->form_validation->run() === FALSE)
                {
                    $data['update_success'] ='';
                    $data['Stock'] = $this->Stock_model->get_Stock($Stock_id);
                    $this->load->view('templates/header');
                    $this->load->view('Stock/edit',$data);
                    $this->load->view('templates/footer');
                }
                else
                {
                    $this->Stock_model->update_Stock($Stock_id);

                    $data['Stock'] = $this->Stock_model->get_Stock($Stock_id);

                    $data['update_success'] ='Save Successfully.';

                    $this->load->view('templates/header');
                    $this->load->view('Stock/edit', $data);
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
                $data['update_success'] ='update_success';
                $this->stock_model->set_Stock();

                $data['title'] ='Stock list';
                redirect('stock/index', refresh);
            }
        }

        
        public function get_product_json()
        {
            $data['product_json'] = $this->product_model->get_product_by_name();
            print_r(json_encode($data['product_json']));
            //$this->load->view('stock/product_json',$data);
        }
}