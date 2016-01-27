<?php
class Postage_company_model extends CI_Model {
        public function __construct()
        {
                $this->load->database();
        }

		public function get_postage_company($postage_company_id = FALSE)
		{
		        if ($postage_company_id === FALSE)
		        {
					$query = $this->db->get('os_postage_company');
					return $query->result_array();
		        }
		        $query = $this->db->get_where('os_postage_company', array('postage_company_id' => $postage_company_id));
		        return $query->row_array();
		}

		public function get_postage_company_list($offset = 1,$per_page = 14,$is_total = FALSE,$is_echart= FALSE)
		{
			$from_date = $this->input->get('from_date');
			$to_date = $this->input->get('to_date');
			$myquery = 'SELECT  t.postage_company_id
								,t.postage_company_name
								,t.postage_website
								,t.entry_time
								,t.update_time
						FROM os_postage_company t 
						WHERE 1=1
						';
			if ($from_date != '')
			{
				$myquery = $myquery.' and postage_company_rep_date >= \''.$from_date.'\'';
			}	
			if ($to_date != '')
			{
				$myquery = $myquery.' and postage_company_rep_date <= \''.$to_date.' 23:59:59\'';
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
				if($per_page === null){

					$myquery = $myquery.' order by entry_time desc  ';

					$query = $this->db->query($myquery);
		            return $query->result_array();
				}
				//echo $myquery;
				$myquery = $myquery.' order by entry_time desc limit '.$offset.', '.$per_page;

				$query = $this->db->query($myquery);
	            return $query->result_array();
            }

		}
		public function set_postage_company()
		{
		    $data = array(
		        'postage_company_name' => $this->input->post('postage_company_name'),
		        'postage_website' => $this->input->post('postage_website')
		    );
 			return $this->db->insert('os_postage_company', $data);
		}

		public function update_postage_company($postage_company_id = FALSE)
		{
			if ($postage_company_id !== FALSE)
			{
			    $data = array(
			        'postage_company_name' => $this->input->post('postage_company_name'),
			        'postage_website' => $this->input->post('postage_website')
			    );

			    $this->db->where('postage_company_id', $postage_company_id);
			    $this->db->update('os_postage_company', $data);
		    }
		}


		public function delete_postage_company($postage_company_id = FALSE)
		{
			if ($postage_company_id !== FALSE)
			{
			    $this->db->where('postage_company_id', $postage_company_id);
			    $this->db->delete('os_postage_company');
		    }
		}		


}