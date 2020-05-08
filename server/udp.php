<?php
/**
 * Created by PhpStorm
 * User: Dujianjun
 * Date: 2020/5/8
 * Time: 下午3:19
 */

$server = new Swoole\Server('127.0.0.1',6677,SWOOLE_PROCESS,SWOOLE_SOCK_UDP);

$server->set([
    "worker_num"=>2
]);

$server->on('Packet',function ($serv,$data,$client_info){
    $serv->sendto($client_info['address'],$client_info['port'],"server".$data);
});

$server->start();
