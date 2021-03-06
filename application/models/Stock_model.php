<?php
class stock_model extends CI_Model {
        
    public function __construct()
    {
        $this->load->database();
		date_default_timezone_set('Australia/Sydney');
		$today = date("Y-m-d H:i:s");
    }

	public function get_stock_list($offset = 1,$per_page = 14,$is_total = FALSE)
	{
		$product_name = $this->input->get('product_name');
		$product_name = str_replace('\'','\'\'',$product_name);
		$is_despatched = $this->input->get('is_despatched');
		$is_out_of_stock = $this->input->get('is_out_of_stock');
		$buyer = $this->input->get('buyer');
		$buyer = str_replace('\'','\'\'',$buyer);
		$buy_shop = $this->input->get('buy_shop');
		$buy_shop = str_replace('\'','\'\'',$buy_shop);
		$expire_date_from = $this->input->get('expire_date_from');
		$expire_date_to = $this->input->get('expire_date_to');
		$purchase_time_from = $this->input->get('purchase_time_from');
		$purchase_time_to = $this->input->get('purchase_time_to');

		$myquery = "select op.product_name,
								stk.stock_id,
								stk.os_product_id,
								stk.real_cost,
								stk.stock_entry_num,
								stk.stock_despatch_num,
								stk.stock_present_num,
								stk.buy_shop,
								stk.buyer,
								stk.purchase_time,
								stk.entry_time,
								stk.update_time,
								stk.expire_date

							from os_stock_entry stk 
						left join os_product op on stk.os_product_id = op.os_product_id WHERE 1=1 ";

		if ($product_name != '')
		{
			$myquery = $myquery.' and op.product_name like \'%'.$product_name.'%\'';
		}
		if ($buyer != '')
		{
			$myquery = $myquery.' and stk.buyer like \'%'.$buyer.'%\'';
		}
		if ($buy_shop != '')
		{
			$myquery = $myquery.' and stk.buy_shop like \'%'.$buy_shop.'%\'';
		}


		if ($expire_date_from != '')
		{
			$myquery = $myquery.' and stk.expire_date >= \''.$expire_date_from.'\'';
		}	
		if ($expire_date_to != '')
		{
			$myquery = $myquery.' and stk.expire_date <= \''.$expire_date_to.' \'';
		}					
		
		if ($purchase_time_from != '')
		{
			$myquery = $myquery.' and stk.purchase_time >= \''.$purchase_time_from.'\'';
		}	
		if ($purchase_time_to != '')
		{
			$myquery = $myquery.' and stk.purchase_time <= \''.$purchase_time_to.' \'';
		}					
		
		if ($is_despatched == '1')
		{
			$myquery = $myquery.' and stk.stock_despatch_num > 0';
		}
		if ($is_despatched == '0')
		{
			$myquery = $myquery.' and stk.stock_despatch_num = 0';
		}
		if ($is_out_of_stock == '1')
		{
			$myquery = $myquery.' and stk.stock_present_num = 0';
		}
		if ($is_out_of_stock == '0')
		{
			$myquery = $myquery.' and stk.stock_present_num > 0';
		}


		if ($is_total == TRUE)
		{
			//echo $myquery;
			$myquery = $myquery.' order by stk.expire_date asc ';
			$query = $this->db->query($myquery);
			return $query->num_rows();
		}
		else
		{
			//echo $myquery;
			$myquery = $myquery.' order by stk.expire_date desc limit '.$offset.', '.$per_page;
			$query = $this->db->query($myquery);
            return $query->result_array();
        }
	}

	public function get_order_list($offset = 1,$per_page = 14,$is_total = FALSE)
	{
	    $stock_id = $this->input->get('stock_id');
		$myquery = "select 
					t1.stock_id,
					t1.despatch_id,
					t1.despatch_num,
					t1.entry_time despatch_time,
					t1.expire_date,
				    t1.os_product_id,
					t3.product_name,
					t2.order_id,
					t2.order_code,
					t2.active,
					t2.post_flag,
					t2.entry_time,
					t2.update_time,
					t2.agent_id,
					t2.agent_name,
					t2.address_id,
					t2.address_detail,
					t2.phone,
					t2.recevier_name,
					t2.recevier_nation_id,
					t2.remark,
					t2.product_list
			from 
			(SELECT
				sto.stock_id,
				dep.despatch_id,
				dep.despatch_num,
				dep.entry_time,
				dep.order_id,
				dep.os_product_id,
				sto.expire_date
			FROM
				os_stock_entry sto
			LEFT JOIN os_despatch dep ON sto.stock_id = dep.stock_id
			) t1 left join 
			(  SELECT
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
					1 = 1) t2 on t1.order_id = t2.order_id
			left join os_product t3 on t1.os_product_id = t3.os_product_id WHERE 1=1 and t1.stock_id=".$stock_id." and t1.despatch_id is not null ";

		if ($is_total == TRUE)
		{
			//echo $myquery;
			$myquery = $myquery.' order by t1.entry_time asc ';
			$query = $this->db->query($myquery);
			return $query->num_rows();
		}
		else
		{
			//echo $myquery;
			$myquery = $myquery.' order by t1.entry_time desc limit '.$offset.', '.$per_page;
			$query = $this->db->query($myquery);
            return $query->result_array();
        }
	}

	
	public function get_stock($stock_id = FALSE)
	{
        if ($stock_id === FALSE)
	    {
			$myquery = "select op.product_name,
								stk.stock_id,
								stk.os_product_id,
								stk.real_cost,
								stk.stock_entry_num,
								stk.stock_despatch_num,
								stk.stock_present_num,
								stk.buy_shop,
								stk.buyer,
								stk.purchase_time,
								stk.entry_time,
								stk.update_time,
								stk.expire_date

							from os_stock_entry stk 
						left join os_product op on stk.os_product_id = op.os_product_id 
						order by stk.stock_id desc ";

			$query = $this->db->query($myquery);
	        return $query->result_array();
		} else {
			$myquery = "select op.product_name,
								stk.stock_id,
								stk.os_product_id,
								stk.real_cost,
								stk.stock_entry_num,
								stk.stock_despatch_num,
								stk.stock_present_num,
								stk.buy_shop,
								stk.buyer,
								stk.purchase_time,
								stk.entry_time,
								stk.update_time,
								stk.expire_date

							from os_stock_entry stk 
						left join os_product op on stk.os_product_id = op.os_product_id 
						where stk.stock_id =".$stock_id."
						order by stk.stock_id desc ";
			$query = $this->db->query($myquery);
			return $query->row_array();
		}

	}

	public function get_stock_by_prodcut_id($os_prodcut_id = FALSE)
	{
		$myquery = "SELECT  ordpro.order_id,
							ordpro.order_product_id,
							ordpro.sell_price,
							ordpro.quantity,
							skpro.product_name,
							skpro.stock_id,
							skpro.os_product_id,
							skpro.real_cost,
							skpro.stock_entry_num,
							skpro.stock_despatch_num,
							skpro.stock_present_num,
							skpro.buy_shop,
							skpro.buyer,
							skpro.purchase_time,
							skpro.entry_time,
							skpro.update_time,
							skpro.expire_date
					FROM
						os_order_product ordpro
					LEFT JOIN (
						SELECT
							op.product_name,
							stk.stock_id,
							stk.os_product_id,
							stk.real_cost,
							stk.stock_entry_num,
							stk.stock_despatch_num,
							stk.stock_present_num,
							stk.buy_shop,
							stk.buyer,
							stk.purchase_time,
							stk.entry_time,
							stk.update_time,
							stk.expire_date
						FROM
							os_stock_entry stk
						LEFT JOIN os_product op ON stk.os_product_id = op.os_product_id
						WHERE
							stk.stock_present_num > 0
					) skpro ON ordpro.os_product_id = skpro.os_product_id
					where ordpro.os_product_id = ".$os_prodcut_id;

		$query = $this->db->query($myquery);
        return $query->result_array();

        if ($stock_id === FALSE)
        {
			$query = $this->db->get('os_stock_entry');
			return $query->result_array();
        }
        $query = $this->db->get_where('os_stock_entry', array('stock_id' => $stock_id));
        return $query->row_array();

	}
	public function get_stock_by_order_id($order_id = FALSE)
	{
		$myquery = "SELECT
							t1.order_id,
							t1.os_product_id,
							t1.stock_id,
							t2.real_cost,
							t2.stock_entry_num,
							t2.stock_despatch_num,
							t2.stock_present_num,
							t1.despatch_num
						FROM
							os_despatch t1
						LEFT JOIN os_stock_entry t2 ON t1.stock_id = t2.stock_id
						WHERE
							t1.order_id = ".$order_id."
						AND t1.despatch_num > 0
						union 
						SELECT
							t1.order_id,
							t1.os_product_id,
							t2.stock_id,
							t2.real_cost,
							t2.stock_entry_num,
							t2.stock_despatch_num,
							t2.stock_present_num,
							0 despatch_num
						FROM
							os_order_product t1
						INNER JOIN (
							SELECT
								a.*
							FROM
								os_stock_entry a
							WHERE
								a.stock_id NOT IN (
									SELECT
										b.stock_id
									FROM
										os_despatch b
									WHERE
										b.order_id =".$order_id."
									AND b.despatch_num > 0
								)
						) t2 ON t1.os_product_id = t2.os_product_id
						WHERE
							t1.order_id =".$order_id;
							
		$query = $this->db->query($myquery);
        return $query->result_array();

        if ($stock_id === FALSE)
        {
			$query = $this->db->get('os_stock_entry');
			return $query->result_array();
        }
        $query = $this->db->get_where('os_stock_entry', array('stock_id' => $stock_id));
        return $query->row_array();

	}

	public function get_despatch_by_order_id($order_id = FALSE)
	{
		$myquery = "select 
							dep.product_name,
							dep.order_id,
							dep.os_product_id,
							dep.quantity,
							dep.sell_price,
							dep.despatch_num,
							dep.stock_id
						from (
						SELECT
							op.product_name,
							odp.order_id,
							odp.os_product_id,
							odp.quantity,
							odp.sell_price,
							od.despatch_num,
							od.stock_id
						FROM
							os_order_product odp
						LEFT JOIN os_product op ON odp.os_product_id = op.os_product_id
						LEFT JOIN os_despatch od ON odp.order_id = od.order_id
						AND odp.os_product_id = od.os_product_id
						WHERE
							odp.order_id = ".$order_id
						.") dep where dep.despatch_num >0 ";

		$query = $this->db->query($myquery);
        return $query->result_array();

	}

	public function get_despatch_cost_by_order_id($order_id = FALSE)
	{/*SELECT
	t1.order_product_id,
	t1.order_id,
	t1.os_product_id,
	m2.product_name,
	t1.quantity,
	t1.sell_price,
	t1.quantity * t1.sell_price total_sell_price,
	m1.despatch_num,
	m1.real_cost,
	m1.total_real_cost,
	m1.buyer
FROM
	os_order_product t1 left join 
	(SELECT
		t2.*, t3.real_cost,
		t3.buyer,
		t2.despatch_num * t3.real_cost total_real_cost
	FROM
		os_despatch t2
	LEFT JOIN os_stock_entry t3 ON t2.stock_id = t3.stock_id
	WHERE
		t2.order_id = 52) m1 on t1.os_product_id = m1.os_product_id
	left join os_product m2 on t1.os_product_id = m2.os_product_id
WHERE
	t1.order_id = 52;*/
		$myquery = "SELECT t2.order_id,
							t2.os_product_id, 
							sum(t2.despatch_num * t3.real_cost) total_cost
						FROM
							os_despatch t2
						LEFT JOIN os_stock_entry t3 ON t2.stock_id = t3.stock_id
						WHERE
							t2.order_id = ".$order_id."
					group by t2.order_id,
							t2.os_product_id 
					";
		$query = $this->db->query($myquery);
        return $query->result_array();

	}


	public function set_stock()
	{
		$today = date("Y-m-d H:i:s");
	    $data = array(
	        'os_product_id' => $this->input->post('os_product_id'),
	        'real_cost' => $this->input->post('real_cost'),
	        'stock_entry_num' => $this->input->post('stock_entry_num'),
		    'stock_present_num' => $this->input->post('stock_entry_num'),
	        'buy_shop' => $this->input->post('buy_shop'),
	        'buyer' => $this->input->post('buyer'),
		    'entry_time' => $today,
	        'purchase_time' => $this->input->post('purchase_time'),
	        'expire_date' => $this->input->post('expire_date')
	    );
	    return $this->db->insert('os_stock_entry', $data);
	}

	public function update_stock($stock_id = FALSE)
	{
		$today = date("Y-m-d H:i:s");
		if ($stock_id !== FALSE)
		{
		    $data = array(
		        //'os_product_id' => $this->input->post('os_product_id'),
		        'real_cost' => $this->input->post('real_cost'),
		        //'stock_entry_num' => $this->input->post('stock_entry_num'),
		        //'stock_present_num' => $this->input->post('stock_present_num'),
		        'buy_shop' => $this->input->post('buy_shop'),
		        'buyer' => $this->input->post('buyer'),
	        	'expire_date' => $this->input->post('expire_date'),
		        //'purchase_time' => $this->input->post('purchase_time'),
		        'update_time' => $today
		    );
		    $this->db->where('stock_id', $stock_id);
		    $this->db->update('os_stock_entry', $data);
		    //return $this->db->insert_id();
	    }
	}

	public function delete_stock($stock_id = FALSE)
	{
		if ($stock_id !== FALSE)
		{
		    $this->db->where('stock_id', $stock_id);
		    $this->db->delete('os_stock_entry');
	    }
	}			

}