<?php

namespace app\controllers;
use yii\data\ArrayDataProvider;
use yii\httpclient\Client;
use yii\helpers\Json;
use yii\rest\ActiveController;

class PenerbitController extends ActiveController
{
    const BASE_URL = 'http://localhost/brankas-buku/backend/web/api';
    private $_token = null;

    // public function actionIndex()
    // {
       
    //     $client = new Client(['baseUrl' => 'http://localhost/brankas-buku/backend/web/api']);
    //     $response = $client->createRequest()
    //     ->setUrl('index')
    //     ->addHeaders(['content-type' => 'application/json'])
    //     ->send();

    //     $data = Json::decode($response->content, true);

    //     print_R($data); die();

    //     $dataProvider = new ArrayDataProvider([
    //         'allModels' => $data,
    //         'pagination' => [
    //             'pageSize' => 10,
    //         ],
    //     ]);
    //     return $this->render('index', [
    //         'dataProvider' => $dataProvider,
    //     ]);
    // }

    public function actionAuthenticate(){
        $username = 'admin';
        $password = '123456';

        $client = new Client(['baseUrl' => 'http://3.89.215.9/rest-app/web/index.php?r=site%2Flogin']);
        $response = $client->createRequest()
        ->setMethod('POST')
        ->setUrl('login')
        ->setData(['username' => $username, 'password' => $password])
        ->send();

        print_R($response);die();
        if ($response->isOk) {
         $this->_token = $response->data['token'];
            
        }
      }
    
      public function actionIndex(){
        $client = new Client(['baseUrl' => 'http://localhost/rest-app/web/index.php?r=v1/penerbit']);
        $response = $client->createRequest()
        ->setMethod('GET')
        ->setUrl('index')
        ->addHeaders([
            'content-type' => 'application/json',
            //'Authorization' => 'Bearer '.$_token,
        ])
        ->send();
        if ($response->isOk) {
            return $response->getData();
        }
      }

}
