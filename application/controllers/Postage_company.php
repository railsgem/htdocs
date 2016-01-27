<?php
class Postage_company extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
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
            $this->form_validation->set_rules('postage_company_id', 'postage_company ID', 'required|integer');

            //delete postage_company
            $delete_postage_company_id = $this->input->get('delete_postage_company_id');
            if ($delete_postage_company_id !='')
            {
                $this->postage_company_model->delete_postage_company($delete_postage_company_id);
                $data['update_success'] ='Delete Successfully.';
            }

            $config['uri_segment'] = 3;
            $config['base_url'] = '/index.php/postage_company/index/';
            $config['total_rows'] = $this->postage_company_model->get_postage_company_list(NULL,NULL,TRUE,FALSE);
            $config['per_page'] = 5; 

            $this->pagination->initialize($config); 

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['postage_company'] = $this->postage_company_model->get_postage_company_list($page,$config["per_page"],FALSE,FALSE);
            $data["page_section"] = $this->pagination->create_links();
            $data['total'] = $this->postage_company_model->get_postage_company_list(NULL,NULL,TRUE,FALSE);
            $data['postage_company_echart'] = $this->postage_company_model->get_postage_company_list(NULL,NULL,FALSE,TRUE);

            $this->load->view('templates/header');
            $this->load->view('postage_company/index', $data);
            $this->load->view('templates/footer'); 

        
        }

        public function edit($postage_company_id = FALSE)
        {
            if ($postage_company_id !== FALSE)
            {
                $this->load->helper('form');
                $this->load->helper('security');
                $this->load->library('form_validation');

                $this->form_validation->set_rules('postage_company_name', 'postage_company_name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('postage_website', 'postage_website', 'trim|required|xss_clean');

                if ($this->form_validation->run() === FALSE)
                {
                    $data['update_success'] ='';
                    $data['postage_company'] = $this->postage_company_model->get_postage_company($postage_company_id);
                    $this->load->view('templates/header');
                    $this->load->view('postage_company/edit',$data);
                    $this->load->view('templates/footer');
                }
                else
                {
                    $this->postage_company_model->update_postage_company($postage_company_id);

                    $data['postage_company'] = $this->postage_company_model->get_postage_company($postage_company_id);

                    $data['update_success'] ='Save Successfully.';

                    $this->load->view('templates/header');
                    $this->load->view('postage_company/edit', $data);
                    $this->load->view('templates/footer');
                }
            }
        }



        public function create()
        {
            $this->load->helper('form');
            $this->load->helper('security');
            $this->load->library('form_validation');


            $this->form_validation->set_rules('postage_company_name', 'postage_company_name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('postage_website', 'postage_website', 'trim|required|xss_clean');
            
            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/header');
                $this->load->view('postage_company/create');
                $this->load->view('templates/footer');
            }
            else
            {

                $this->postage_company_model->set_postage_company();

                $this->load->view('templates/header');
                $this->load->view('postage_company/success');
                $this->load->view('templates/footer');
            }
        }


}