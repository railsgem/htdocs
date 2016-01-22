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
			$this->db->insert_batch('os_chemist_product', $product_obj);

			echo "success";
		    exit;
		   // $data['product'] = $this->input->post('product'); 
			echo "this is controller-save_fetch()";
		    print_r( $product_obj);
		    exit;

		}

}