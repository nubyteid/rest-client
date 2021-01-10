<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\grid\GridView;;
use yii\widgets\ActiveForm;
?>
<h1>Data Pengarang</h1>

<?php
 echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'idBuku',
        'judul',
        //'penerbit',
        
    ],
]) ?>


