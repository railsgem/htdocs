<?php
class Postage_model extends CI_Model {
        public function __construct()
        {
                $this->load->database();
				date_default_timezone_set('Australia/Sydney');
				$today = date("Y-m-d H:i:s");
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
			$myquery = 'select op.postage_id,op.postage_company_id,op.postage_date,op.postage_code,
							   op.entry_time,op.update_time,
							   opc.postage_company_name,opc.postage_website
						 from os_postage op left join os_postage_company opc 
						on op.postage_company_id = opc.postage_company_id
						where 1 = 1
						';
			if ($from_date != '')
			{
				$myquery = $myquery.' and op.postage_rep_date >= \''.$from_date.'\'';
			}	
			if ($to_date != '')
			{
				$myquery = $myquery.' and op.postage_rep_date <= \''.$to_date.' 23:59:59\'';
			}					
			
			if ($is_echart == TRUE)
			{
				//echo $myquery;
				$myquery = $myquery.' order by op.entry_time asc ';
				$query = $this->db->query($myquery);
				return $query->result_array();
			}
			if ($is_total == TRUE)
			{
				//echo $myquery;
				$myquery = $myquery.' order by op.entry_time asc ';
				$query = $this->db->query($myquery);
				return $query->num_rows();
			}
			else
			{
				//echo $myquery;
				$myquery = $myquery.' order by op.entry_time desc limit '.$offset.', '.$per_page;
				$query = $this->db->query($myquery);
	            return $query->result_array();
            }

		}
		public function set_postage()
		{
		    $data = array(
		        'postage_company_id' => $this->input->post('postage_company_id'),
		        'postage_date' => $this->input->post('postage_date'),
		        'postage_code' => $this->input->post('postage_code'),
		        'entry_time' => $today,
		        'update_time' => $today
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
			        'postage_code' => $this->input->post('postage_code'),
			        'postage_fee' => $this->input->post('postage_fee'),
			        'postage_weight' => $this->input->post('postage_weight'),
			        'remark' => $this->input->post('remark'),
		        	'update_time' => $today
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