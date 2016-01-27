<?php
class Category extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('category_model');
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

            $this->form_validation->set_rules('category_id', 'Category ID', 'required|integer');

            if ($this->form_validation->run() === FALSE)
            {
                $data['update_success'] ='';
                $data['category'] = $this->category_model->get_category();

                $this->load->view('templates/header');
                $this->load->view('category/index', $data);
                $this->load->view('templates/footer');          
            }
            else
            {
                $category_id = $this->input->post('category_id');

                $this->category_model->delete_category($category_id);

                $data['category'] = $this->category_model->get_category();
                $data['update_success'] ='Delete Successfully.';
                $this->load->view('templates/header');
                $this->load->view('category/index', $data);
                $this->load->view('templates/footer');
            }        
        
        }
        public function edit($category_id = FALSE)
        {
            if ($category_id !== FALSE)
            {
                $this->load->helper('form');
                $this->load->helper('security');
                $this->load->library('form_validation');

                $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|xss_clean');


                if ($this->form_validation->run() === FALSE)
                {
                    $data['update_success'] ='';
                    $data['category'] = $this->category_model->get_category($category_id);
                    $this->load->view('templates/header');
                    $this->load->view('category/edit',$data);
                    $this->load->view('templates/footer');
                }
                else
                {
                    $this->category_model->update_category($category_id);

                    $data['category'] = $this->category_model->get_category($category_id);

                    $data['update_success'] ='Save Successfully.';

                    $this->load->view('templates/header');
                    $this->load->view('category/edit', $data);
                    $this->load->view('templates/footer');
                }
            }
        }


        public function create()
        {
            $this->load->helper('form');
            $this->load->helper('security');
            $this->load->library('form_validation');

            $this->form_validation->set_rules('category_name', 'Category Name', 'trim|required|xss_clean');

            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/header');
                $this->load->view('category/create');
                $this->load->view('templates/footer');
            }
            else
            {
                $this->category_model->set_category();

                $this->load->view('templates/header');
                $this->load->view('category/success');
                $this->load->view('templates/footer');
            }
        }

        
}