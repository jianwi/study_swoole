<?php

$client = new swoole_client(SWOOLE_SOCK_TCP);

 if (!$client->connect('127.0.0.1',9501,50)){
     echo "连接失败";
     exit();
 }


fwrite(STDOUT,'请输入消息:');
$msg = trim(fgets(STDIN));

$resp = $client->send($msg);

echo "resp返回值".$resp;

$result = $client->recv();

echo $result;