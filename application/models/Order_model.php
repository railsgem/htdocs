<?php
class Order_model extends CI_Model {
        public function __construct()
        {
                $this->load->database();
        }

		public function get_order($order_id = FALSE)
		{
		        if ($order_id === FALSE)
		        {
					$myquery = 'select  op.order_id
								,op.order_code
								,op.entry_time
								,op.update_time
						 from os_order op 
						';
		        }
				$myquery = 'select  op.order_id
								,op.order_code
								,op.entry_time
								,op.update_time
					 from os_order op 
					where 1 = 1 and op.order_id = '.$order_id;
				$query = $this->db->query($myquery);
				return $query->row_array();
		}

		public function get_order_list($offset = 1,$per_page = 14,$is_total = FALSE,$is_echart= FALSE)
		{
			$from_date = $this->input->get('from_date');
			$to_date = $this->input->get('to_date');
			$myquery = 'SELECT
								od_ag.order_id,
								od_ag.order_code,
								od_ag.entry_time,
								od_ag.update_time,
								od_ag.agent_id,
								ocs.consumer_name agent_name,
								od_ag.address_id,
								oad.address_detail,
								oad.phone,
								oad.recevier_name,
								oad.recevier_nation_id
							FROM
								(
									SELECT
										op.order_id,
										op.order_code,
										op.entry_time,
										op.update_time,
										oag.agent_id,
										odr_ad.order_address_id,
										odr_ad.address_id
									FROM
										os_order op
									LEFT JOIN os_order_agent oag ON op.order_id = oag.order_id
									LEFT JOIN os_order_address odr_ad ON op.order_id = odr_ad.order_id
								) od_ag
							LEFT JOIN os_consumer ocs ON od_ag.agent_id = ocs.consumer_id
							LEFT JOIN os_address oad ON od_ag.address_id = oad.address_id
							WHERE
								1 = 1
						';
			if ($from_date != '')
			{
				$myquery = $myquery.' and op.order_rep_date >= \''.$from_date.'\'';
			}	
			if ($to_date != '')
			{
				$myquery = $myquery.' and op.order_rep_date <= \''.$to_date.' 23:59:59\'';
			}					
			
			if ($is_echart == TRUE)
			{
				//echo $myquery;
				$myquery = $myquery.' order by od_ag.entry_time asc ';
				$query = $this->db->query($myquery);
				return $query->result_array();
			}
			if ($is_total == TRUE)
			{
				//echo $myquery;
				$myquery = $myquery.' order by od_ag.entry_time asc ';
				$query = $this->db->query($myquery);
				return $query->num_rows();
			}
			else
			{
				//echo $myquery;
				$myquery = $myquery.' order by od_ag.entry_time desc limit '.$offset.', '.$per_page;
				$query = $this->db->query($myquery);
	            return $query->result_array();
            }

		}
		public function set_order()
		{
		    $data = array(
		        'order_code' => $this->input->post('order_code')
		    );
		    $this->db->insert('os_order', $data);

		    $order_id = $this->db->insert_id();
		    $agent_id = $this->input->post('consumer_id');
		    $address_id = $this->input->post('recevier_name');
			$myquery = "insert into os_order_agent (order_id, agent_id) values (".$order_id.",".$agent_id."  )";
			$query = $this->db->query($myquery);

			$myquery = "insert into os_order_address (order_id, address_id) values (".$order_id.",".$address_id."  )";
			$query = $this->db->query($myquery);
 			return ;
		}

		public function update_order($order_id = FALSE)
		{
			if ($order_id !== FALSE)
			{
			    $data = array(
			        'order_id' => $this->input->post('order_id'),
			        'order_code' => $this->input->post('order_code')
			    );

			    $this->db->where('order_id', $order_id);
			    $this->db->update('os_order', $data);
		    }
		}


		public function delete_order($order_id = FALSE)
		{
			if ($order_id !== FALSE)
			{
			    $this->db->where('order_id', $order_id);
			    $this->db->delete('os_order');
		    }
		}		


}