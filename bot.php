<?php


$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'jMLXs4VLjiFgN3zrobgH1z/+DkFDrySHjn8D8dbhIVldXtlmxVOGFZMfVgP8G+E6NzQ8KTdcj4JjaFhj8Pit0sSBcIn6J6NiH1nLLWF6I4swppZmBwUNNvxNNc+4cQkD4E8VOCqfAMnyd4W6nB1kGAdB04t89/1O/w1cDnyilFU='; 
$channelSecret = 'cb54572e6722177f5f61c39cd464e4b7';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array



if ( sizeof($request_array['events']) > 0 ) {

    foreach ($request_array['events'] as $event) {

        $reply_message = '';
        $reply_token = $event['replyToken'];

        $text = $event['message']['text'];
/*
open database
check keyword on database
if yes
   ans questiion
else
        find in google


*/

/* if($text =="test"){
    $text = "Yes";
}else {$text = $event['message']['text'];}
*/

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

echo " 55555ถ ";




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



    return $result;
}

?>