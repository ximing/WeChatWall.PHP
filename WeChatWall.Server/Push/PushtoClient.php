<?php
/**
 * Created by PhpStorm.
 * User: XiMing
 * Date: 2015-01-20
 * Time: 15:39
 */
while(true){
    header("Content-Type:text/event-stream");
    $connection = new MongoClient( "mongodb://ip" );
    $db = $connection->testwechat;
    $coll = $db->pushqueue;
    $cursor = $coll->findOne();
    if($cursor!=null){
        echo 'data:' .json_encode($cursor);
        echo "\n\n";
        ob_flush();
        flush();
        print_r($cursor);
        $coll->remove(array("messageid",$cursor['messageid']));
        sleep(1);
    }

}
