<?php
class Product_model extends CI_Model {
        public function __construct()
        {
                $this->load->database();
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
				(product_id,product_name,small_img_src,big_img_src,chemist_price)
								select of.product_id,
									of.product_name,
									of.small_img_src,
									of.big_img_src,
									of.chemist_price
								from 
								os_chemist_product_fetch of left join
								os_chemist_product OP on
								of.product_id = op.product_id
								where op.product_id is null ');

			//$this->db->set($product_obj);
			$this->db->update_batch('os_chemist_product', $product_obj, 'product_id');

			$this->db->query('update os_chemist_product 
								 set update_time = CURRENT_TIMESTAMP
								where product_id in 
									(select of.product_id from os_chemist_product_fetch of ) ');
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