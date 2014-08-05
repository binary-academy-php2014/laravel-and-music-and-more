<?php

namespace Karma\API;

class FacebookAPI extends API implements InterfaceAPI
{

    public function __construct()
    {
        $this->apiLink = 'https://graph.facebook.com/';
        $this->applicationKey = '1446675095605125';
        $this->privateKey = 'e98bafaf60c6c78104df3de28339acdb';
        $this->accessToken = '1446675095605125|hqta5wV-Dyc6sLC-50h364tujAE';
    }

    public function getUserId()
    {
        $result = $this->APImethodGet(array(), "debug_token?input_token="
                                      . $this->getToken()
                                      . '&access_token=' . $this->accessToken);
        return $result['data']['user_id'];
    }

    public function getUserInfo()
    {

        $params = array(
            'access_token' => $this->getToken()
        );

        //var_dump($params);

        $result = $this->APImethodGet($params, 'me');
        $result['photo'] = $this->getUserAvatar();
        return $result;
    }

    protected function getToken()
    {
        $result;
        if(\Session::has('user_id')){
            $userId = \Session::get('user_id');
            $credential = \Karma\Entities\Credential::whereRaw(
                'user_id = ? and social_id = 1', array($userId)
            )->first();
            if($credential != NULL)
                $result = $credential->token;
            else
                $result = \Session::get('accessToken');
        }
        else
            $result = \Session::get('accessToken');
        return $result;
    }

    private function getUserAvatar()
    {
        $params = array(
            'access_token' => $this->getToken(),
            'type' => 'large',
            'redirect' => 0
        );

        $result = $this->APImethodGet($params, 'me/picture');
        return $result['data']['url'];
    }
    
}

?>