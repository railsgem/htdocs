<?php
class Address_model extends CI_Model {
        public function __construct()
        {
                $this->load->database();
				date_default_timezone_set('Australia/Sydney');
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
		public function get_next_agent_address_id()
		{
			$myquery = "SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES
							WHERE table_name = 'OS_AGENT_ADDRESS'";

			$query = $this->db->query($myquery);
			return $query->result_array();

		}

		public function get_address_by_agent_id($agent_id = FALSE)
		{
	        if ($agent_id !== FALSE)
	        {
	        	$myquery = 'SELECT
								agd.agent_address_id,
								agd.agent_id,
								adr.address_id,
								adr.address_detail,
								adr.phone,
								adr.recevier_name,
								adr.recevier_nation_id,
								adr.entry_time
							FROM
								os_agent_address agd
							LEFT JOIN os_address adr ON agd.address_id = adr.address_id
							WHERE
								1 = 1 and agd.agent_id = '.$agent_id.'
					';
				$query = $this->db->query($myquery);
				return $query->result_array();
	        }
		}

		public function get_address_list($offset = 1,$per_page = 14,$is_total = FALSE,$is_echart= FALSE)
		{
			$from_date = $this->input->get('from_date');
			$to_date = $this->input->get('to_date');
			$myquery = 'SELECT
								a.address_id,
								a.address_detail,
								a.phone,
								a.recevier_name,
								a.recevier_nation_id,
								a.entry_time,
								a.update_time,
								a.agent_id,
								b.consumer_name agent_name
							FROM
								(
									SELECT
										t1.address_id,
										t1.address_detail,
										t1.phone,
										t1.recevier_name,
										t1.recevier_nation_id,
										t1.update_time,
										t1.entry_time,
										t2.agent_id
									FROM
										os_address t1
									LEFT JOIN os_agent_address t2 ON t1.address_id = t2.address_id
								) a
							LEFT JOIN os_consumer b ON a.agent_id = b.consumer_id
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
				$myquery = $myquery.' order by agent_id asc ';
				$query = $this->db->query($myquery);
				return $query->result_array();
			}
			if ($is_total == TRUE)
			{
				//echo $myquery;
				$myquery = $myquery.' order by agent_id asc ';
				$query = $this->db->query($myquery);
				return $query->num_rows();
			}
			else
			{
				//echo $myquery;
				$myquery = $myquery.' order by agent_id desc limit '.$offset.', '.$per_page;
				$query = $this->db->query($myquery);
	            return $query->result_array();
            }

		}
		public function set_address()
		{	
			$today = date("Y-m-d H:i:s");
		    $data = array(
		        'address_detail' => $this->input->post('address_detail'),
		        'phone' => $this->input->post('phone'),
		        'recevier_name' => $this->input->post('recevier_name'),
		        'recevier_nation_id' => $this->input->post('recevier_nation_id'),
		        'entry_time' => $today,
		        'update_time' => $today
		    );
 			return $this->db->insert('os_address', $data);
		}

		public function update_address($address_id = FALSE, $order_id = FALSE)
		{
			$today = date("Y-m-d H:i:s");
			if ($address_id !== FALSE)
			{
			    $data = array(
			        'address_detail' => $this->input->post('address_detail'),
			        'phone' => $this->input->post('phone'),
			        'recevier_name' => $this->input->post('recevier_name'),
			        'recevier_nation_id' => $this->input->post('recevier_nation_id'),
			        'update_time' => $today
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

		public function delete_agent_address($agent_address_id = FALSE)
		{
			if ($agent_address_id !== FALSE)
			{
			    $this->db->where('agent_address_id', $agent_address_id);
			    $this->db->delete('os_agent_address');
		    }
		}		

		public function save_new_agent_address($agent_id = FALSE, $recevier_name = FALSE,$address_detail = FALSE,$phone = FALSE,$recevier_nation_id = FALSE)
		{
			$today = date("Y-m-d H:i:s");
        	if ($recevier_name !== "" AND $address_detail !== ""  AND $phone !== ""  AND $recevier_nation_id !== "" ) 
            {
		        $entry_time = $today;
		        $update_time = $today;

				// update os_address
				$myquery = " insert into os_address (address_detail, phone, recevier_name, recevier_nation_id, entry_time, update_time) values ( '".$address_detail."' , '".$phone."' , '".$recevier_name."' , '".$recevier_nation_id."' , '".$today."' , '".$today."' )";
				$this->db->query($myquery);

		    	$address_id = $this->db->insert_id();
				// update os_despatch
				$myquery = " insert into os_agent_address (agent_id, address_id, entry_time, update_time ) values ( '".$agent_id."' , '".$address_id."' , '".$today."' , '".$today."' )";
				$this->db->query($myquery);
		    	$agent_address_id = $this->db->insert_id();

		    	$myquery = "select * from os_agent_address t where t.agent_address_id =".$agent_address_id;
				$query = $this->db->query($myquery);
				return $query->row_array();
            }
		}

}