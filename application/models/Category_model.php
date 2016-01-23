<?php
class Category_model extends CI_Model {
        public function __construct()
        {
                $this->load->database();
        }
		public function get_category($category_id = FALSE)
		{
		        if ($category_id === FALSE)
		        {
					$query = $this->db->get('os_category');
					return $query->result_array();
		        }
		        $query = $this->db->get_where('os_category', array('category_id' => $category_id));
		        return $query->row_array();
		}
		public function set_category()
		{
		    $data = array(
		        'category_name' => $this->input->post('category_name'),
			    'is_valid' => $this->input->post('is_valid')
		    );
		    return $this->db->insert('os_category', $data);
		}
		public function update_category($category_id = FALSE)
		{
			if ($category_id !== FALSE)
			{
			    $data = array(
			        'category_name' => $this->input->post('category_name'),
			    	'is_valid' => $this->input->post('is_valid')
			    );
			    $this->db->where('category_id', $category_id);
			    $this->db->update('os_category', $data);


			    //return $this->db->insert_id();
		    }
		}
		public function delete_category($category_id = FALSE)
		{
			if ($category_id !== FALSE)
			{

			    $this->db->where('category_id', $category_id);
			    $this->db->delete('os_category');
		    }
		}				
}