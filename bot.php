<?php


$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'rZ7/EDGJkjLRGFHD4+4T1FaJZVxe5JJBkD1jlIp65xVcBUeFbBw8MW7Izfa2uYZjbn6vD5DDKaPoEWKLtG/uDPknX/4RNK6OOg2QVSTJxeKFdWepRdtfaGAc5nC2MZ7RH2u7o5HaRh1o3ihFBKv75AdB04t89/1O/w1cDnyilFU='; 
$channelSecret = '728f18ee485c1db8ed88b0ebf05b3ad5';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array



if ( sizeof($request_array['events']) > 0 ) {

    foreach ($request_array['events'] as $event) {

        $reply_message = '';
        $reply_token = $event['replyToken'];

        $text = $event['message']['text'];
//test///
if($text =="test"){
    $text = "Yes";
}else {$text = $event['message']['text'];}

        $data = [
            'replyToken' => $reply_token,
            // 'messages' => [['type' => 'text', 'text' => json_encode($request_array) ]]  Debug Detail message
            'messages' => [['type' => 'text', 'text' => $text ]]
        ];
        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);

        $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);

        echo "Result: ".$send_result."\r\n";
    }
}

echo " 55555 ";




function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

<<<<<<< HEAD
    if($result="test"){
        $result = "Yes";
=======
    if($text="test"){
        $text = "Yes";
>>>>>>> 85b9b47906335ab4d170bcacd4a3c94d8c939fcd
    }

    return $result;
}

?>