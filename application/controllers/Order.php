<?php
class Order extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('order_model');
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

            $this->load->view('templates/header');
            $this->load->view('order/index', $data);
            $this->load->view('templates/footer'); 

        
        }

        public function edit($rowid = FALSE)
        {
            if ($rowid !== FALSE)
            {
                $this->load->helper('form');
                $this->load->helper('security');
                $this->load->library('form_validation');

                $this->form_validation->set_rules('os_product_id', 'os_product_id', 'trim|required|xss_clean');
                $this->form_validation->set_rules('sell_price', 'sell_price', 'trim|required|xss_clean');
                
                if ($this->form_validation->run() === FALSE)
                {
                    $data['update_success'] ='';
                    $data['order'] = $this->order_model->get_order($rowid);
                    
                    $this->load->view('templates/header');
                    $this->load->view('order/edit',$data);
                    $this->load->view('templates/footer');
                }
                else
                {
                    $this->order_model->update_order($rowid);

                    $data['order'] = $this->order_model->get_order($rowid);

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


            $this->form_validation->set_rules('order_id', 'order_id', 'required|integer');
            $this->form_validation->set_rules('os_product_id', 'os_product_id', 'trim|required|xss_clean');
            $this->form_validation->set_rules('sell_price', 'sell_price', 'trim|required|xss_clean');
            
            $data['product'] = $this->product_model->get_product();
            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/header');
                $this->load->view('order/create',$data);
                $this->load->view('templates/footer');
            }
            else
            {

                $this->order_model->set_order();

                $this->load->view('templates/header');
                $this->load->view('order/success');
                $this->load->view('templates/footer');
            }
        }


}