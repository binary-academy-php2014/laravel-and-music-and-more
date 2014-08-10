<?php

namespace Karma\API;

use \User;

class VkontakteAPI extends API implements InterfaceAPI
{
    
    public function __construct()
    {
        $this->apiLink = 'https://api.vk.com/method/';
        $this->applicationKey = \Config::get('app.VKClientId');
        $this->privateKey = \Config::get('app.VKClientSecret');
    }
    
    public function getUserId()
    {
        $params = array(
            'access_token' => $this->getToken(),
            'user_ids'
        );

        $result = $this->APImethod($params);
        return $result['uid'];
    }
    
    public function getUserInfo()
    {
        $userId = \Session::get('user_id');
        $credential = \Karma\Entities\Credential::whereRaw(
            'user_id = ? and social_id = 2', array($userId)
        )->first();
                
        $uid = \Session::get('external_id') or $credential->external_id;
        
        $params = array(
            'user_ids' => $uid,
            'fields' => implode(',', array(
                'city',
                'country',
                'photo_max_orig'
            )),
            'access_token' => $this->getToken()
        );
        
        $info = $this->APImethod($params, 'users.get')['response'][0];
        $result = array(
            'photo' => $info['photo_max_orig'],
            'first_name' => $info['first_name'],
            'last_name' => $info['last_name']
        );
        return $result;
    }
    
    protected function getToken()
    {
        $result;
        if(\Session::has('user_id')){
            $userId = \Session::get('user_id');
            $credential = \Karma\Entities\Credential::whereRaw(
                'user_id = ? and social_id = 2', array($userId)
            )->first();
            if($credential != NULL)
                $result = $credential->access_token;
            else
                $result = \Session::get('accessToken');
        }
        else
            $result = \Session::get('accessToken');
        return $result;
    }
}

?>