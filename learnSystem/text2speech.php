<?php

if(isset($_GET['data'])){
    $inputText = json_decode($_GET['data'], true);
    $text = $inputText['vocab'];
    $index = $inputText['index'];
} else {
    //throw exception error
}

$GlobalFileHandle = null;
$username = "apikey";
$password = "-_ZguaOEXWyXuXGi6-ZhQ9UsCIFSHKewtrhS0cBc3-PL"; //api key
$url = 'https://stream.watsonplatform.net/text-to-speech/api/v1/synthesize?voice=en-US_AllisonVoice';
$filename = "../assets/audio/{$text}.wav";

saveRemoteFile($username, $password, $url, $filename, $text);

$object = new stdClass();
$object->audiofile = $filename;
$object->classIndex = $index;

$result = json_encode($object, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);

echo $result;

function saveRemoteFile($username, $password, $url, $filename, $inputText){
    global $GlobalFileHandle;
    set_time_limit(0);

    //Open file for writing
    $GlobalFileHandle = fopen($filename, 'wb');

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_FILE, $GlobalFileHandle);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_BINARYTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, -1);
    curl_setopt($curl, CURLOPT_VERBOSE, false);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, "{\"text\":\"{$inputText}\"}");
    curl_setopt($curl, CURLOPT_USERPWD, $username . ':' . $password);
    
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Accept: audio/ogg;codecs=vorbis';
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($curl, CURLOPT_WRITEFUNCTION, 'curlWriteFile');
    
    curl_exec($curl);
    if (curl_errno($curl)) {
        echo 'Error:' . curl_error($curl);
    }
    curl_close($curl);
    fclose($GlobalFileHandle);
}

function curlWriteFile($cp, $data){
    global $GlobalFileHandle;
    $len = fwrite($GlobalFileHandle, $data);
    return $len;
}


/*$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://stream.watsonplatform.net/text-to-speech/api/v1/synthesize?voice=en-US_AllisonVoice');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"text\":\"Alphabetter\"}");
curl_setopt($ch, CURLOPT_USERPWD, 'apikey' . ':' . '-_ZguaOEXWyXuXGi6-ZhQ9UsCIFSHKewtrhS0cBc3-PL');

$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Accept: audio/ogg;codecs=vorbis';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
*/