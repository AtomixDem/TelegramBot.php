<?php

class MessageRequest {
    private $website;
    public function __construct($token) {
        $this->website = "https://api.telegram.org/bot".$token;
    }

    public function sm($user_id, $message, $mode = "Markdown", $keyboard = null) {
        $req = file_get_contents($this->website."/sendMessage?text=$message&parse_mode=$mode&chat_id=$user_id&reply_markup=$keyboard");
        return $req;
    }
}

?>