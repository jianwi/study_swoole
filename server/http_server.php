<?php
/**
 * Created by PhpStorm
 * User: Dujianjun
 * Date: 2020/5/8
 * Time: 下午4:03
 */

$http = new swoole_http_server("127.0.0.1",'8089',SWOOLE_SOCK_ASYNC,SWOOLE_SOCK_TCP);

$http->set([
    'enable_static_handler' => true,
    'document_root' => "/home/dujianjun/wwwroot/www/html"
]);


$http->on('request',function ($request,$response){

    print_r($request->get);
    $response->cookie("xsd",'xsxs',time()+999);
    $response->end(json_encode($request));
});

$http->start();
