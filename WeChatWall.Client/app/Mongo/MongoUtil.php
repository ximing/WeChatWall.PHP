<?php
/**
 * Created by PhpStorm.
 * User: XiMing
 * Date: 15-1-14
 * Time: 下午4:25
 */

class MongoUtil{
    private $connection;
    private $db;
    function __construct($my_db){
        $this->connection = new MongoClient( "mongodb://ip" );
        $this->db = $this->connection->$my_db;
    }

    function getColloction($colloction){
        return $this->db->$colloction;
    }

    function getTop100($colloction){
        $coll = $this->getColloction($colloction);
        $cursor = $coll->find();
        return $cursor;
    }

    function finone($colloction,$doc){
        $res = $this->getColloction($colloction)->findOne($doc);
        return $res;
    }

    function insert($colloction,$doc){
        $coll = $this->getColloction($colloction);
        $coll->insert($doc);
    }
}