<?php

include(__DIR__ . '/config.php');
include(__DIR__ . '/download.php');

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use YoutubeDl\YoutubeDl;



$connection = new AMQPStreamConnection(HOST, PORT, USER, PASS, VHOST);
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);
echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";
$callback = function($msg) {

  //$msg=strval($msg);

//$msg='https://www.youtube.com/watch?v=tiie82nnXTc';
$dl = new YoutubeDl([
    'continue' => true, // force resume of partially downloaded files. By default, youtube-dl will resume downloads if possible.
    'format' => 'bestvideo',

]);
// For more options go to https://github.com/rg3/youtube-dl#user-content-options

$dl->setDownloadPath('/home/gmarin/Descargas');
// Enable debugging
/*$dl->debug(function ($type, $buffer) {
    if (\Symfony\Component\Process\Process::ERR === $type) {
        echo 'ERR > ' . $buffer;
    } else {
        echo 'OUT > ' . $buffer;

        youtube-dl -o "%(title)s.%(ext)s" -a filename
    }
});*/
try {
    $video = $dl->download($msg->body);
    echo $video->getTitle(), "\n"; // Will return Phonebloks
    echo "Se ha descargado  ",$msg->body,"\n";





    // $video->getFile(); // \SplFileInfo instance of downloaded file
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