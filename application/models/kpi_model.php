<?php
class Kpi_model extends CI_Model {
        public function __construct()
        {
                $this->load->database();
        }

		public function get_kpi($kpi_id = FALSE)
		{
		        if ($kpi_id === FALSE)
		        {
					$query = $this->db->get('os_kpi');
					return $query->result_array();
		        }
		        $query = $this->db->get_where('os_kpi', array('kpi_id' => $kpi_id));
		        return $query->row_array();
		}

		public function get_kpi_list($offset = 1,$per_page = 14,$is_total = FALSE,$is_echart= FALSE)
		{
			$from_date = $this->input->get('from_date');
			$to_date = $this->input->get('to_date');
			$myquery = 'SELECT t.kpi_id	
								,t.kpi_rep_date	
								,t.print_total	
								,t.print_error	
								,t.print_total_app	
								,t.print_error_app	
								,t.delivery_scan_total	
								,t.delivery_express_receive	
								,t.delivery_missed	
								,t.delivery_error	
								,t.delivery_remark	
								,t.picking_total	
								,t.picking_missed	
								,t.picking_error	
								,t.operator	
								,t.operate_timestamp	
								,date_format(t.kpi_rep_date,\'%a\')  as week_day   
						FROM os_kpi t 
						WHERE 1=1
						';
			if ($from_date != '')
			{
				$myquery = $myquery.' and kpi_rep_date >= \''.$from_date.'\'';
			}	
			if ($to_date != '')
			{
				$myquery = $myquery.' and kpi_rep_date <= \''.$to_date.' 23:59:59\'';
			}					
			
			if ($is_echart == TRUE)
			{
				//echo $myquery;
				$myquery = $myquery.' order by kpi_rep_date asc ';
				$query = $this->db->query($myquery);
				return $query->result_array();
			}
			if ($is_total == TRUE)
			{
				//echo $myquery;
				$myquery = $myquery.' order by kpi_rep_date asc ';
				$query = $this->db->query($myquery);
				return $query->num_rows();
			}
			else
			{
				//echo $myquery;
				$myquery = $myquery.' order by kpi_rep_date desc limit '.$offset.', '.$per_page;
				$query = $this->db->query($myquery);
	            return $query->result_array();
            }

		}
		public function set_kpi()
		{
		    $data = array(
		        'kpi_rep_date' => $this->input->post('kpi_rep_date'),
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
 			$this->db->insert('os_kpi', $data);

 			$myquery_kpi_id = 'select max(kpi_id) kpi_id from os_kpi';
 			$query = $this->db->query($myquery_kpi_id);
			$kpi_id = $query->result_array();

		    $myquery = 'insert into os_kpi_operation_log (operator, update_column, new_value, old_value, kpi_id) values (\''
		    	.$this->input->post('operator').'\', \'create\' , null, null , '.$kpi_id[0]['kpi_id'].')';

			$query = $this->db->query($myquery);

		    //return $this->db->insert('os_kpi', $data);
		}

		public function update_kpi($kpi_id = FALSE)
		{
			if ($kpi_id !== FALSE)
			{
				// backup history data
			    $myquery = 'insert into  os_kpi_log (kpi_id, picking_error, print_error_app, kpi_rep_date, delivery_missed, delivery_error, picking_total, print_total, delivery_express_receive, picking_missed, delivery_scan_total, operator, print_total_app, delivery_remark, operate_timestamp, print_error) 
			    select kpi_id,picking_error, print_error_app, kpi_rep_date, delivery_missed, delivery_error, picking_total, print_total, delivery_express_receive, picking_missed, delivery_scan_total, operator, print_total_app, delivery_remark, operate_timestamp, print_error from os_kpi ok where kpi_id= '.$kpi_id ;
			    //echo $myquery;
				$query = $this->db->query($myquery);

			    //operation detail log -- os_kpi_operation_log
			    $myquery_log = ' select kpi_id,picking_error, print_error_app, kpi_rep_date, delivery_missed, delivery_error, picking_total, print_total, delivery_express_receive, picking_missed, delivery_scan_total, operator, print_total_app, delivery_remark, operate_timestamp, print_error from os_kpi ok where kpi_id= '.$kpi_id ;
				$query = $this->db->query($myquery_log);
				$result = $query->result_array();

			    $data = array(
		        	'kpi_rep_date' => $this->input->post('kpi_rep_date'),
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

				$string_op_insert = "insert into os_kpi_operation_log (operator, update_column, new_value, old_value, kpi_id) values ";
				$string_op_log = "";
				if($result[0]['kpi_rep_date'] <> $data['kpi_rep_date']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'kpi_rep_date\',\''.$data['kpi_rep_date'].'\',\''.$result[0]['kpi_rep_date'].'\','.$result[0]['kpi_id'].");";
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['print_total'] <> $data['print_total']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'print_total\','.$data['print_total'].','.$result[0]['print_total'].','.$result[0]['kpi_id'].");";
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['print_error'] <> $data['print_error']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'print_total\','.$data['print_total'].','.$result[0]['print_total'].','.$result[0]['kpi_id'].");";
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['print_total_app'] <> $data['print_total_app']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'print_total_app\','.$data['print_total_app'].','.$result[0]['print_total_app'].','.$result[0]['kpi_id'].");";
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['print_error_app'] <> $data['print_error_app']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'print_error_app\','.$data['print_error_app'].','.$result[0]['print_error_app'].','.$result[0]['kpi_id'].");";
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['delivery_scan_total'] <> $data['delivery_scan_total']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'delivery_scan_total\','.$data['delivery_scan_total'].','.$result[0]['delivery_scan_total'].','.$result[0]['kpi_id'].");";
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['delivery_express_receive'] <> $data['delivery_express_receive']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'delivery_express_receive\','.$data['delivery_express_receive'].','.$result[0]['delivery_express_receive'].','.$result[0]['kpi_id'].");";
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['delivery_missed'] <> $data['delivery_missed']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'delivery_missed\','.$data['delivery_missed'].','.$result[0]['delivery_missed'].','.$result[0]['kpi_id'].");";
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['delivery_error'] <> $data['delivery_error']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'delivery_error\','.$data['delivery_error'].','.$result[0]['delivery_error'].','.$result[0]['kpi_id'].");";
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['delivery_remark'] <> $data['delivery_remark']){
					if(empty($result[0]['delivery_remark'])){
						$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'delivery_remark\',\''.$data['delivery_remark'].'\', null ,'.$result[0]['kpi_id'].");";

					} else {
						$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'delivery_remark\',\''.$data['delivery_remark'].'\',\''.$result[0]['delivery_remark'].'\','.$result[0]['kpi_id'].");";
					}
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['picking_total'] <> $data['picking_total']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'picking_total\','.$data['picking_total'].','.$result[0]['picking_total'].','.$result[0]['kpi_id'].");";
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['picking_missed'] <> $data['picking_missed']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'picking_missed\','.$data['picking_missed'].','.$result[0]['picking_missed'].','.$result[0]['kpi_id'].");";
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['picking_error'] <> $data['picking_error']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'picking_error\','.$data['picking_error'].','.$result[0]['picking_error'].','.$result[0]['kpi_id'].");";
					$query = $this->db->query($string_op_log);	
				} 
				if($result[0]['operator'] <> $data['operator']){
					$string_op_log = $string_op_insert.'(\''.$this->input->post('operator').'\',\''.'operator\',\''.$data['operator'].'\',\''.$result[0]['operator'].'\','.$result[0]['kpi_id'].")";
					$query = $this->db->query($string_op_log);	
				} 
			    $this->db->where('kpi_id', $kpi_id);
			    $this->db->update('os_kpi', $data);


			    //return $this->db->insert_id();
		    }
		}


		public function delete_kpi($kpi_id = FALSE)
		{
			if ($kpi_id !== FALSE)
			{
			    $this->db->where('kpi_id', $kpi_id);
			    $this->db->delete('os_kpi');
		    }
		}		

		public function get_kpi_update_history($kpi_id = FALSE)
		{
			if ($kpi_id !== FALSE)
			{
				$myquery = "select 
					case when oko.update_column='kpi_rep_date' then 'KPI 日期'
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
				 from os_kpi_operation_log oko where oko.kpi_id = ".$kpi_id .' order by update_time desc';
				
				$query = $this->db->query($myquery);
	            return $query->result_array();
		    }
		}		

}