<?php
class Order_model extends CI_Model {
        public function __construct()
        {
                $this->load->database();
        }

		public function get_order($rowid = FALSE)
		{
		        if ($rowid === FALSE)
		        {
					$myquery = 'select  op.rowid
								,op.order_id
								,op.os_product_id
								,opd.product_name
								,opd.chemist_price
								,op.sell_price
								,op.entry_time
								,op.update_time
						 from os_order op left join os_product opd on op.os_product_id = opd.os_product_id
						where 1 = 1
						';
		        }
				$myquery = 'select  op.rowid
							,op.order_id
							,op.os_product_id
							,opd.product_name
							,opd.chemist_price
							,op.sell_price
							,op.entry_time
							,op.update_time
					 from os_order op left join os_product opd on op.os_product_id = opd.os_product_id
					where 1 = 1 and op.rowid = '.$rowid;
				$query = $this->db->query($myquery);
				return $query->row_array();
		}

		public function get_order_list($offset = 1,$per_page = 14,$is_total = FALSE,$is_echart= FALSE)
		{
			$from_date = $this->input->get('from_date');
			$to_date = $this->input->get('to_date');
			$myquery = 'select  op.rowid
								,op.order_id
								,op.os_product_id
								,opd.product_name
								,opd.chemist_price
								,op.sell_price
								,op.entry_time
								,op.update_time
						 from os_order op left join os_product opd on op.os_product_id = opd.os_product_id
						where 1 = 1
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
		public function set_order()
		{
		    $data = array(
		        'order_id' => $this->input->post('order_id'),
		        'os_product_id' => $this->input->post('os_product_id'),
		        'sell_price' => $this->input->post('sell_price')
		    );
 			return $this->db->insert('os_order', $data);
		}

		public function update_order($rowid = FALSE)
		{
			if ($rowid !== FALSE)
			{
			    $data = array(
			        //'order_id' => $this->input->post('order_id'),
			        'os_product_id' => $this->input->post('os_product_id'),
			        'sell_price' => $this->input->post('sell_price')
			    );

			    $this->db->where('rowid', $rowid);
			    $this->db->update('os_order', $data);
		    }
		}


		public function delete_order($rowid = FALSE)
		{
			if ($rowid !== FALSE)
			{
			    $this->db->where('rowid', $rowid);
			    $this->db->delete('os_order');
		    }
		}		


}