<?php
/**
 * Created by PhpStorm.
 * User: XiMing
 * Date: 15-1-12
 * Time: 下午9:08
 */
require_once('./Util/WeiXinUtil.php');
$client = new WeiXinUtil();
$client->login('email','password');
$client->GetMessage();
do{
    $client->GetMessage();
    sleep(5);// 等待5s
}while(true);