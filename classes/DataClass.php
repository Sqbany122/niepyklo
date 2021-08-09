<?php 

	class MemeData{
		public $data;
		public $id = array();

		public function __construct($db, $id){
			$this->id = $id;

			$result = $db->query("
				SELECT upload_date 
				FROM shity 
				WHERE id='$this->id'
			");

			foreach ($result as $value){
				$this->data = $value['upload_date'];
			}
		}

		public function showData(){

			$target = new DateTime($this->data);
			$today = new DateTime(date('Y-m-d\TH:i'));
			$interval = $today->diff($target);

			if ($interval->m < 1 && $interval->y < 1 && $interval->d == 1){
			  $data = $interval->format('%d dzień temu');
			}elseif ($interval->m < 1 && $interval->y < 1 && $interval->d > 1){
			  $data = $interval->format('%d dni temu');
			}elseif ($interval->m == 1 && $interval->y < 1){
			  $data = $interval->format('%m miesiąc temu');
			}elseif ($interval->m > 1 && $interval->m <= 5 && $interval->y < 1){
			  $data = $interval->format('%m miesiące temu');
			}elseif ($interval->m > 5 && $interval->y < 1){
			  $data = $interval->format('%m miesięcy temu');
			}elseif ($interval->m < 1 && $interval->y == 1){
			  $data = $interval->format('%y rok temu');
			}elseif ($interval->m < 1 && $interval->y >= 1){
				$data = $interval->format('%y lata temu');
			}elseif ($interval->m >= 1 && $interval->y >= 1){
				$data = $interval->format('%y lata %m miesiące temu');
			}else{
			  $data = 'przed chwilą';
			}

			$showData = "";
			$showData .= $data;

        	return $showData;
		}

	}

?>