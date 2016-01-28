<?php
class Address_model extends CI_Model {
        public function __construct()
        {
                $this->load->database();
        }

		public function get_address($address_id = FALSE)
		{
		        if ($address_id === FALSE)
		        {
					$query = $this->db->get('os_address');
					return $query->result_array();
		        }
		        $query = $this->db->get_where('os_address', array('address_id' => $address_id));
		        return $query->row_array();
		}

		public function get_address_list($offset = 1,$per_page = 14,$is_total = FALSE,$is_echart= FALSE)
		{
			$from_date = $this->input->get('from_date');
			$to_date = $this->input->get('to_date');
			$myquery = 'SELECT  t.address_id
								,t.address_detail
								,t.phone
								,t.recevier_name
								,t.recevier_nation_id
								,t.entry_time
								,t.update_time
						FROM os_address t 
						WHERE 1=1
						';
			if ($from_date != '')
			{
				$myquery = $myquery.' and address_rep_date >= \''.$from_date.'\'';
			}	
			if ($to_date != '')
			{
				$myquery = $myquery.' and address_rep_date <= \''.$to_date.' 23:59:59\'';
			}					
			
			if ($is_echart == TRUE)
			{
				//echo $myquery;
				$myquery = $myquery.' order by entry_time asc ';
				$query = $this->db->query($myquery);
				return $query->result_array();
			}
			if ($is_total == TRUE)
			{
				//echo $myquery;
				$myquery = $myquery.' order by entry_time asc ';
				$query = $this->db->query($myquery);
				return $query->num_rows();
			}
			else
			{
				//echo $myquery;
				$myquery = $myquery.' order by entry_time desc limit '.$offset.', '.$per_page;
				$query = $this->db->query($myquery);
	            return $query->result_array();
            }

		}
		public function set_address()
		{
		    $data = array(
		        'address_detail' => $this->input->post('address_detail'),
		        'phone' => $this->input->post('phone'),
		        'recevier_name' => $this->input->post('recevier_name'),
		        'recevier_nation_id' => $this->input->post('recevier_nation_id')
		    );
 			return $this->db->insert('os_address', $data);
		}

		public function update_address($address_id = FALSE)
		{
			if ($address_id !== FALSE)
			{
			    $data = array(
		        'address_detail' => $this->input->post('address_detail'),
		        'phone' => $this->input->post('phone'),
		        'recevier_name' => $this->input->post('recevier_name'),
		        'recevier_nation_id' => $this->input->post('recevier_nation_id')
			    );

			    $this->db->where('address_id', $address_id);
			    $this->db->update('os_address', $data);
		    }
		}


		public function delete_address($address_id = FALSE)
		{
			if ($address_id !== FALSE)
			{
			    $this->db->where('address_id', $address_id);
			    $this->db->delete('os_address');
		    }
		}		


}