<?php
namespace common\components;

use Yii;
use yii\base\Component;

class Auth extends Component {
  const BASE_URL = 'http://localhost/brankas-buku/backend/web/api';
  private $_token = null;

  public function authenticate($username,$password){
    $client = new Client();
    $response = $client->createRequest()
    ->setMethod('POST')
    ->setUrl(BASE_URL.'login')
    ->setData(['username' => $username, 'password' => $password])
    ->send();
    if ($response->isOk) {
        $this->_token = $response->data['token'];
    }
  }

    public function logout(){
      //your logut logic
    }

    public function refreshToken(){
      //your refresh logic 
    }

    public function userList(){
      $client = new Client();
      $response = $client->createRequest()
      ->setMethod('GET')
      ->setUrl(BASE_URL.'/user/users')
      ->addHeaders([
          'content-type' => 'application/json',
          'Authorization' => 'Bearer '.$_token,
      ])
      ->send();
      if ($response->isOk) {
          return $response->getData();
      }
    }
}