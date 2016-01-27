<?php
class Postage extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('postage_model');
                $this->load->model('postage_company_model');
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
            $this->form_validation->set_rules('postage_id', 'postage ID', 'required|integer');

            //delete postage
            $delete_postage_id = $this->input->get('delete_postage_id');
            if ($delete_postage_id !='')
            {
                $this->postage_model->delete_postage($delete_postage_id);
                $data['update_success'] ='Delete Successfully.';
            }

            $config['uri_segment'] = 3;
            $config['base_url'] = '/index.php/postage/index/';
            $config['total_rows'] = $this->postage_model->get_postage_list(NULL,NULL,TRUE,FALSE);
            $config['per_page'] = 5; 

            $this->pagination->initialize($config); 

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['postage'] = $this->postage_model->get_postage_list($page,$config["per_page"],FALSE,FALSE);
            $data["page_section"] = $this->pagination->create_links();
            $data['total'] = $this->postage_model->get_postage_list(NULL,NULL,TRUE,FALSE);
            $data['postage_echart'] = $this->postage_model->get_postage_list(NULL,NULL,FALSE,TRUE);

            $this->load->view('templates/header');
            $this->load->view('postage/index', $data);
            $this->load->view('templates/footer'); 

        
        }

        public function edit($postage_id = FALSE)
        {
            if ($postage_id !== FALSE)
            {
                $this->load->helper('form');
                $this->load->helper('security');
                $this->load->library('form_validation');

                $this->form_validation->set_rules('postage_company_id', 'postage_company_id', 'required|integer');
                $this->form_validation->set_rules('postage_date', 'postage_date', 'trim|required|xss_clean');
                $this->form_validation->set_rules('postage_code', 'postage_code', 'trim|required|xss_clean');

                if ($this->form_validation->run() === FALSE)
                {
                    $data['update_success'] ='';
                    $data['postage'] = $this->postage_model->get_postage($postage_id);
                    $data['postage_company'] = $this->postage_company_model->get_postage_company_list(NULL,NULL,FALSE,FALSE);
                    
                    $this->load->view('templates/header');
                    $this->load->view('postage/edit',$data);
                    $this->load->view('templates/footer');
                }
                else
                {
                    $this->postage_model->update_postage($postage_id);

                    $data['postage_company'] = $this->postage_company_model->get_postage_company_list(NULL,NULL,FALSE,FALSE);
                    $data['postage'] = $this->postage_model->get_postage($postage_id);

                    $data['update_success'] ='Save Successfully.';

                    $this->load->view('templates/header');
                    $this->load->view('postage/edit', $data);
                    $this->load->view('templates/footer');
                }
            }
        }



        public function create()
        {
            $this->load->helper('form');
            $this->load->helper('security');
            $this->load->library('form_validation');


            $this->form_validation->set_rules('postage_company_id', 'postage_company_id', 'required|integer');
            $this->form_validation->set_rules('postage_date', 'postage_date', 'trim|required|xss_clean');
            $this->form_validation->set_rules('postage_code', 'postage_code', 'trim|required|xss_clean');
            
            $data['postage_company'] = $this->postage_company_model->get_postage_company_list(NULL,NULL,FALSE,FALSE);
            
            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/header');
                $this->load->view('postage/create',$data);
                $this->load->view('templates/footer');
            }
            else
            {

                $this->postage_model->set_postage();

                $this->load->view('templates/header');
                $this->load->view('postage/success');
                $this->load->view('templates/footer');
            }
        }


}