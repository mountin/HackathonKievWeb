<?php
/**
 * Created by PhpStorm.
 * User: mountin
 * Date: 10.09.15
 * Time: 16:22
 */
//$url = 'http://cleancity.ml:3000/locations';
//$url = 'http://google.com';
//$ggg = file_get_contents($url);
//var_dump($ggg);
//die;
//echo 1234;
$url = 'http://cleancity.ml:3000/locations';
//$ggg = file_get_contents($url);
//var_dump($ggg);
//die;

function curl_get_contents($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

$json = json_decode(curl_get_contents($url));


var_dump($json);
//die;

phpinfo()?>