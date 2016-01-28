<?php
class Consumer_model extends CI_Model {
        public function __construct()
        {
                $this->load->database();
        }

		public function get_consumer($consumer_id = FALSE)
		{
		        if ($consumer_id === FALSE)
		        {
					$query = $this->db->get('os_consumer');
					return $query->result_array();
		        }
		        $query = $this->db->get_where('os_consumer', array('consumer_id' => $consumer_id));
		        return $query->row_array();
		}

		public function get_consumer_by_id($consumer_id = "")
		{
	        if ($consumer_id !== FALSE)
	        {
				$consumer_id = $this->input->post('consumer_id');
				$myquery = "SELECT  t.consumer_id
								,t.consumer_name
								,t.consumer_nation_id
								,t.consumer_address
								,t.consumer_phone
								,t.consumer_postcode
								,t.entry_time
								,t.is_agent 
								,t.agent_name_code 
						FROM os_consumer t 
						WHERE 1=1 and consumer_id= ".$consumer_id." ";
				$query = $this->db->query($myquery);	
	        	return $query->result_array();
	        }

		}
		public function get_agent()
		{
			$myquery = 'SELECT  t.consumer_id
								,t.consumer_name
								,t.consumer_nation_id
								,t.consumer_address
								,t.consumer_phone
								,t.consumer_postcode
								,t.entry_time
								,t.is_agent 
								,t.agent_name_code 
						FROM os_consumer t 
						WHERE 1=1 and is_agent= 1
						';
	        $query = $this->db->query($myquery);
            return $query->result_array();
		}

		public function get_consumer_list($offset = 1,$per_page = 14,$is_total = FALSE,$is_echart= FALSE)
		{
			$from_date = $this->input->get('from_date');
			$to_date = $this->input->get('to_date');
			$myquery = 'SELECT  t.consumer_id
								,t.consumer_name
								,t.consumer_nation_id
								,t.consumer_address
								,t.consumer_phone
								,t.consumer_postcode
								,t.entry_time
								,t.is_agent 
						FROM os_consumer t 
						WHERE 1=1
						';
			if ($from_date != '')
			{
				$myquery = $myquery.' and consumer_rep_date >= \''.$from_date.'\'';
			}	
			if ($to_date != '')
			{
				$myquery = $myquery.' and consumer_rep_date <= \''.$to_date.' 23:59:59\'';
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
		public function set_consumer()
		{
		    $data = array(
		        'consumer_name' => $this->input->post('consumer_name'),
		        'consumer_nation_id' => $this->input->post('consumer_nation_id'),
		        'consumer_address' => $this->input->post('consumer_address'),
		        'consumer_phone' => $this->input->post('consumer_phone'),
		        'consumer_postcode' => $this->input->post('consumer_postcode'),
		        'is_agent' => $this->input->post('is_agent')
		    );
 			return $this->db->insert('os_consumer', $data);
		}

		public function update_consumer($consumer_id = FALSE)
		{
			if ($consumer_id !== FALSE)
			{
			    $data = array(
			        'consumer_name' => $this->input->post('consumer_name'),
			        'consumer_nation_id' => $this->input->post('consumer_nation_id'),
			        'consumer_address' => $this->input->post('consumer_address'),
			        'consumer_phone' => $this->input->post('consumer_phone'),
			        'consumer_postcode' => $this->input->post('consumer_postcode'),
			        'is_agent' => $this->input->post('is_agent')
			    );

			    $this->db->where('consumer_id', $consumer_id);
			    $this->db->update('os_consumer', $data);
		    }
		}


		public function delete_consumer($consumer_id = FALSE)
		{
			if ($consumer_id !== FALSE)
			{
			    $this->db->where('consumer_id', $consumer_id);
			    $this->db->delete('os_consumer');
		    }
		}		


}