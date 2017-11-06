<?php

include(__DIR__ . '/config.php');
//DES COMENTAR.
include(__DIR__ . '/download.php');

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use YoutubeDl\YoutubeDl;



$connection = new AMQPStreamConnection(HOST, PORT, USER, PASS, VHOST);
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);
echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";
$callback = function($msg) {


$dl = new YoutubeDl([
    'continue' => true,
    'format' => 'bestvideo',

]);


$dl->setDownloadPath('/home/gmarin/Descargas');
$data=json_decode($msg->body);


try {
    $video = $dl->download($data->link);
  //  echo $video->getTitle(), "\n"; // Will return Phonebloks
    echo "Datos: Id de usuario: ",$data->user_id,"  Link video: ", $data->link," Estado: ",$data->estado,"\n";
    echo "El archivo ha sido Descargado","\n";
    //echo $msg;



} catch (NotFoundException $e) {
    // Video not found
} catch (PrivateVideoException $e) {
    // Video is private
} catch (CopyrightException $e) {
    // The YouTube account associated with this video has been terminated due to multiple third-party notifications of copyright infringement
} catch (\Exception $e) {
    // Failed to download
}

};
$channel->basic_consume('hello', '', false, true, false, false, $callback);
while(count($channel->callbacks)) {
    $channel->wait();
}
$channel->close();
$connection->close();
?>
