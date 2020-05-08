<?php

class Ws
{
    CONST HOST = "0.0.0.0";
    CONST PORT = 8812;

    public $ws = null;

    public function __construct()
    {
        $this->ws = new swoole_websocket_server(self::HOST,self::PORT);

        $this->ws->on("open",[$this, 'onOpen']);
        $this->ws->on("message", [$this, 'onMessage']);
        $this->ws->on("close",[$this, "onClose"]);
        $this->ws->start();
    }

    /**
     * 监听 ws 连接事件
     * @param $ws
     * @param $request
     */
    public function onOpen($ws, $request)
    {
        var_dump($request->fd);
    }

    /**
     * 监听 ws 消息事件
     * @param $ws
     * @param $request
     */
    public function onMessage($ws,$frame)
    {
        echo "ser-push-message:{$frame->data}\n";

        $ws->push($frame->fd, "server-push:".date("Y-m-d H:i:s"));

    }

    /**
     * 监听 ws 关闭事件
     * @param $ws
     * @param $fd
     */
    public function onClose($ws,$fd)
    {
        echo "client_id:{$fd},closed";
    }
}

$obj = new Ws();