<?php
class Address extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('address_model');
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
            $this->form_validation->set_rules('address_id', 'address ID', 'required|integer');

            //delete address
            $delete_address_id = $this->input->get('delete_address_id');
            if ($delete_address_id !='')
            {
                $this->address_model->delete_address($delete_address_id);
                $data['update_success'] ='Delete Successfully.';
            }

            $config['uri_segment'] = 3;
            $config['base_url'] = '/index.php/address/index/';
            $config['total_rows'] = $this->address_model->get_address_list(NULL,NULL,TRUE,FALSE);
            $config['per_page'] = 5; 

            $this->pagination->initialize($config); 

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['address'] = $this->address_model->get_address_list($page,$config["per_page"],FALSE,FALSE);
            $data["page_section"] = $this->pagination->create_links();
            $data['total'] = $this->address_model->get_address_list(NULL,NULL,TRUE,FALSE);
            $data['address_echart'] = $this->address_model->get_address_list(NULL,NULL,FALSE,TRUE);

            $this->load->view('templates/header');
            $this->load->view('address/index', $data);
            $this->load->view('templates/footer'); 

        
        }

        public function edit($address_id = FALSE)
        {
            if ($address_id !== FALSE)
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
                    $data['address'] = $this->address_model->get_address($address_id);
                    $this->load->view('templates/header');
                    $this->load->view('address/edit',$data);
                    $this->load->view('templates/footer');
                }
                else
                {
                    $this->address_model->update_address($address_id);

                    $data['address'] = $this->address_model->get_address($address_id);

                    $data['update_success'] ='Save Successfully.';

                    $this->load->view('templates/header');
                    $this->load->view('address/edit', $data);
                    $this->load->view('templates/footer');
                }
            }
        }



        public function create()
        {
            $this->load->helper('form');
            $this->load->helper('security');
            $this->load->library('form_validation');


            $this->form_validation->set_rules('address_detail', 'address_name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone', 'address_nation_id', 'trim|required|xss_clean');
            $this->form_validation->set_rules('recevier_name', 'address_address', 'trim|required|xss_clean');
            $this->form_validation->set_rules('recevier_nation_id', 'recevier_nation_id', 'trim|required|xss_clean');
            
            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/header');
                $this->load->view('address/create');
                $this->load->view('templates/footer');
            }
            else
            {

                $this->address_model->set_address();

                $this->load->view('templates/header');
                $this->load->view('address/success');
                $this->load->view('templates/footer');
            }
        }


}