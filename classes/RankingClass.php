<?php 

	class Ranking {

		private $user = array();
		private $count_memes;
		private $count_plus = array();

		public function __construct($db) {

			$placeholderMeme = $db->query("
				SELECT a.login, SUM(b.plusy)
				FROM user a
				INNER JOIN shity b ON b.user_id = a.id
				GROUP BY b.user_id
				ORDER BY SUM(b.plusy) DESC
				LIMIT 100
			");

			foreach ($placeholderMeme as $key => $value) {
				$this->user[$key] = $value['login'];
				$this->count_plus[$key] = $value['SUM(b.plusy)'];
			}
		}

		public function showRanking() {
			$ranking = "";
			
			$countNumber = 1;

			foreach ($this->user as $key => $value) {
				
				if ($countNumber == 1) {
					$podium = ' firstPlace';
				} elseif ($countNumber == 2) {
					$podium = ' secondPlace';
				} elseif ($countNumber == 3) {
					$podium = ' thirdPlace';
				} else {
					$podium = NULL;
				}
				
				$ranking .= "
					<tr class='tableBodyRanking'>
						<th class='text-center".$podium."'>".$countNumber++."</th>
						<th class='pl-4'>".$this->user[$key]."</th>
						<th class='text-center'>".$this->count_plus[$key]."</th>
					</tr>
				";
			}

		echo $ranking;	
		}	

	}

?>