<?php

$api = "bot511184134:AAGtJzt6-tU8UiePf6hHdN_ueBTP-Ny4XxM"; 

$input =  file_get_contents("php://input");
$update = json_decode($input, true);

$message = $update['message']['text'];
$chatid =  $update['message']['chat']['id'];

$user_nick = $update['message']['chat']['username'];

function sendMessage($chatid, $text)
{
	global $api;
	$url = "https://api.telegram.org/$api/sendMessage?chat_id=".$chatid."&text=".urlencode($text);
	file_get_contents($url);
}

function Contact_Admin($User,$msg)
{
	global $api;
	$url = "https://api.telegram.org/$api/sendMessage?chat_id=588950346&text=@".$User.":".urlencode($msg);
	file_get_contents($url);
}

if(strlen($user_nick) >= 4)
{
	switch ($message) 
	{
		case '/start':
			sendMessage($chatid, "Salve, Come posso aiutarla?");
			break;
		case '/my_id':
			sendMessage($chatid, "Il tuo id: ". $chatid);
			break;
		default:
			Contact_Admin($user_nick," ".$message);
			break;
	}
}else
{
	echo "Cosa Cerchi?";
}



//https://api.telegram.org/bot<TOKEN>/setWebHook?url=<URL>

//https://api.telegram.org/bot511184134:AAGtJzt6-tU8UiePf6hHdN_ueBTP-Ny4XxM/sendMessage?chat_id=588950346&text=Hello+Bro
?>