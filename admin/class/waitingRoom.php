<?php

class WaitingRoom {
    public $memes = array();


    public function __construct($db){
        $memes = $db->adminWaitingRoomMemes();

        foreach ($memes as $meme) {
            $meme['json_image_info'] = json_decode($meme['json_image_info']);

            array_push($this->memes, $meme);
        }
    }

    public function showMemesAdminWaitingRoom() {
        $memes = '';

        foreach ($this->memes as $meme) {
            $memes .= '
                <div class="waitingRoom-singleImage">
                    <img class="w-100 h-100 rounded" src="/img/upload/'.$meme['json_image_info']->image_src.'" />
                    <div class="d-flex waitingRoom-singleImage-infoBox p-2">
                        <div class="waitingRoom-singleImage-infoBox-userInfo w-100 d-flex flex-column text-left">
                            <div>Użytkownik: '.$meme['login'].'</div>
                            <div>Data dodania: '.$meme['upload_date'].'</div>
                                <div>Tagi: ';

                                    foreach ($meme['json_image_info']->tags as $tag) {
                                        $memes .= '<span class="mr-2">#'.$tag.'</span>';
                                    }

                        $memes .= '</div>
                            <div>Opis mema: '.$meme['json_image_info']->image_description.'</div>
                        </div>
                    </div>
                </div>
            ';
        }

        echo $memes;
    }
}