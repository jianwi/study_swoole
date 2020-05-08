<?php
/**
 * Created by PhpStorm
 * User: Dujianjun
 * Date: 2020/5/8
 * Time: 上午12:19
 */

$server = new Swoole\Server("127.0.0.1", 9501);

$server->set([
    "worker_num"=>2
]);
$server->on('connect', function ($server, $fd){
    echo "connection open: {$fd}\n";
});
$server->on('receive', function ($server, $fd, $reactor_id, $data) {
    $server->send($fd, "Swoole: {$data}");
    echo $fd.'---'.$data;
//    $server->close($fd);
});
$server->on('close', function ($server, $fd) {
    echo "connection close: {$fd}\n";
});
$server->start();