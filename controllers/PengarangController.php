<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use yii\httpclient\Client;
use yii\helpers\Json;
use kartik\mpdf\Pdf;
use yii\db\Query;

/**
 * ProposalController implements the CRUD actions for proposal model.
 */
class PengarangController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all proposal models.
     * @return mixed
     */
    public function actionIndex()
    {

        $session = Yii::$app->session['user'];

        $user=[
            'id' => $session['id'],
            'username' => $session['username'],
            'authKey' => $session['authKey'],
            'accessToken' => $session['accessToken'],
          ];

        $token = $user['accessToken'];

        $client = new Client(['baseUrl' => 'http://34.70.203.218/rest-server/web/v1/']);
        $response = $client->createRequest()
            ->setUrl('pengarang')
            ->addHeaders(['content-type' => 'application/json',
                            'Authorization' => 'Bearer '.$token,])
            ->send();
        
        $data = Json::decode($response->content, true);

        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        //$searchModel = new PorposalSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            //'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'data' => $data
            //'newUserId' => $newUserId
        ]);
    }

    /**
     * Displays a single proposal model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new proposal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = Yii::$app->session['user'];

        $user=[
            'id' => $session['id'],
            'username' => $session['username'],
            'authKey' => $session['authKey'],
            'accessToken' => $session['accessToken'],
          ];

        $token = $user['accessToken'];

        $model = new \yii\base\DynamicModel(['id', 'namaPengarang']);
        $model->addRule(['id', 'namaPengarang'], 'safe');

        if ($model->load(Yii::$app->request->post())) {

            $id = $model->id;
            $pengarang = $model->namaPengarang;
            
            $client = new Client(['baseUrl' => 'http://34.70.203.218/rest-server/web/v1/pengarang']);
            $response = $client->createRequest()
                ->setUrl('create')
                ->addHeaders(['content-type' => 'application/json',
                            'Authorization' => 'Bearer '.$token,])
                ->setMethod('post')
                ->setData(['id' => $id, 'namaPengarang' => $pengarang])
                ->send();

            Yii::$app->getSession()->setFlash('success', 'Tambah data berhasil');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing proposal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->row_idx]);
    //     }

    //     return $this->render('update', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Deletes an existing proposal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $session = Yii::$app->session['user'];

        $user=[
            'id' => $session['id'],
            'username' => $session['username'],
            'authKey' => $session['authKey'],
            'accessToken' => $session['accessToken'],
          ];

        $token = $user['accessToken'];  

        $model = new \yii\base\DynamicModel(['id', 'namaPengarang']);
        $model->addRule(['id', 'namaPengarang'], 'safe');
        
        $model->load(Yii::$app->request->post());
        
        $model->id = $id;
        $id = $model->id;
        
        $client = new Client(['baseUrl' => 'http://34.70.203.218/rest-server/web/v1/pengarang']);
        $response = $client->createRequest()
            ->setUrl('delete?id='.$id)
            ->addHeaders(['content-type' => 'application/json',
                        'Authorization' => 'Bearer '.$token,])
            ->setMethod('delete')
            //->setData(['id' => $id])
            ->send();
            
        Yii::$app->getSession()->setFlash('success', 'Hapus data berhasil');
        return $this->redirect(['index']);
        
        
    }

    public function actionUpdate($id)
    {
        $session = Yii::$app->session['user'];

        $user=[
            'id' => $session['id'],
            'username' => $session['username'],
            'authKey' => $session['authKey'],
            'accessToken' => $session['accessToken'],
          ];

        $token = $user['accessToken'];

        $model = new \yii\base\DynamicModel(['id', 'namaPengarang']);
        $model->addRule(['id', 'namaPengarang'], 'safe');

        if ($model->load(Yii::$app->request->post())) {

            $id = $model->id;
            $pengarang = $model->namaPengarang;
            
            $client = new Client(['baseUrl' => 'http://34.70.203.218/rest-server/web/v1/pengarang']);
            $response = $client->createRequest()
                ->setUrl('update?id='.$id)
                ->addHeaders(['content-type' => 'application/json',
                            'Authorization' => 'Bearer '.$token,])
                ->setMethod('patch')
                ->setData(['id' => $id, 'namaPengarang' => $pengarang])
                ->send();
            
                
            Yii::$app->getSession()->setFlash('success', 'Ubah data berhasil');
            return $this->redirect(['index']);
        }
        return $this->render('update', [
            'model' => $model,
            'id' => $id,
        ]);
    }

    /**
     * Finds the proposal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return proposal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = proposal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCetak (){
        

        $client = new Client(['baseUrl' => 'http://developer-smartrembug.herokuapp.com']);
        $response = $client->createRequest()
            ->setUrl('proposals')
            ->addHeaders(['content-type' => 'application/json'])
            ->send();
        
        
        $data = Json::decode($response->content, true);


        $content = $this->renderPartial('cetak',[

            'data' => $data
        ]);

        
    
    // setup kartik\mpdf\Pdf component
    $pdf = new Pdf([
        // set to use core fonts only
        'mode' => Pdf::MODE_CORE, 
        // A4 paper format
        'format' => Pdf::FORMAT_A4, 
        // portrait orientation
        'orientation' => Pdf::ORIENT_LANDSCAPE, 
        // stream to browser inline
        'destination' => Pdf::DEST_BROWSER, 
        // your html content input
        'content' => $content,  
        // format content from your own css file if needed or use the
        // enhanced bootstrap css built by Krajee for mPDF formatting 
        //'cssFile' => '../web/css/table.css',
        // any css to be embedded if required
        'cssInline' => '.kv-heading-1{font-size:14px}', 
         // set mPDF properties on the fly
        'options' => ['title' => 'Smart Rembuk'],
         // call mPDF methods on the fly
        'methods' => [ 
            'SetHeader'=>['Krajee Report Header'], 
            'SetFooter'=>['{PAGENO}'],
        ]
    ]);
    
    // return the pdf output as per the destination setting
    return $pdf->render(); 

    }
}
