<?php
class Order_model extends CI_Model {
        public function __construct()
        {
                $this->load->database();
				date_default_timezone_set('Australia/Sydney');
				$today = date("Y-m-d H:i:s");
        }

		public function get_order($order_id = FALSE)
		{
				$myquery = 'SELECT
								od_ag.order_id,
								od_ag.order_code,
								od_ag.active,
								od_ag.post_flag,
								od_ag.entry_time,
								od_ag.update_time,
								od_ag.agent_id,
								ocs.consumer_name agent_name,
								od_ag.address_id,
								od_ag.address_detail,
								od_ag.phone,
								od_ag.recevier_name,
								od_ag.remark,
								od_ag.recevier_nation_id
							FROM
								(
									SELECT
										op.order_id,
										op.order_code,
										op.active,
										op.post_flag,
										op.entry_time,
										op.update_time,
										op.address_detail,
										op.phone,
										op.recevier_name,
										op.recevier_nation_id,
										op.remark,
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
								1 = 1 and od_ag.order_id = '.$order_id;
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
								od_ag.active,
								od_ag.post_flag,
								od_ag.despatch_flag,
								od_ag.settle_flag,
								od_ag.entry_time,
								od_ag.update_time,
								od_ag.agent_id,
								ocs.consumer_name agent_name,
								od_ag.address_id,
								od_ag.address_detail,
								od_ag.phone,
								od_ag.recevier_name,
								od_ag.recevier_nation_id,
								od_ag.remark,
								odr_pdt.product_list
							FROM
								(
									SELECT
										op.order_id,
										op.order_code,
										op.active,
										op.post_flag,
										op.despatch_flag,
										op.settle_flag,
										op.entry_time,
										op.update_time,
										op.address_detail,
										op.phone,
										op.recevier_name,
										op.recevier_nation_id,
										op.remark,
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
							LEFT JOIN (select orp.order_id,REPLACE(group_concat(op.product_name,' * ',orp.quantity ),',','</br></br>')   product_list from os_order_product orp left join os_product op
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
			$today = date("Y-m-d H:i:s");
			$select_agent_address_id = $this->input->post('select_agent_address_id');

			$myquery = "select oa.address_id,
							   oa.address_detail,
							   oa.phone,
							   oa.recevier_name,
							   oa.recevier_nation_id
						  from os_agent_address ag left join os_address oa on ag.address_id = oa.address_id
						 where ag.agent_address_id =".$select_agent_address_id;
			$query = $this->db->query($myquery);
            $address = $query->row_array();

		    $data = array(
		        'order_code' => $this->input->post('order_code'),
		        'address_detail' => $address['address_detail'],
		        'phone' => $address['phone'],
		        'recevier_name' => $address['recevier_name'],
		        'recevier_nation_id' => $address['recevier_nation_id'],
				'remark' => $this->input->post('remark'),
		        'entry_time' => $today,
		        'update_time' => $today
		    );
		    $this->db->insert('os_order', $data);

		    $order_id = $this->db->insert_id();
		    $agent_id = $this->input->post('consumer_id');
		    $address_id = $address['address_id'];
		    /*$os_product_id = $this->input->post('recevier_name');
		    $quantity = $this->input->post('recevier_name');
		    $sell_price = $this->input->post('recevier_name');*/

			$myquery = "insert into os_order_agent (order_id, agent_id ,entry_time ,update_time) values (".$order_id.",".$agent_id.",'".$today."','".$today."' )";
			$query = $this->db->query($myquery);

			$myquery = "insert into os_order_address (order_id, address_id,entry_time ,update_time) values (".$order_id.",".$address_id.",'".$today."','".$today."' )";
			$query = $this->db->query($myquery);

			$myquery = "insert into os_order_product (order_id, os_product_id, quantity, sell_price,entry_time ,update_time)
							 select ".$order_id.",  optmp.os_product_id, sum(optmp.quantity)quantity,  optmp.sell_price".",'".$today."','".$today.
							   "' from os_order_product_tmp optmp
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
			$today = date("Y-m-d H:i:s");
		    $product_item = array(
		        'os_product_id' => $this->input->post('os_product_id'),
		        'product_name' => $this->input->post('product_name'),
		        'chemist_price' => $this->input->post('chemist_price'),
		        'source_type' => $this->input->post('source_type'),
		        'quantity' => $this->input->post('quantity'),
		        'sell_price' => $this->input->post('sell_price'),
		        'entry_time' => $today,
		        'update_time' => $today
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
			$myquery = "insert into os_order_product_tmp ( os_product_id, quantity, sell_price,entry_time ,update_time) 
						values (".$product_item['os_product_id'].",".$product_item['quantity'].",".$product_item['sell_price'].",'".$today."','".$today."'  )";
			$query = $this->db->query($myquery);
			//print_r($this->session->product);
			print_r(json_encode($product_item));

 			return ;
		}

		public function add_product_to_cart()
		{
			$today = date("Y-m-d H:i:s");
		    $product_item = array(
		        'os_product_id' => $this->input->post('os_product_id'),
		        'product_name' => $this->input->post('product_name'),
		        'chemist_price' => $this->input->post('chemist_price'),
		        'source_type' => $this->input->post('source_type'),
		        'quantity' => $this->input->post('quantity'),
		        'sell_price' => $this->input->post('sell_price'),
		        'order_id' => $this->input->post('order_id'),
		        'entry_time' => $today,
		        'update_time' => $today
		    );
		    if ( trim($this->input->post('order_id')) != ''){
		    //if ( empty($this->input->post('order_id') ) != 1 ){
				$myquery = "insert into os_order_product_tmp ( order_id, os_product_id, quantity, sell_price,entry_time ,update_time) 
							values (".$product_item['order_id'].",".$product_item['os_product_id'].",".$product_item['quantity'].",".$product_item['sell_price'].",'".$today."','".$today."'  )";
		    } else {
				$myquery = "insert into os_order_product_tmp (  os_product_id, quantity, sell_price,entry_time ,update_time) 
							values (".$product_item['os_product_id'].",".$product_item['quantity'].",".$product_item['sell_price'].",'".$today."','".$today."'  )";
		    }
			$query = $this->db->query($myquery);

 			return $query;
		}
		public function get_cart_product()
		{
			$myquery = "select otmp.order_product_id,otmp.os_product_id, otmp.quantity, otmp.sell_price , op.product_name
							, op.chemist_price , op.source_type
						  from os_order_product_tmp otmp left join os_product op
						  on otmp.os_product_id = op.os_product_id " ;
			$this->db->query($myquery);
			$query = $this->db->query($myquery);
	        return $query->result_array();
		}

		public function order_product_list($order_id = FALSE)
		{
			if ($order_id !== FALSE)
			{
				$myquery = "select otmp.order_id,otmp.order_product_id,otmp.os_product_id, otmp.quantity, otmp.sell_price , op.product_name
								, op.chemist_price , op.source_type
							  from os_order_product otmp left join os_product op
							  on otmp.os_product_id = op.os_product_id 
							  where otmp.order_id =".$order_id  ;
				$this->db->query($myquery);
				$query = $this->db->query($myquery);
            
		        return $query->result_array();
		    }
		}

		public function update_order($order_id = FALSE)
		{
			$today = date("Y-m-d H:i:s");
			if ($order_id !== FALSE)
			{
				$select_agent_address_id = $this->input->post('post_address_id');

				$myquery = "select oa.address_id,
								   oa.address_detail,
								   oa.phone,
								   oa.recevier_name,
								   oa.recevier_nation_id
							  from os_agent_address ag left join os_address oa on ag.address_id = oa.address_id
							 where ag.address_id =".$select_agent_address_id;
				$query = $this->db->query($myquery);
	            $address = $query->row_array();

			    $data = array(
			        'address_detail' => $address['address_detail'],
			        'phone' => $address['phone'],
			        'recevier_name' => $address['recevier_name'],
			        'recevier_nation_id' => $address['recevier_nation_id'],
					'remark' => $this->input->post('remark'),
			        'update_time' => $today
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
		public function delete_cart_product($order_product_id = FALSE)
		{
			$order_product_id = $this->input->post('order_product_id');
			if ($order_product_id !== FALSE)
			{
			    $this->db->where('order_product_id', $order_product_id);
			    $this->db->delete('os_order_product_tmp');
		    }
		}		
		public function edit_order_product($order_product_id = FALSE)
		{
			$today = date("Y-m-d H:i:s");
			$order_product_id = $this->input->post('order_product_id');

			if ($order_product_id !== FALSE)
			{
			    $data = array(
					'quantity' => $this->input->post('quantity'),
					'sell_price' => $this->input->post('sell_price'),
			        'update_time' => $today
			    );
			    
			    $this->db->where('order_product_id', $order_product_id);
			    $this->db->update('os_order_product', $data);
		    }
		}		
		public function delete_order_product($order_product_id = FALSE)
		{
			$order_product_id = $this->input->post('order_product_id');
			if ($order_product_id !== FALSE)
			{
			    $this->db->where('order_product_id', $order_product_id);
			    $this->db->delete('os_order_product');
		    }
		}		

		public function add_order_product()
		{
			$today = date("Y-m-d H:i:s");
		    $product_item = array(
		        'os_product_id' => $this->input->post('os_product_id'),
		        'product_name' => $this->input->post('product_name'),
		        'chemist_price' => $this->input->post('chemist_price'),
		        'source_type' => $this->input->post('source_type'),
		        'quantity' => $this->input->post('quantity'),
		        'sell_price' => $this->input->post('sell_price'),
		        'order_id' => $this->input->post('order_id'),
		        'entry_time' => $today,
		        'update_time' => $today
		    );
			$myquery = "insert into os_order_product ( order_id, os_product_id, quantity, sell_price ,entry_time ,update_time) 
						values (".$product_item['order_id'].",".$product_item['os_product_id'].",".$product_item['quantity'].",".$product_item['sell_price'].",'".$today."','".$today."'  )";
			$query = $this->db->query($myquery);

 			return $query;
		}

		public function deactivate($order_id)
		{
			$myquery = "update os_order set active= 0 where order_id= ".$order_id ;
			$query = $this->db->query($myquery);
 			return ;
		}

		public function activate($order_id)
		{
			$myquery = "update os_order set active= 1 where order_id= ".$order_id ;
			$query = $this->db->query($myquery);
 			return ;
		}
		public function set_postage($order_id)
		{

			$today = date("Y-m-d H:i:s");
		    $data = array(
		        'postage_company_id' => $this->input->post('postage_company_id'),
		        'postage_date' => $this->input->post('postage_date'),
		        'postage_code' => $this->input->post('postage_code'),
		        'postage_fee' => $this->input->post('postage_fee'),
		        'postage_weight' => $this->input->post('postage_weight'),
		        'postage_free' => $this->input->post('postage_free'),
		        'remark' => $this->input->post('remark'),
		        'entry_time' => $today,
		        'update_time' => $today
		    );
 			$this->db->insert('os_postage', $data);
		    $postage_id = $this->db->insert_id();

			$myquery = "insert into os_order_postage (order_id, postage_id ,entry_time ,update_time) values (".$order_id .",".$postage_id.",'".$today."','".$today."'  )";
			$query = $this->db->query($myquery);
			$myquery = "update os_order set post_flag = 1 where order_id= ".$order_id ;
			$query = $this->db->query($myquery);
			return;
		}
		public function get_order_postage_list($order_id)
		{

			if ($order_id !== FALSE)
			{
				$myquery = 'select op.postage_id,op.postage_company_id,op.postage_date,op.postage_code,
								   op.postage_fee,op.postage_free,op.postage_weight,op.remark,
								   op.entry_time,op.update_time,
								   opc.postage_company_name,opc.postage_website
							 from os_postage op left join os_postage_company opc 
							on op.postage_company_id = opc.postage_company_id
							where 1 = 1  and op.postage_id 
							in (select opst.postage_id from os_order_postage opst where opst.order_id='.$order_id.')';

				$this->db->query($myquery);
				$query = $this->db->query($myquery);
            
		        return $query->result_array();
		    }
		}
		public function auto_despatch()
		{
			$today = date("Y-m-d H:i:s");
			$order_id = $this->input->post('order_id');

			if($order_id !== FALSE) {
				$stock_available_myquery = "SELECT
								t1.order_id,
								t1.os_product_id,
								t1.quantity,
								t1.sell_price,
								t2.stock_present_num
							FROM
								os_order_product t1
							LEFT JOIN (
								SELECT
									t2.os_product_id,
									sum(t2.stock_present_num) stock_present_num
								FROM
									os_stock_entry t2
								GROUP BY
									t2.os_product_id
							) t2 ON t1.os_product_id = t2.os_product_id
							WHERE
								t1.order_id =".$order_id."
							AND t1.quantity > IFNULL(t2.stock_present_num, 0)" ;

				$query = $this->db->query($stock_available_myquery);
				$is_stock_available = $query->num_rows();

				if( $is_stock_available > 0 ) {
					echo "not enought values";
				} else {
					echo "stock available";
					$myquery = "update os_order set despatch_flag =1 where order_id= ".$order_id ;
					$query = $this->db->query($myquery);
					// count despatched number
					$despatch_balance_myquery = "SELECT
								  a.order_id,
								  a.os_product_id,
								  a.quantity,
								  IFNULL(b.despatch_num,0) despatch_num,
								  (a.quantity - IFNULL(b.despatch_num,0)) order_quantity_valiance
								FROM
								  (
								  SELECT
								    t3.order_id,
								    t3.os_product_id,
								    SUM(t3.quantity) quantity
								  FROM
								    os_order_product t3
								  WHERE
								    t3.order_id = ".$order_id."
								  GROUP BY
								    t3.order_id,
								    t3.os_product_id
								) a
								LEFT JOIN
								  (
								  SELECT
								    t3.os_product_id,
								    SUM(t3.despatch_num) despatch_num
								  FROM
								    os_despatch t3
								  WHERE
								    t3.order_id = ".$order_id."
								  GROUP BY
								    t3.os_product_id
								) b ON a.os_product_id = b.os_product_id
								WHERE
								  1 = 1 AND a.quantity > IFNULL(b.despatch_num,
								  0)";
					$query = $this->db->query($despatch_balance_myquery);
					$despatch_product = $query->result_array();
					$is_despatch_balance = $query->num_rows();

					while($is_despatch_balance) {

print_r($is_despatch_balance);
						$query = $this->db->query($despatch_balance_myquery);
						$despatch_product = $query->result_array();
						$is_despatch_balance = $query->num_rows();
						$product_id = $despatch_product[0]['os_product_id'];
						$order_quantity_valiance = $despatch_product[0]['order_quantity_valiance'];

						// pick up stock order by expire date
						$stock_myquery = "SELECT
									  t1.order_id,
									  t1.quantity,
									  t1.os_product_id,
									  t2.stock_id,
									  t2.stock_entry_num,
									  t2.stock_despatch_num,
									  t2.stock_present_num,
									  t2.expire_date
									FROM
									  os_order_product t1
									LEFT JOIN
									  os_stock_entry t2 ON t1.os_product_id = t2.os_product_id
									WHERE 1=1 and t2.stock_present_num > 0 and 
									  t1.order_id =".$order_id." and t2.os_product_id=".$product_id."
									  order by t2.expire_date asc
									  ";

						$query = $this->db->query($stock_myquery);
						$stock = $query->result_array();

print_r("stock_myquery:");
print_r($stock_myquery);
						$stock_index = 0;
						// valiance 
						$stock_id = $stock[$stock_index]['stock_id'];
						$stock_present_num = $stock[$stock_index]['stock_present_num'];
						$stock_despatch_num = $stock[$stock_index]['stock_despatch_num'];

						if ( $order_quantity_valiance <= $stock_present_num ) {
							
print_r("order_quantity_valiance:");
print_r($order_quantity_valiance);
print_r("stock_present_num:");
print_r($stock_present_num);
							// update 
							$pick_stock_query = "
								update os_stock_entry set stock_present_num=".($stock_present_num-$order_quantity_valiance)."
									, stock_despatch_num=".($stock_despatch_num+$order_quantity_valiance)."
								  where stock_id =".$stock_id;
print_r("pick_stock_query:");
print_r($pick_stock_query);
							$this->db->query($pick_stock_query);

							$despatch_query = "
								insert into os_despatch 
									(order_id, stock_id, despatch_num, os_product_id, entry_time)
									values
									(".$order_id.", 
									 ".$stock_id.", 
									 ".$order_quantity_valiance.", 
									 ".$product_id.", 
									 '".$today."')
							";
							$this->db->query($despatch_query);
						} else {
print_r("order_quantity_valiance:");
print_r($order_quantity_valiance);
print_r("stock_present_num:");
print_r($stock_present_num);
							// update 
							$pick_stock_query = "
								update os_stock_entry set stock_present_num= 0
									, stock_despatch_num=".($stock_despatch_num+$stock_present_num)."
								  where stock_id =".$stock_id;
print_r("pick_stock_query:");
print_r($pick_stock_query);
							$this->db->query($pick_stock_query);

							$despatch_query = "
								insert into os_despatch 
									(order_id, stock_id, despatch_num, os_product_id, entry_time)
									values
									(".$order_id.", 
									 ".$stock_id.", 
									 ".$stock_present_num.", 
									 ".$product_id.", 
									 '".$today."')
							";
print_r("despatch_query:");
print_r($despatch_query);
							$this->db->query($despatch_query);
						}
						// judge despatch balance
						$query = $this->db->query($despatch_balance_myquery);
						$is_despatch_balance = $query->num_rows();

print_r("is_despatch_balance:");
print_r($is_despatch_balance);
						$stock_index = $stock_index + 1;
						// check stock
						/*$query = $this->db->query($stock_available_myquery);
						$is_stock_available = $query->num_rows();*/
					}
				}
			} else {
				echo "not a valid order id";
			}

			/*$myquery = "update os_order set despatch_flag =1 where order_id= ".$order_id ;
			$query = $this->db->query($myquery);*/

		    /*$data = array(
		        'postage_company_id' => $this->input->post('postage_company_id'),
		        'postage_date' => $this->input->post('postage_date'),
		        'postage_code' => $this->input->post('postage_code'),
		        'postage_fee' => $this->input->post('postage_fee'),
		        'postage_weight' => $this->input->post('postage_weight'),
		        'remark' => $this->input->post('remark')
		    );
 			$this->db->insert('os_postage', $data);
		    $postage_id = $this->db->insert_id();

			$myquery = "insert into os_order_postage (order_id, postage_id) values (".$order_id .",".$postage_id."  )";
			$query = $this->db->query($myquery);
			$myquery = "update os_order set post_flag = 1 where order_id= ".$order_id ;
			$query = $this->db->query($myquery);
			return;*/
		}

		public function set_despatch_num($stock_id = FALSE,$order_id = FALSE,$os_product_id = FALSE,$despatch_num = FALSE)
		{
			$today = date("Y-m-d H:i:s");
            if ($stock_id !== FALSE AND $order_id !==FALSE AND $despatch_num !==FALSE ) 
            {
				
			/*	// update os_transaction
				$myquery = " insert into os_transaction (stock_id, order_id, despatch_num) values ( ".$stock_id." , ".$order_id.", ".$despatch_num." )";
				$this->db->query($myquery);*/

				// find if there is already a record in despatch table , then update it ,else insert new record.
				
				$myquery = 'select * from os_despatch dsp where dsp.order_id='.$order_id.' and dsp.stock_id = '.$stock_id;

				$query = $this->db->query($myquery);
            	if ( $query->num_rows() > 0 ) {
					// update os_stock_entry
					// get old values -- stock value
					$myquery = "select sty.* from os_stock_entry sty where sty.stock_id = ".$stock_id ;
					$query = $this->db->query($myquery);
			        $stock_entry_num = 0;
			        $stock_despatch_num = 0;
			        $stock_present_num = 0;
					foreach ($query->result_array() as $row)
					{
				        $stock_entry_num = $row['stock_entry_num'];
				        $stock_despatch_num = $row['stock_despatch_num'];
				        $stock_present_num = $row['stock_present_num'];
					}/*
				print_r("stock_entry_num -".$stock_entry_num."/");
				print_r("stock_despatch_num -".$stock_despatch_num."/");
				print_r("stock_present_num -".$stock_present_num."/");*/
					// get old values -- last despatched value
					$myquery = 'select dsp.* from os_despatch dsp  where dsp.order_id='.$order_id.' and dsp.stock_id = '.$stock_id;
					$query = $this->db->query($myquery);

			        $old_despatch_num = 0;
					foreach ($query->result_array() as $row)
					{
				        $old_despatch_num = $row['despatch_num'];
					}
/*
				print_r("old_despatch_num -".$old_despatch_num."/");
				print_r("despatch_num -".$despatch_num."/");*/
					// update os_despatch
					$myquery = ' update os_despatch dsp
									set stock_id= '.$stock_id.' , 
									order_id= '.$order_id.' ,  
									despatch_num= '.$despatch_num.' , 
									os_product_id= '.$os_product_id.' where dsp.order_id='.$order_id.' and dsp.stock_id = '.$stock_id;
									
									/*print_r($myquery);*/

					$this->db->query($myquery);

					// new stock value
					if ( $despatch_num > $old_despatch_num ) {
				        $stock_despatch_num = $stock_despatch_num + ($despatch_num - $old_despatch_num);
				        $stock_present_num = $stock_present_num - ($despatch_num - $old_despatch_num);
				       /* print_r("old-value: old_despatch_num - ".$old_despatch_num."</br>");
				        print_r("new-value: stock_despatch_num - ".$stock_despatch_num."</br>");
				        print_r("new-value: stock_present_num - ".$stock_present_num."</br>");*/

					} else {
				        $stock_despatch_num = $stock_despatch_num - ($old_despatch_num - $despatch_num );
				        $stock_present_num = $stock_present_num + ($old_despatch_num - $despatch_num);
				        /*print_r("old-value: old_despatch_num - ".$old_despatch_num."</br>");
				        print_r("new-value: stock_despatch_num - ".$stock_despatch_num."</br>");
				        print_r("new-value: stock_present_num - ".$stock_present_num."</br>");*/

					}
					// update stock table 
					$myquery = "update os_stock_entry sty set sty.stock_despatch_num = ".$stock_despatch_num." 
								, sty.stock_present_num = ".$stock_present_num." 
					 			"."where sty.stock_id =  ".$stock_id;
									/*print_r($myquery);*/
									//exit;
					$this->db->query($myquery);


            	} else {
					// update os_despatch
					$myquery = " insert into os_despatch (stock_id, order_id, despatch_num, os_product_id, entry_time, update_time ) 
								values ( ".$stock_id." , ".$order_id." , ".$despatch_num." , ".$os_product_id.",'".$today."','".$today."' )";
					$this->db->query($myquery);

					// update os_stock_entry
					// old value
					$myquery = "select sty.* from os_stock_entry sty where sty.stock_id = ".$stock_id ;
					$query = $this->db->query($myquery);
			        $stock_entry_num = 0;
			        $stock_despatch_num = 0;
			        $stock_present_num = 0;
					foreach ($query->result_array() as $row)
					{
				        $stock_entry_num = $row['stock_entry_num'];
				        $stock_despatch_num = $row['stock_despatch_num'];
				        $stock_present_num = $row['stock_present_num'];
					}
					// new value
					$stock_despatch_num = $stock_despatch_num + $despatch_num;
					$stock_present_num = $stock_present_num - $despatch_num;
					// update table 
					$myquery = "update os_stock_entry sty set sty.stock_despatch_num = ".$stock_despatch_num." 
								, sty.stock_present_num = ".$stock_present_num." 
					 			"."where sty.stock_id =  ".$stock_id;
					$this->db->query($myquery);

            	}
            	return;


				/*$myquery = 'update os_stock_entry ose set ose.stock_despatch_num='.$stock_despatch_num.' ,  ose.stock_present_num = ( ose.stock_entry_num - '.$stock_despatch_num.' )
								where ose.stock_id= '.$stock_id ;
								
				$this->db->query($myquery);*/

            }


		}
		public function quick_update_stock_take($stock_id = FALSE,$order_id = FALSE,$os_product_id = FALSE,$stock_despatch_num = FALSE)
		{
			$today = date("Y-m-d H:i:s");
            if ($stock_id !== FALSE AND $order_id !==FALSE AND $stock_despatch_num !==FALSE ) 
            {
		        $entry_time = $today;
		        $update_time = $today;
				$myquery = 'update os_stock_entry ose set ose.stock_despatch_num='.$stock_despatch_num.' ,  ose.stock_present_num = ( ose.stock_entry_num - '.$stock_despatch_num.' )
								where ose.stock_id= '.$stock_id ;
								
				$this->db->query($myquery);
				// update os_transaction
				$myquery = " insert into os_transaction (stock_id, order_id, entry_time, update_time) values ( ".$stock_id." , ".$order_id.",'".$today."','".$today."' )";
				$this->db->query($myquery);

				// update os_despatch
				$myquery = " insert into os_despatch (stock_id, order_id, despatch_num, os_product_id, entry_time, update_time) values ( ".$stock_id." , ".$order_id." , ".$stock_despatch_num." , ".$os_product_id.",'".$today."','".$today."' )";
				$this->db->query($myquery);
            }
		}
		

}