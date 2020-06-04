<?php

require '/usr/share/nginx/html/predis/autoload.php';

Predis\Autoloader::register();

$client = new Predis\Client([
    'scheme' => 'tcp',
    'host'   => 'rahul-test.cioygr.0001.aps1.cache.amazonaws.com',
    'port'   => 6379,
]);

$SheetId = $_REQUEST['VideoData'];
$SheetId  = str_replace('||','##',$SheetId);
$client->lpush("TranscodeQueue",$SheetId);

print("VideoData queuued for processing");
?>
