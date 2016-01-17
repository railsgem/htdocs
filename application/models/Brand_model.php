<?php
class Brand_model extends CI_Model {
        public function __construct()
        {
                $this->load->database();
        }
		public function get_brand($brand_id = FALSE)
		{
		        if ($brand_id === FALSE)
		        {
					$query = $this->db->get('os_brand');
					return $query->result_array();
		        }
		        $query = $this->db->get_where('os_brand', array('brand_id' => $brand_id));
		        return $query->row_array();
		}


		public function set_brand()
		{
		    $data = array(
		        'brand_name' => $this->input->post('brand_name'),
			    'is_valid' => $this->input->post('is_valid')
		    );
		    return $this->db->insert('os_brand', $data);
		}
		public function update_brand($brand_id = FALSE)
		{
			if ($brand_id !== FALSE)
			{
			    $data = array(
			        'brand_name' => $this->input->post('brand_name'),
			        'is_valid' => $this->input->post('is_valid')
			    );
			    $this->db->where('brand_id', $brand_id);
			    $this->db->update('os_brand', $data);


			    //return $this->db->insert_id();
		    }
		}
		public function delete_brand($brand_id = FALSE)
		{
			if ($brand_id !== FALSE)
			{

			    $this->db->where('brand_id', $brand_id);
			    $this->db->delete('os_brand');
		    }
		}			

}