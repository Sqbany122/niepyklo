<?php

class UserLoginData {

    private $userId;
    private $userIdShow = array();
    private $userLoginDate = array();
    private $userLoginDataId = array();
    private $ipLocalization = array();
    private $userIp;
    private $userName;

    public function __construct($db, $id = NULL, $user_ip = NULL){
        $this->userId = $id;
        $this->userIp = $user_ip;
        $this->userName = $_SESSION['login'];

        if ($user_ip != NULL) {
            $this->userIp = $user_ip;

            $userLoginResult = $db->query("
                SELECT id
                FROM user_login_data
                WHERE ip = '".$this->userIp."'
                AND id_user = ".$this->userId."
            ");
            
            if ($userLoginResult == NULL) {
                $db->query("
                    INSERT INTO user_login_data (id, id_user, ip , login_date) 
                    VALUES('', '".$this->userId."', '".$this->userIp."', NOW())
                ");
            }     
        }  

        if ($user_ip == NULL) {
            $this->userIp = $_SERVER['REMOTE_ADDR'];

            $userLoginResultShow = $db->query("
                SELECT a.id, a.ip, a.login_date
                FROM user_login_data a
                LEFT JOIN user b ON b.id = a.id_user
                WHERE b.login = ".$this->userName."
                ORDER BY a.id DESC
                LIMIT 5          
            ");

            foreach ($userLoginResultShow as $key => $value) {
                $this->userLoginDataId[$key] = $value['id'];
                $this->userIdShow[$key] = $value['ip'];
                $this->userLoginDate[$key] = $value['login_date'];
                // Sprawdzanie lokalizacji, z której logował się użytkownik ($this->ipLocalization[$key]->city)
                // $this->ipLocalization[$key] = file_get_contents('https://www.iplocate.io/api/lookup/'.$value['ip']);
                // $this->ipLocalization[$key] = json_decode($this->ipLocalization[$key]);
            }
        }
    }

    public function showUserLoginData() {
        $output = "";
        foreach ($this->userLoginDataId as $key => $value) {
            $output .= "
                <tr class='tableRow'>
                    <input id='inputIdValue' type='hidden' value='".$this->userLoginDataId[$key]."' />
                    <td class='userIp' data-ip='".$this->userIdShow[$key]."'>".$this->userIdShow[$key]."</td>
                    <td>".$this->userLoginDate[$key]."</td>
                    <td><button data-id='".$this->userLoginDataId[$key]."' class='btn btn-danger rounded-0 accessDeleteBtn'>Usuń</button></td>
                </tr>
            ";
        }
        echo $output;
    }

}