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

	public function set_stock()
	{
	    $data = array(
	        'os_product_id' => $this->input->post('os_product_id'),
	        'real_cost' => $this->input->post('real_cost'),
	        'stock_num' => $this->input->post('stock_num'),
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
		        'stock_num' => $this->input->post('stock_num'),
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