<?php
class Brands_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_brands($brand_id = FALSE)
	{
	    if ($brand_id === FALSE)
	    {
	        $query = $this->db->get('ot_brand');
	        return $query->result_array();
	    }

	    $query = $this->db->get_where('ot_brand', array('brand_id' => $brand_id));
	    return $query->row_array();
	}

	public function set_brands()
	{
	    $this->load->helper('url');

	    $slug = url_title($this->input->post('brand_name'), 'dash', TRUE);

	    $data = array(
	        'brand_name' => $this->input->post('brand_name')
	    );

	    return $this->db->insert('ot_brand', $data);
	}
}