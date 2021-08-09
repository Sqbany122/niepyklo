<?php 

	class Report {

		public $report = array();
		public $report_user = array();
		public $report_date = array();

		public function __construct($db){
			$result = $db->query("SELECT * FROM contact_case ORDER BY id ASC");

				foreach ($result as $key => $value) {
					$this->report[$key] = $value['single_case'];
					$this->report_user[$key] = $value['user'];
					$this->report_date[$key] = $value['add_date'];
				}
		}	

		public function showReport() {

			$showReport = "";

			foreach ($this->report as $key => $value) {
				$showReport .= "<tr>
				<td>".$this->report[$key]."</td>
				<td>".$this->report_user[$key]."</td>
				<td>".$this->report_date[$key]."</td>
				</tr>";
			}
		
			echo $showReport;
		}

	}

?>