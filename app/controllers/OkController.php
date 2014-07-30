<?php

use Jyggen\Curl\Curl;

class OkController extends BaseController
{

    const APP_ID = '1096935936';
    const PUBLIC_KEY = 'CBALOCGCEBABABABA';
    const PRIVATE_KEY = '93D9DB4E54B94F8A8F76DDFD';


    public function index()
    {

        $full_link = 'http://www.odnoklassniki.ru/oauth/authorize?client_id=' . self::APP_ID
            . '&response_type=code&redirect_uri=http://target-green.codio.io:3000/success"';

        $data = array(
            'APP_ID' => self::APP_ID,
            'PUBLIC_KEY' => self::PUBLIC_KEY,
            'PRIVATE_KEY' => self::PRIVATE_KEY,
            'full_link' => $full_link
        );

        return View::make('OK.main', $data);
    }

    public function success()
    {
        if (Input::has('code')) {

            $response = Curl::post('http://api.odnoklassniki.ru/oauth/token.do', 
                                   array(
                                       'code' => Input::get('code'),
                                       'redirect_uri' => 'http://target-green.codio.io:3000/success',
                                       'grant_type' => 'authorization_code',
                                       'client_id' => self::APP_ID,
                                       'client_secret' => self::PRIVATE_KEY
                                   ))[0];
            $content = $response->getContent();
            $response = json_decode($content, true);

            if (isset($response['access_token'])) {
                //md5('application_key=' . $AUTH['application_key'] . 'method=users.getCurrentUser' . md5($auth['access_token'] . $AUTH['client_secret'])));
                $sign = md5("application_key=" . self::PUBLIC_KEY . "method=users.getCurrentUser"
                            . md5($response['access_token'] . self::PRIVATE_KEY));

                $params = array(
                    'method' => 'users.getCurrentUser',
                    'access_token' => $response['access_token'],
                    'application_key' => self::PUBLIC_KEY,
                    'sig' => $sign
                );

                $response = Curl::post('http://api.odnoklassniki.ru/fb.do', $params)[0];
                $userInfo = $response->getContent();
                dd($userInfo);

                if (isset($userInfo['uid'])) {
                    $this->userInfo = $userInfo;
                    $result = true;
                }
            }
        }
    }

}
?>
