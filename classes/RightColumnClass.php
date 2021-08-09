<?php 

	class Meme{

		public $best_meme;
		public $bestMemePlusCount;
		public $best_tags;
		public $logged;
		public $getUser = array();
		
		public function __construct($db, $logged_user = NULL){
			$this->$logged = $logged_user;

			$this->getUser = $db->query("
				SELECT * 
				FROM user
				WHERE id = ".$this->$logged."
			");
		}

		public function add_right_column() {
			if ($this->$logged) {
				$right_column = '
					<div class="rightColumn w-100">
						<div class="rightColumn-First p-4 rounded">
							<div class="d-flex rightColumn-UserInfoBox w-100 justify-content-start align-items-center">
								<img src="'.$this->getUser[0]['user_avatar'].'" width="60px" class="rightColumnClass-UserInfoBox-userAvatar"/>
								<div class="d-flex headerMemeInfoBox-userInfo-usernameBox ml-3 py-1 flex-column">
                                    <div class="d-flex h-100 align-items-center">
                                        <span class="headerMemeInfoBox-userInfo-username">'.$this->getUser[0]['login'].'</span>
                                    </div>
                                    <div class="d-flex h-100 align-items-center">
                                        <span class="headerMemeInfoBox-userInfo-data">'.date('d.m.Y', strtotime($this->getUser[0]['data_zalozenia'])).'</span>
                                    </div>
                                </div
							</div>
						</div>
					</div>
				';
			} else {
				$right_column = '
					<div class="rightColumn w-100">
						<div class="rightColumn-First p-4 rounded">
							<div class="d-flex justify-content-center align-items center">
								<img src="themes/img/logo.png" width="200px"/>
							</div>
							<div class="d-flex justify-content-center align-items center flex-column text-center">
								<a class="btn rightColumnLoginButton" href="/logowanie">Zaloguj</a>
								<span class="mt-2">Nie masz konta? <a href="/rejestracja">Zarejestruj się!</a></span>
							</div>
						</div>
					</div>
				';
			}

			echo $right_column;
		}
	}

?>