<?php
class Consumer_model extends CI_Model {
        public function __construct()
        {
                $this->load->database();
        }

		public function get_consumer($consumer_id = FALSE)
		{
		        if ($consumer_id === FALSE)
		        {
					$query = $this->db->get('os_consumer');
					return $query->result_array();
		        }
		        $query = $this->db->get_where('os_consumer', array('consumer_id' => $consumer_id));
		        return $query->row_array();
		}

		public function get_consumer_list($offset = 1,$per_page = 14,$is_total = FALSE,$is_echart= FALSE)
		{
			$from_date = $this->input->get('from_date');
			$to_date = $this->input->get('to_date');
			$myquery = 'SELECT  t.consumer_id
								,t.consumer_name
								,t.consumer_nation_id
								,t.consumer_address
								,t.consumer_phone
								,t.consumer_postcode
								,t.entry_time
								,t.is_agent 
						FROM os_consumer t 
						WHERE 1=1
						';
			if ($from_date != '')
			{
				$myquery = $myquery.' and consumer_rep_date >= \''.$from_date.'\'';
			}	
			if ($to_date != '')
			{
				$myquery = $myquery.' and consumer_rep_date <= \''.$to_date.' 23:59:59\'';
			}					
			
			if ($is_echart == TRUE)
			{
				//echo $myquery;
				$myquery = $myquery.' order by entry_time asc ';
				$query = $this->db->query($myquery);
				return $query->result_array();
			}
			if ($is_total == TRUE)
			{
				//echo $myquery;
				$myquery = $myquery.' order by entry_time asc ';
				$query = $this->db->query($myquery);
				return $query->num_rows();
			}
			else
			{
				//echo $myquery;
				$myquery = $myquery.' order by entry_time desc limit '.$offset.', '.$per_page;
				$query = $this->db->query($myquery);
	            return $query->result_array();
            }

		}
		public function set_consumer()
		{
		    $data = array(
		        'consumer_rep_date' => $this->input->post('consumer_rep_date'),
		        'print_total' => $this->input->post('print_total'),
		        'print_error' => $this->input->post('print_error'),
		        'print_total_app' => $this->input->post('print_total_app'),
		        'print_error_app' => $this->input->post('print_error_app'),
		        'delivery_scan_total' => $this->input->post('delivery_scan_total'),
		        'delivery_express_receive' => $this->input->post('delivery_express_receive'),
		        'delivery_missed' => $this->input->post('delivery_missed'),
		        'delivery_error' => $this->input->post('delivery_error'),
		        'delivery_remark' => $this->input->post('delivery_remark'),
		        'picking_total' => $this->input->post('picking_total'),
		        'picking_missed' => $this->input->post('picking_missed'),
		        'picking_error' => $this->input->post('picking_error'),
		        'operator' => $this->input->post('operator')
			        //,'operate_timestamp' => $this->input->post('operate_timestamp')
		    );
 			$this->db->insert('os_consumer', $data);

 			$myquery_consumer_id = 'select max(consumer_id) consumer_id from os_consumer';
 			$query = $this->db->query($myquery_consumer_id);
			$consumer_id = $query->result_array();

		    $myquery = 'insert into os_consumer_operation_log (operator, update_column, new_value, old_value, consumer_id) values (\''
		    	.$this->input->post('operator').'\', \'create\' , null, null , '.$consumer_id[0]['consumer_id'].')';

			$query = $this->db->query($myquery);

		    //return $this->db->insert('os_consumer', $data);
		}

		public function update_consumer($consumer_id = FALSE)
		{
			if ($consumer_id !== FALSE)
			{
				// backup history data
			    $myquery = 'insert into  os_consumer_log (consumer_id, picking_error, print_error_app, consumer_rep_date, delivery_missed, delivery_error, picking_total, print_total, delivery_express_receive, picking_missed, delivery_scan_total, operator, print_total_app, delivery_remark, operate_timestamp, print_error) 
			    select consumer_id,picking_error, print_error_app, consumer_rep_date, delivery_missed, delivery_error, picking_total, print_total, delivery_express_receive, picking_missed, delivery_scan_total, operator, print_total_app, delivery_remark, operate_timestamp, print_error from os_consumer ok where consumer_id= '.$consumer_id ;
			    //echo $myquery;
				$query = $this->db->query($myquery);

			    //operation detail log -- os_consumer_operation_log
			    $myquery_log = ' select consumer_id,picking_error, print_error_app, consumer_rep_date, delivery_missed, delivery_error, picking_total, print_total, delivery_express_receive, picking_missed, delivery_scan_total, operator, print_total_app, delivery_remark, operate_timestamp, print_error from os_consumer ok where consumer_id= '.$consumer_id ;
				$query = $this->db->query($myquery_log);
				$result = $query->result_array();

			    $data = array(
		        	'consumer_rep_date' => $this->input->post('consumer_rep_date'),
			        'print_total' => $this->input->post('print_total'),
			        'print_error' => $this->input->post('print_error'),
			        'print_total_app' => $this->input->post('print_total_app'),
			        'print_error_app' => $this->input->post('print_error_app'),
			        'delivery_scan_total' => $this->input->post('delivery_scan_total'),
			        'delivery_express_receive' => $this->input->post('delivery_express_receive'),
			        'delivery_missed' => $this->input->post('delivery_missed'),
			        'delivery_error' => $this->input->post('delivery_error'),
			        'delivery_remark' => $this->input->post('delivery_remark'),
			        'picking_total' => $this->input->post('picking_total'),
			        'picking_missed' => $this->input->post('picking_missed'),
			        'picking_error' => $this->input->post('picking_error'),
			        'operator' => $this->input->post('operator')
			        //,'operate_timestamp' => $this->input->post('operate_timestamp')
			    );

				$string_op_insert = "insert into os_consumer_operation_log (operator, update_column, new_value, old_value, consumer_id) values ";
				$string_op_log = "";
				if($result[0]['consumer_rep_date'] <> $data['consumer_rep_date']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'consumer_rep_date\',\''.$data['consumer_rep_date'].'\',\''.$result[0]['consumer_rep_date'].'\','.$result[0]['consumer_id'].");";
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['print_total'] <> $data['print_total']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'print_total\','.$data['print_total'].','.$result[0]['print_total'].','.$result[0]['consumer_id'].");";
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['print_error'] <> $data['print_error']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'print_total\','.$data['print_total'].','.$result[0]['print_total'].','.$result[0]['consumer_id'].");";
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['print_total_app'] <> $data['print_total_app']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'print_total_app\','.$data['print_total_app'].','.$result[0]['print_total_app'].','.$result[0]['consumer_id'].");";
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['print_error_app'] <> $data['print_error_app']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'print_error_app\','.$data['print_error_app'].','.$result[0]['print_error_app'].','.$result[0]['consumer_id'].");";
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['delivery_scan_total'] <> $data['delivery_scan_total']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'delivery_scan_total\','.$data['delivery_scan_total'].','.$result[0]['delivery_scan_total'].','.$result[0]['consumer_id'].");";
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['delivery_express_receive'] <> $data['delivery_express_receive']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'delivery_express_receive\','.$data['delivery_express_receive'].','.$result[0]['delivery_express_receive'].','.$result[0]['consumer_id'].");";
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['delivery_missed'] <> $data['delivery_missed']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'delivery_missed\','.$data['delivery_missed'].','.$result[0]['delivery_missed'].','.$result[0]['consumer_id'].");";
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['delivery_error'] <> $data['delivery_error']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'delivery_error\','.$data['delivery_error'].','.$result[0]['delivery_error'].','.$result[0]['consumer_id'].");";
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['delivery_remark'] <> $data['delivery_remark']){
					if(empty($result[0]['delivery_remark'])){
						$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'delivery_remark\',\''.$data['delivery_remark'].'\', null ,'.$result[0]['consumer_id'].");";

					} else {
						$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'delivery_remark\',\''.$data['delivery_remark'].'\',\''.$result[0]['delivery_remark'].'\','.$result[0]['consumer_id'].");";
					}
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['picking_total'] <> $data['picking_total']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'picking_total\','.$data['picking_total'].','.$result[0]['picking_total'].','.$result[0]['consumer_id'].");";
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['picking_missed'] <> $data['picking_missed']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'picking_missed\','.$data['picking_missed'].','.$result[0]['picking_missed'].','.$result[0]['consumer_id'].");";
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['picking_error'] <> $data['picking_error']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'picking_error\','.$data['picking_error'].','.$result[0]['picking_error'].','.$result[0]['consumer_id'].");";
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['operator'] <> $data['operator']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'operator\',\''.$data['operator'].'\',\''.$result[0]['operator'].'\','.$result[0]['consumer_id'].")";
					$query = $this->db->query($string_op_log);	
				} 
			    $this->db->where('consumer_id', $consumer_id);
			    $this->db->update('os_consumer', $data);


			    //return $this->db->insert_id();
		    }
		}


		public function delete_consumer($consumer_id = FALSE)
		{
			if ($consumer_id !== FALSE)
			{
			    $this->db->where('consumer_id', $consumer_id);
			    $this->db->delete('os_consumer');
		    }
		}		

		public function get_consumer_update_history($consumer_id = FALSE)
		{
			if ($consumer_id !== FALSE)
			{
				$myquery = "select 
					case when oko.update_column='consumer_rep_date' then 'consumer 日期'
					when oko.update_column='print_total' then 'AT打单总数量'
					when oko.update_column='print_error' then 'AT错单数量'
					when oko.update_column='print_total_app' then 'APP打单总数量'
					when oko.update_column='print_error_app' then 'APP错单数量'
					when oko.update_column='delivery_scan_total' then '总扫单数量'
					when oko.update_column='delivery_express_receive' then '快递收包裹量'
					when oko.update_column='delivery_missed' then '漏发单量'
					when oko.update_column='delivery_error' then '错发单量'
					when oko.update_column='delivery_remark' then '其他备注详情'
					when oko.update_column='picking_total' then '总配货商品数量'
					when oko.update_column='picking_missed' then '漏配商品数量'
					when oko.update_column='picking_error' then '错配商品数量'
					when oko.update_column='operator' then '操作员'
					when oko.update_column='create' then '创建'
					else null end update_column
					,
					oko.new_value,
					oko.old_value,
					oko.update_time,
					oko.operator
				 from os_consumer_operation_log oko where oko.consumer_id = ".$consumer_id .' order by update_time desc';
				
				$query = $this->db->query($myquery);
	            return $query->result_array();
		    }
		}		

}