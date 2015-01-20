<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
include __DIR__ . '/Mongo/MongoUtil.php';
Route::get('/', function () {
    $mongoClient = new MongoUtil('testwechat');
    $list = $mongoClient->getTop100('message');
    return View::make('hello')->with('list', $list);
});

Route::get('add/{id}', function ($id) {
    $mongoClient = new MongoUtil('testwechat');
    $querydoc = array('_id' => new MongoId($id));
    $queryres = $mongoClient->finone('message', $querydoc);
    if($queryres!=null){
        $doc = array(
            'messageid' => $queryres['messageid'],
            'fakeid' => $queryres['fakeid'],
            'nick_name' => $queryres['nick_name'],
            'content' => $queryres['content']
        );
        $mongoClient->insert('pushqueue', $doc);
    }
    return  Redirect::to('/');
});