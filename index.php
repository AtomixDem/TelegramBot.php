<?php

include 'MessageRequest.php';

$mr = new MessageRequest($_GET['token']);

$content = file_get_contents('php://input');
$update = json_decode($content, TRUE);
$userID = $update['message']['from']['id']; // ID utente
$user = $update['message']['from']['username']; // Username utente
$msg = $update['message']['text']; // Messaggio utente

$callbID = $update['callback_query']['from']['id'];
$callbData = $update['callback_query']['data'];


/*########################### Tastiere ##############################*/
/*
$keyboard = [
    ["Investi", "Contact"],
    ["Pulsate 3"]
];
$menu = array(
    "resize_keyboard" => true,
    "keyboard" => $keyboard
);
$menu = json_encode($menu);
*/
/*########################### Pulsanti ##############################*/

$welcomebuttons = array(array(array( // $welcome è la variabile da utilizzare
    "text" => "🇺🇸 Lingua", "callback_data" => "Languages"
),array(
    "text" => "💎 Bonus", "callback_data" => "BonusWelcome"
)));
$welcome = array("inline_keyboard" => $welcomebuttons);
$welcome = json_encode($welcome);

/*########################### Comandi ##############################*/

if($msg=="/start") {
    $mr->sm($userID, "Benvenuto <b>@".$user."</b>! Qui potrai eseguire delle simulazioni di investimenti grazie alla nostra piattaforma. Ti consigliamo di vederlo più come un gioco e non una demo vera e propria. La moneta principale che userai sono i <b>Gettoni</b> 💎! Riscuoti il bonus cliccando il pulsante qui sotto e ricorda che potrai farlo solo una volta ogni 24H.", "HTML", $welcome);
}


if($msg=="/test") {
    $menu[] = array("voce1");
    $menu[] = array("voce2", "voce3");
}

/*
$keyboard = [
    ["Investi", "Contact"],
    ["Pulsate3"],
];
$menu = array(
    "resize_keyboard" => true,
    "keyboard" => $keyboard
);
$menu = json_encode($menu);


switch($callbData){
    case "Languages":
        $keyboard = [
            ["Investi", "Contact"],
            ["Pulsate 3"]
        ];
        $menu = array(
            "resize_keyboard" => true,
            "keyboard" => $keyboard
        );
        $menu = json_encode($menu);
        $mr->sm($callbID, "Benvenuto", $menu);
    break;
    case "BonusWelcome":
        $mr->sm($callbID, "Hai riscattato il tuo bonus di 500 💎! Il prossimo potrai riscuoterlo tra 24H.");
    break;
}
*/
?>