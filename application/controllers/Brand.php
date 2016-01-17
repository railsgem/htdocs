<?php
class Brand extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('brand_model');
        }

        public function index()
        {
            $this->load->helper('form');
            $this->load->helper('security');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('brand_id', 'Brand ID', 'required|integer');

            if ($this->form_validation->run() === FALSE)
            {
                $data['update_success'] ='';
                $data['title'] ='brand list';
                $data['brand'] = $this->brand_model->get_brand();

                $this->load->view('templates/header');
                $this->load->view('brand/index', $data);
                $this->load->view('templates/footer');          
            }
            else
            {
                $brand_id = $this->input->post('brand_id');

                $data['title'] ='brand list';
                $this->brand_model->delete_brand($brand_id);

                $data['brand'] = $this->brand_model->get_brand();
                $data['update_success'] ='Delete Successfully.';
                $this->load->view('templates/header');
                $this->load->view('brand/index', $data);
                $this->load->view('templates/footer');
            }        
        
        }

        public function edit($brand_id = FALSE)
        {
            if ($brand_id !== FALSE)
            {
                $this->load->helper('form');
                $this->load->helper('security');
                $this->load->library('form_validation');

                $this->form_validation->set_rules('brand_name', 'Brand Name', 'trim|required|xss_clean');

                if ($this->form_validation->run() === FALSE)
                {
                    $data['update_success'] ='';
                    $data['brand'] = $this->brand_model->get_brand($brand_id);
                    $this->load->view('templates/header');
                    $this->load->view('brand/edit',$data);
                    $this->load->view('templates/footer');
                }
                else
                {
                    $this->brand_model->update_brand($brand_id);

                    $data['brand'] = $this->brand_model->get_brand($brand_id);

                    $data['update_success'] ='Save Successfully.';

                    $this->load->view('templates/header');
                    $this->load->view('brand/edit', $data);
                    $this->load->view('templates/footer');
                }
            }
        }


        public function create()
        {
            $this->load->helper('form');
            $this->load->helper('security');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('brand_name', 'Brand Name', 'trim|required|xss_clean');

            if ($this->form_validation->run() === FALSE)
            {
                $data['title'] ='brand list';
                $this->load->view('templates/header');
                $this->load->view('brand/create',$data);
                $this->load->view('templates/footer');
            }
            else
            {
                $this->brand_model->set_brand();

                $data['title'] ='brand list';
                $this->load->view('templates/header');
                $this->load->view('brand/success',$data);
                $this->load->view('templates/footer');
            }
        }

        
}