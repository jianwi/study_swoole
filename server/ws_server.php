<?php
$server = new swoole_websocket_server("127.0.0.1",6688);

//监听打开事件
$server->on('open','onOpen');


function onOpen($server,$request)
{
    print_r($request->fd);
}
//监听ws消息事件
$server->on('message',function ($server,$frame){
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},finish:{$frame->finish}";

    print_r($frame);
    $server->push($frame->fd,"singwa-push-success");
    for ($i=0;$i<19;$i++){
        $server->push($frame->fd,"success\n{$frame->fd}:{$frame->data}");
sleep(2);
    }
});

$server->on('close',function ($server,$fd){
    echo "client {$fd} has closed\n";
});

$server->start();