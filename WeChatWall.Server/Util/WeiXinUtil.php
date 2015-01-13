<?php
/**
 * Created by PhpStorm.
 * User: XiMing
 * Date: 15-1-12
 * Time: 下午10:24
 */

require_once('./HttpUtil.php');
require_once('./MongoUtil.php');
class WeiXinUtil{
    private $token;//公共帐号TOKEN
    private $pageSize = 100000;//每页用户数（用于读取所有用户）

    public function __set($property_name, $value) {
        if($property_name=="token"){
            FileUtil::SaveFile("token.txt",$value);
        }
        else{
            $this->property_name = $value;
        }

    }

    public function __get($property_name) {
        if($property_name="token"){
            return FileUtil::GetFile("token.txt");
        }
        else{
            return $this->property_name;
        }
    }
    function login($uemail,$upass){
        $url = 'https://mp.weixin.qq.com/cgi-bin/login?lang=zh_CN';
        $send_data = array(
            'username' => $uemail,
            'pwd' => md5($upass),
            'f' => 'json'
        );
        $httpClient = new HttpUtil();
        $httpClient->referer =  "https://mp.weixin.qq.com/cgi-bin/loginpage?t=wxm2-login&lang=zh_CN";
        $httpClient->getHeader="0";
        $result = $httpClient->PostContent($url,$send_data);
        $bar = json_decode($result);
        if($bar->base_resp->ret==0){
            $this->token = explode('=',explode('&',$bar->redirect_url)[2])[1];
        }else{
            die("登陆失败".$bar->base_resp->err_msg);
        }
    }

    function GetMessage(){
        $url = 'https://mp.weixin.qq.com/cgi-bin/message?t=message/list&count=1000'.'&day=7&token='.$this->token.'&lang=zh_CN';
        $httpClient = new HttpUtil();
        $httpClient->referer =  'https://mp.weixin.qq.com/advanced/autoreply?t=ivr/reply&action=beadded&token='.$this->token.'&lang=zh_CN';
        $httpClient->getHeader="0";
        $result = $httpClient->GetContent($url);
        if(preg_match('/\{\"msg_item\":\[(.*)\]\}/',$result,$matches)){
            $objectres = json_decode($matches[0]);
            $mongoClient = new MongoUtil("testwechat");
            foreach($objectres->msg_item as $object){
                $findres = $mongoClient->finone("message",Array("messageid"=>$object->id));
                if(!isset($findres)){
                    $doc = array(
                        "messageid"=>$object->id,
                        "fakeid" => $object->fakeid,
                        "nick_name" => $object->nick_name,
                        "content" => $object->content,
                        "date_time" => $object->date_time,
                    );
                    $mongoClient->insert("message",$doc);
                }
                else{
                    break;
                }

            }
        }else{
            print_r($result);
        }
    }
}
