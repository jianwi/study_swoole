<?php
/**
 * Created by PhpStorm
 * User: Dujianjun
 * Date: 2020/5/8
 * Time: 下午3:23
 */
$client = new swoole_client(SWOOLE_SOCK_UDP,SWOOLE_SOCK_SYNC);

if (!$client->connect('127.0.0.1',6677,100)){
    echo '连接失败';
    exit();
}

fwrite(STDOUT,'请输入：');

$msg = fgets(STDIN);


$client->send($msg);

$res = $client->recv();

echo $res;