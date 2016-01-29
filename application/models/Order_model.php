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
			$myquery = "SELECT
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
								oad.recevier_nation_id,
								odr_pdt.product_list
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
							LEFT JOIN (select orp.order_id,REPLACE(group_concat(op.product_name,' * ',orp.quantity ),',','</br></br>')   product_list from os_order_product orp left join os_product OP
on orp.os_product_id = op.os_product_id group by orp.order_id ) odr_pdt on od_ag.order_id = odr_pdt.order_id
							WHERE
								1 = 1 
						";
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
		    $os_product_id = $this->input->post('recevier_name');
		    $quantity = $this->input->post('recevier_name');
		    $sell_price = $this->input->post('recevier_name');
			$myquery = "insert into os_order_agent (order_id, agent_id) values (".$order_id.",".$agent_id."  )";
			$query = $this->db->query($myquery);

			$myquery = "insert into os_order_address (order_id, address_id) values (".$order_id.",".$address_id."  )";
			$query = $this->db->query($myquery);

			$myquery = "insert into os_order_product (order_id, os_product_id, quantity, sell_price)
							 select ".$order_id.",  optmp.os_product_id, sum(optmp.quantity)quantity,  optmp.sell_price
							   from os_order_product_tmp optmp
							  group by optmp.os_product_id, optmp.sell_price
							   ";
			$query = $this->db->query($myquery);

			// empty the session cart
            $this->session->unset_userdata('product');
			$myquery = "delete from os_order_product_tmp";
			$query = $this->db->query($myquery);
 			return ;
		}

		public function set_order_cart_session()
		{
		    $product_item = array(
		        'os_product_id' => $this->input->post('os_product_id'),
		        'product_name' => $this->input->post('product_name'),
		        'chemist_price' => $this->input->post('chemist_price'),
		        'source_type' => $this->input->post('source_type'),
		        'quantity' => $this->input->post('quantity'),
		        'sell_price' => $this->input->post('sell_price')
		    );
			//1 . if there is no product key in session ,create a product key
		    if( $this->session->has_userdata('product')!=1) {
		    	$data = array();
	    		array_push($data, $product_item);
		    	$this->session->set_userdata('product', $data);
		    } else {
			    //2. if there has a product key in session , get the session value, store to a data array, append the new product item,unset the value then create a new product session 
		    	$data =  $this->session->product;

	    		array_push($data, $product_item);

				$this->session->unset_userdata('product');
		    	$this->session->set_userdata('product', $data);
		    }
			$myquery = "insert into os_order_product_tmp ( os_product_id, quantity, sell_price) 
						values (".$product_item['os_product_id'].",".$product_item['quantity'].",".$product_item['sell_price']."  )";
			$query = $this->db->query($myquery);
			//print_r($this->session->product);
			print_r(json_encode($product_item));

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