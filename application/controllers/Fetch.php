<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fetch extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public function __construct()
    {
            parent::__construct();
            $this->load->model('product_model');
    }
	public function index()
	{    
        $this->load->helper('form');

        $this->load->view('templates/header');
		$this->load->view('fetch/index');
        $this->load->view('templates/footer');
		//$this->load->view('welcome_message');
	}
	public function fetch()
	{
        $this->load->helper('form');

        $data['update_success'] ='Fetch Successfully.';
	    $data['category_address'] = $this->input->post('category_address'); 
		$this->load->view('fetch/fetch',$data);
	}
	public function save_fetch()
	{
        $this->load->helper('form');

        $data['update_success'] ='Save Successfully.';
		$this->product_model->save_fetch_product();
		//$product_json = $data['product']
        //$this->product_model->save_fetch_product($data['product']);
	    //print_r( $data);
	    //exit;

		$this->load->view('fetch/save_fetch',$data);
	}
}
