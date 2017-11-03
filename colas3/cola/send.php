<?php
include(__DIR__ . '/config.php');

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;



$connection = new AMQPStreamConnection(HOST, PORT, USER, PASS, VHOST);
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);
$msg = new AMQPMessage('https://www.youtube.com/watch?v=oDAw7vW7H0c');
$channel->basic_publish($msg, '', 'hello');
echo " [x] Sent 'https://www.youtube.com/watch?v=oDAw7vW7H0c'\n";
$channel->close();
$connection->close();
?>
