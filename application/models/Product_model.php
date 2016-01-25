<?php
class Product_model extends CI_Model {
        public function __construct()
        {
                $this->load->database();
        }

		public function get_product($product_id = FALSE)
		{
	        if ($product_id !== FALSE)
	        {
	        	$query = $this->db->get_where('os_product', array('os_product_id' => $product_id));
	        	return $query->row_array();
	        }
	        $query = $this->db->get('os_product');
			return $query->result_array();

		}
		public function get_product_by_name($product_name = "")
		{
	        if ($product_name !== FALSE)
	        {
				$product_name = $this->input->get('term');

				$myquery = "select op.product_name label, op.os_product_id id, op.product_name value, op.chemist_price, op.source_type from os_product op where UPPER(op.product_name) like UPPER('%".$product_name."%')";

				$query = $this->db->query($myquery);	
	        	return $query->result_array();
	        }

		}

		public function get_product_list($offset = 1,$per_page = 50,$is_total = FALSE)
		{
			$product_name = $this->input->get('product_name');
			$product_name = str_replace('\'','\'\'',$product_name);
			$barcode = $this->input->get('barcode');
			$brand_id = $this->input->get('brand_id');
			$category_id = $this->input->get('category_id');
			$stock = $this->input->get('stock');
			$location = $this->input->get('location');

			//$myquery = 'select * from os_product as pro,os_brand as bra,os_category as cat where pro.brand_id = bra.brand_id and cat.category_id = pro.category_id ';
			

			$myquery = 'select * from os_product as pro where 1=1 ';
			if ($product_name != '')
			{
				$myquery = $myquery.' and pro.product_name like \'%'.$product_name.'%\'';
			}
			if ($barcode != '')
			{
				$myquery = $myquery.' and pro.barcode like \'%'.$barcode.'%\'';
			}
			// if ($brand_id != '' && $brand_id !=0 )
			// {
			// 	$myquery = $myquery.' and pro.brand_id = '.$brand_id;
			// }
			// if ($category_id != '' && $category_id !=0 )
			// {
			// 	$myquery = $myquery.' and pro.category_id = '.$category_id;
			// }
			if ($stock === '1')
			{
				$myquery = $myquery.' and pro.stock <= purchase_line';
			}
			if ($stock === '2')
			{
				$myquery = $myquery.' and pro.stock <= reserve_line';
			}

			if ($location !='' AND $location !='all') {
				$myquery = $myquery.' and pro.wh_loc = \''.$location.'\'';
			}
			

			if ($is_total == TRUE)
			{
				//echo $myquery;
				$query = $this->db->query($myquery);
				return $query->num_rows();
			}
			else
			{

				$myquery = $myquery.' order by pro.product_name asc limit '.$offset.', '.$per_page;
				//echo $myquery;
				$query = $this->db->query($myquery);
				// $data=$this->db->from('os_product as pro')
				// ->join('os_brand as bra', 'pro.brand_id = bra.brand_id')
				// ->join('os_category as cat', 'cat.category_id = pro.category_id')
				// ->get()->result_array();
	            return $query->result_array();
            }
		}

		public function save_fetch_product()
		{

        	// chemist product list json string
			echo "this is model-save_fetch_product()";
			echo "</br></br></br></br>";
			$product_obj = json_decode($this->input->post('product'),true);
			print_r($product_obj);
			echo "</br></br></br></br>";

			$this->db->trans_begin();

			//empty the table 
			$this->db->query('delete from os_chemist_product_fetch');

			//insert fetch product data into temp table
			$this->db->insert_batch('os_chemist_product_fetch', $product_obj);
			
			//insert fetch product data into table os_chemist_product, if product is exits ,update it .or else insert
			$this->db->query('insert into os_chemist_product
				(chemist_product_id,product_name,small_img_src,big_img_src,chemist_price)
								select of.chemist_product_id,
									of.product_name,
									of.small_img_src,
									of.big_img_src,
									of.chemist_price
								from 
								os_chemist_product_fetch of left join
								os_chemist_product OP on
								of.chemist_product_id = op.chemist_product_id
								where op.chemist_product_id is null ');
			$this->db->query('insert into os_product
				(chemist_product_id,product_name,small_img_src,big_img_src,chemist_price,source_type)
								select of.chemist_product_id,
									of.product_name,
									of.small_img_src,
									of.big_img_src,
									of.chemist_price,
									"chemist warehouse" source_type
								from 
								os_chemist_product_fetch of left join
								os_product OP on
								of.chemist_product_id = op.chemist_product_id
								where op.chemist_product_id is null ');

			//$this->db->set($product_obj);
			$this->db->update_batch('os_chemist_product', $product_obj, 'chemist_product_id');
			$this->db->update_batch('os_product', $product_obj, 'chemist_product_id');

			$this->db->query('update os_chemist_product 
								 set update_time = CURRENT_TIMESTAMP
								where chemist_product_id in 
									(select of.chemist_product_id from os_chemist_product_fetch of ) ');
			$this->db->query('update os_product 
								 set update_time = CURRENT_TIMESTAMP, source_type = "chemist warehouse"
								where chemist_product_id in 
									(select of.chemist_product_id from os_chemist_product_fetch of ) ');
			//$this->db->insert_batch('os_chemist_product', $product_obj);


			if ($this->db->trans_status() === FALSE)
			{
			    $this->db->trans_rollback();
				echo "error";
			}
			else
			{
			    $this->db->trans_commit();
				echo "success";
			}
			

		}

}