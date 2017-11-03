<?php
include(__DIR__ . '/config.php');

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$receive=$_POST['link'];

$connection = new AMQPStreamConnection(HOST, PORT, USER, PASS, VHOST);
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);
$msg = new AMQPMessage('https://www.youtube.com/watch?v=0CUXEYPHSuI');
$channel->basic_publish($msg, '', 'hello');
echo "Se ha iniciado la descarga", "\n";
$channel->close();
$connection->close();
?>
