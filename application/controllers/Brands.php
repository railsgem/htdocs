<?php
class Brands extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('brands_model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $data['brands'] = $this->brands_model->get_brands();

        $data['title'] = 'Brands archive';

        $this->load->view('templates/header', $data);
        $this->load->view('brands/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($brand_id = NULL)
    {
        $data['brands_item'] = $this->brands_model->get_brands($brand_id);
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a brand item';

        $this->form_validation->set_rules('brand_name', 'brand name', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('brands/create');
            $this->load->view('templates/footer');

        }
        else
        {
            $this->brands_model->set_brands();
            $this->load->view('brands/success');
        }
    }
}