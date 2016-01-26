<?php
class Consumer extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('consumer_model');
                //$this->load->library('ion_auth');
                //if (!$this->ion_auth->logged_in())
                //{
                 //   redirect('auth/login');
                //}                
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
                $this->form_validation->set_rules('consumer_rep_date', 'consumer 日期   ', 'required|xss_clean');
                $this->form_validation->set_rules('print_total', '打单区AT 打单总数量 ', 'required|integer');
                $this->form_validation->set_rules('print_error', '打单区AT 错单数量  ', 'required|integer');
                $this->form_validation->set_rules('print_total_app', '打单区APP 总数量 ', 'required|integer');
                $this->form_validation->set_rules('print_error_app', '打单区APP 错单数量  ', 'required|integer');
                $this->form_validation->set_rules('delivery_scan_total', '总扫单数量 ', 'required|integer');
                $this->form_validation->set_rules('delivery_express_receive', '快递收包裹量   ', 'required|integer');
                $this->form_validation->set_rules('delivery_missed', '漏发单量  ', 'required|integer');
                $this->form_validation->set_rules('delivery_error', '错发单量   ', 'required|integer');
                $this->form_validation->set_rules('picking_total', '总配货商品数量  ', 'required|integer');
                $this->form_validation->set_rules('picking_missed', '漏配商品数量 ', 'required|integer');
                $this->form_validation->set_rules('picking_error', '错配商品数量', 'required|integer');
                $this->form_validation->set_rules('operator', '操作员', 'trim|required|xss_clean');


                if ($this->form_validation->run() === FALSE)
                {
                    $data['update_success'] ='';
                    $data['consumer'] = $this->consumer_model->get_consumer($consumer_id);
                    $data['consumer_update_history'] = $this->consumer_model->get_consumer_update_history($consumer_id);
                    $this->load->view('templates/header');
                    $this->load->view('consumer/edit',$data);
                    $this->load->view('templates/footer');
                }
                else
                {
                    $this->consumer_model->update_consumer($consumer_id);

                    $data['consumer'] = $this->consumer_model->get_consumer($consumer_id);
                    $data['consumer_update_history'] = $this->consumer_model->get_consumer_update_history($consumer_id);

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


            //$this->form_validation->set_rules('consumer_name', 'consumer Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('consumer_rep_date', 'consumer 日期   ', 'required|xss_clean');
            $this->form_validation->set_rules('print_total', '打单区AT 打单总数量 ', 'required|integer');
            $this->form_validation->set_rules('print_error', '打单区AT 错单数量  ', 'required|integer');
            $this->form_validation->set_rules('print_total_app', '打单区APP 总数量 ', 'required|integer');
            $this->form_validation->set_rules('print_error_app', '打单区APP 错单数量  ', 'required|integer');
            $this->form_validation->set_rules('delivery_scan_total', '总扫单数量 ', 'required|integer');
            $this->form_validation->set_rules('delivery_express_receive', '快递收包裹量   ', 'required|integer');
            $this->form_validation->set_rules('delivery_missed', '漏发单量  ', 'required|integer');
            $this->form_validation->set_rules('delivery_error', '错发单量   ', 'required|integer');
            $this->form_validation->set_rules('picking_total', '总配货商品数量  ', 'required|integer');
            $this->form_validation->set_rules('picking_missed', '漏配商品数量 ', 'required|integer');
            $this->form_validation->set_rules('picking_error', '错配商品数量', 'required|integer');
            $this->form_validation->set_rules('operator', '操作员', 'trim|required|xss_clean');
            
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