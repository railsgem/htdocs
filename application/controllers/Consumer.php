<?php
class Consumer extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('consumer_model');
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
            $this->form_validation->set_rules('consumer_id', 'consumer ID', 'required|integer');

            //delete consumer
            $delete_consumer_id = $this->input->get('delete_consumer_id');
            if ($delete_consumer_id !='')
            {
                $this->consumer_model->delete_consumer($delete_consumer_id);
                $data['update_success'] ='Delete Successfully.';
            }

            $config['uri_segment'] = 3;
            $config['base_url'] = '/index.php/consumer/index/';
            $config['total_rows'] = $this->consumer_model->get_consumer_list(NULL,NULL,TRUE,FALSE);
            $config['per_page'] = 5; 

            $this->pagination->initialize($config); 

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['consumer'] = $this->consumer_model->get_consumer_list($page,$config["per_page"],FALSE,FALSE);
            $data["page_section"] = $this->pagination->create_links();
            $data['total'] = $this->consumer_model->get_consumer_list(NULL,NULL,TRUE,FALSE);
            $data['consumer_echart'] = $this->consumer_model->get_consumer_list(NULL,NULL,FALSE,TRUE);

            $this->load->view('templates/header');
            $this->load->view('consumer/index', $data);
            $this->load->view('templates/footer'); 

        
        }

        public function edit($consumer_id = FALSE)
        {
            if ($consumer_id !== FALSE)
            {
                $this->load->helper('form');
                $this->load->helper('security');
                $this->load->library('form_validation');

                //$this->form_validation->set_rules('consumer_rep_date', 'consumer Name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('consumer_name', 'consumer_name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('consumer_nation_id', 'consumer_nation_id', 'trim|required|xss_clean');
                $this->form_validation->set_rules('consumer_address', 'consumer_address', 'trim|required|xss_clean');
                $this->form_validation->set_rules('consumer_phone', 'consumer_phone', 'trim|required|xss_clean');
                $this->form_validation->set_rules('is_agent', 'is_agent', 'required|integer');

                if ($this->form_validation->run() === FALSE)
                {
                    $data['update_success'] ='';
                    $data['consumer'] = $this->consumer_model->get_consumer($consumer_id);
                    $this->load->view('templates/header');
                    $this->load->view('consumer/edit',$data);
                    $this->load->view('templates/footer');
                }
                else
                {
                    $this->consumer_model->update_consumer($consumer_id);

                    $data['consumer'] = $this->consumer_model->get_consumer($consumer_id);

                    $data['update_success'] ='Save Successfully.';

                    $this->load->view('templates/header');
                    $this->load->view('consumer/edit', $data);
                    $this->load->view('templates/footer');
                }
            }
        }



        public function create()
        {
            $this->load->helper('form');
            $this->load->helper('security');
            $this->load->library('form_validation');


            $this->form_validation->set_rules('consumer_name', 'consumer_name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('consumer_nation_id', 'consumer_nation_id', 'trim|required|xss_clean');
            $this->form_validation->set_rules('consumer_address', 'consumer_address', 'trim|required|xss_clean');
            $this->form_validation->set_rules('consumer_phone', 'consumer_phone', 'trim|required|xss_clean');
            $this->form_validation->set_rules('is_agent', 'is_agent', 'required|integer');
            
            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/header');
                $this->load->view('consumer/create');
                $this->load->view('templates/footer');
            }
            else
            {

                $this->consumer_model->set_consumer();

                $this->load->view('templates/header');
                $this->load->view('consumer/success');
                $this->load->view('templates/footer');
            }
        }


}