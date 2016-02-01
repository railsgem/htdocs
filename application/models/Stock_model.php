<?php
class stock_model extends CI_Model {
        
    public function __construct()
    {
        $this->load->database();
    }

	public function get_stock($stock_id = FALSE)
	{
		$myquery = "select op.product_name,stk.* from os_stock_entry stk left join os_product op on stk.os_product_id = op.os_product_id ";

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
							skpro.update_time
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
							stk.update_time
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
							skpro.update_time
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
							stk.update_time
						FROM
							os_stock_entry stk
						LEFT JOIN os_product op ON stk.os_product_id = op.os_product_id
						WHERE
							stk.stock_present_num > 0
					) skpro ON ordpro.os_product_id = skpro.os_product_id
					where ordpro.order_id = ".$order_id;

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


	public function set_stock()
	{
	    $data = array(
	        'os_product_id' => $this->input->post('os_product_id'),
	        'real_cost' => $this->input->post('real_cost'),
	        'stock_entry_num' => $this->input->post('stock_entry_num'),
	        'buy_shop' => $this->input->post('buy_shop'),
	        'buyer' => $this->input->post('buyer'),
	        'purchase_time' => $this->input->post('purchase_time')
	    );
	    return $this->db->insert('os_stock_entry', $data);
	}

	public function update_stock($stock_id = FALSE)
	{
		if ($stock_id !== FALSE)
		{
		    $data = array(
		        'os_product_id' => $this->input->post('os_product_id'),
		        'real_cost' => $this->input->post('real_cost'),
		        'stock_entry_num' => $this->input->post('stock_entry_num'),
		        'stock_present_num' => $this->input->post('stock_present_num'),
		        'buy_shop' => $this->input->post('buy_shop'),
		        'buyer' => $this->input->post('buyer'),
		        'purchase_time' => $this->input->post('purchase_time')
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