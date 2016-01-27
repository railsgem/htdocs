<?php
class Postage_model extends CI_Model {
        public function __construct()
        {
                $this->load->database();
        }

		public function get_postage($postage_id = FALSE)
		{
		        if ($postage_id === FALSE)
		        {
					$query = $this->db->get('os_postage');
					return $query->result_array();
		        }
		        $query = $this->db->get_where('os_postage', array('postage_id' => $postage_id));
		        return $query->row_array();
		}

		public function get_postage_list($offset = 1,$per_page = 14,$is_total = FALSE,$is_echart= FALSE)
		{
			$from_date = $this->input->get('from_date');
			$to_date = $this->input->get('to_date');
			$myquery = 'SELECT  t.postage_id
								,t.postage_company_id
								,t.postage_date
								,t.postage_code
								,t.entry_time
								,t.update_time
						FROM os_postage t 
						WHERE 1=1
						';
			if ($from_date != '')
			{
				$myquery = $myquery.' and postage_rep_date >= \''.$from_date.'\'';
			}	
			if ($to_date != '')
			{
				$myquery = $myquery.' and postage_rep_date <= \''.$to_date.' 23:59:59\'';
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
		public function set_postage()
		{
		    $data = array(
		        'postage_company_id' => $this->input->post('postage_company_id'),
		        'postage_date' => $this->input->post('postage_date'),
		        'postage_code' => $this->input->post('postage_code')
		    );
 			return $this->db->insert('os_postage', $data);
		}

		public function update_postage($postage_id = FALSE)
		{
			if ($postage_id !== FALSE)
			{
			    $data = array(
			        'postage_company_id' => $this->input->post('postage_company_id'),
			        'postage_date' => $this->input->post('postage_date'),
			        'postage_code' => $this->input->post('postage_code')
			    );

			    $this->db->where('postage_id', $postage_id);
			    $this->db->update('os_postage', $data);
		    }
		}


		public function delete_postage($postage_id = FALSE)
		{
			if ($postage_id !== FALSE)
			{
			    $this->db->where('postage_id', $postage_id);
			    $this->db->delete('os_postage');
		    }
		}		


}