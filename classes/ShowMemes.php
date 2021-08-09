<?php

class ShowMemes extends MemeData {
    
    public $userInfo = array();
    public $memeMainPageInfo = array(); 
    public $memeWaitingRoomInfo = array();
    public $memeRandomInfo = array();
    public $tags = array();
    const LIMIT = 8;
    const AVAILABLE_ON_MAIN_PAGE = 0;
    const AVAILABLE_ON_WAITING_ROOM = 1;

    public function __construct($db, $id_user = NULL){
        $getMemesMainPage = $db->getMemes(self::LIMIT, self::AVAILABLE_ON_MAIN_PAGE);
        $getMemesWaitingRoom = $db->getMemes(self::LIMIT, self::AVAILABLE_ON_WAITING_ROOM);

        foreach ($getMemesMainPage as $meme) {
            $meme['json_image_info'] = json_decode($meme['json_image_info']);
            
            $checkIfPlus = $db->execute("
                SELECT *
                FROM plus_count
                WHERE id_image = ".$meme['id']."
                AND id_user = ".$id_user."
            ");

            if ($checkIfPlus->num_rows > 0) {
                $meme['is_plus'] = true;
            }

            array_push($this->memeMainPageInfo, $meme);
        }

        foreach ($getMemesWaitingRoom as $meme) {
            $meme['json_image_info'] = json_decode($meme['json_image_info']);
            $checkIfPlus = $db->execute("
                SELECT *
                FROM plus_count
                WHERE id_image = ".$meme['id']."
                AND id_user = ".$id_user."
            ");

            if ($checkIfPlus->num_rows > 0) {
                $meme['is_plus'] = true;
            }
            
            array_push($this->memeWaitingRoomInfo, $meme);
        }
    }

    public function showMemesOnMainSite() {
        $memes = '';

        foreach ($this->memeMainPageInfo as $meme) {
            $memes .= '
                <div class="imageBox mt-5 mb-5">
                    <div id="rozw_'.$meme['id'].'" class="obrazek_min rounded">
                        <div id="shit" class="w-100">
                            <img id="img_'.$meme['id'].'" class="img-fluid obrazek imageClick rounded" src="img/upload/'.$meme['json_image_info']->image_src.'" onclick="jsObject.imageHandleClick(event)" />
                        </div>
                    </div>
                    <div class="memeInfoBox rounded _visible_hidden" onclick="jsObject.hideMemeInfo(event)">
                        <div class="d-flex headerMemeInfoBox">
                            <div class="d-flex headerMemeInfoBox-userInfo justify-content-start align-items-center">
                                <img class="headerMemeInfoBox-userInfo-userAvatar" src="'.$meme['user_avatar'].'" />
                                <div class="d-flex headerMemeInfoBox-userInfo-usernameBox ml-3 py-1 flex-column">
                                    <div class="d-flex h-100 align-items-center">
                                        <span class="headerMemeInfoBox-userInfo-username">'.$meme['login'].'</span>
                                    </div>
                                    <div class="d-flex h-100 align-items-center">
                                        <span class="headerMemeInfoBox-userInfo-username">'.$this->showData().'</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex headerMemeInfoBox-otherInfo justify-content-end align-items-center">
                                <div class="d-flex align-items-center justify-content-center headerMemeInfoBox-userInfo-plusBox">
                                    <button class="headerMemeInfoBox-userInfo-plus w-100 h-100 px-2 rounded '.($meme['is_plus'] ? "plusBtn-clicked" : "").'" onclick="jsObject.addPlus(event, '.$meme['id'].')">'.$meme['upvote_count'].'</button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex bodyMemeInfoBox">
                            <div class="d-flex bodyMemeInfoBox-firstBox w-100">
                                <div class="d-flex bodyMemeInfoBox-tagsBox flex-wrap">';
                                    foreach ($meme['json_image_info']->tags as $tag) {
                                        $memes .= '<div class="bodyMemeInfoBox-singleTag px-2 py-1 rounded">#'.$tag.'</div>';
                                    } 
                                $memes .= '</div>
                           </div>
                           <div class="d-flex bodyMemeInfoBox-secondBox w-100">
                                <span class="bodyMemeInfoBox-imageDescription">'.$meme['json_image_info']->image_description.'</span>
                           </div>
                        </div>
                    </div>
                </div>
            ';
        }
        
        echo $memes;
    }

    public function showMemesInWaitingRoom() {
        $memes = '';

        foreach ($this->memeWaitingRoomInfo as $meme) {
            $memes .= '
                <div class="imageBox mt-5 mb-5">
                    <div id="rozw_'.$meme['id'].'" class="obrazek_min rounded">
                        <div id="shit" class="w-100">
                            <img id="img_'.$meme['id'].'" class="img-fluid obrazek imageClick rounded" src="img/upload/'.$meme['json_image_info']->image_src.'" onclick="jsObject.imageHandleClick(event)" />
                        </div>
                    </div>
                    <div class="memeInfoBox rounded _visible_hidden" onclick="jsObject.hideMemeInfo(event)">
                        <div class="d-flex headerMemeInfoBox">
                            <div class="d-flex headerMemeInfoBox-userInfo justify-content-start align-items-center">
                                <img class="headerMemeInfoBox-userInfo-userAvatar" src="'.$meme['user_avatar'].'" />
                                <div class="d-flex headerMemeInfoBox-userInfo-usernameBox ml-3 py-1 flex-column">
                                    <div class="d-flex h-100 align-items-center">
                                        <span class="headerMemeInfoBox-userInfo-username">'.$meme['login'].'</span>
                                    </div>
                                    <div class="d-flex h-100 align-items-center">
                                        <span class="headerMemeInfoBox-userInfo-username">'.$this->showData().'</span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex headerMemeInfoBox-otherInfo justify-content-end align-items-center">
                                <div class="d-flex align-items-center justify-content-center headerMemeInfoBox-userInfo-plusBox">
                                    <button class="headerMemeInfoBox-userInfo-plus w-100 h-100 px-2 rounded '.($meme['is_plus'] ? "plusBtn-clicked" : "").'" onclick="jsObject.addPlus(event, '.$meme['id'].')">'.$meme['upvote_count'].'</button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex bodyMemeInfoBox">
                            <div class="d-flex bodyMemeInfoBox-firstBox w-100">
                                <div class="d-flex bodyMemeInfoBox-tagsBox flex-wrap">';
                                    foreach ($meme['json_image_info']->tags as $tag) {
                                        $memes .= '<div class="bodyMemeInfoBox-singleTag px-2 py-1 rounded">#'.$tag.'</div>';
                                    } 
                                $memes .= '</div>
                           </div>
                           <div class="d-flex bodyMemeInfoBox-secondBox w-100">
                                <span class="bodyMemeInfoBox-imageDescription">'.$meme['json_image_info']->image_description.'</span>
                           </div>
                        </div>
                    </div>
                </div>
            ';
        }
        
        echo $memes;
    }

    public function showMemesOnRandomPage() {
        
    }

}