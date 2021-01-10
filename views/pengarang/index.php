<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\grid\GridView;;
use yii\widgets\ActiveForm;
?>
<h1>Data Pengarang</h1>

<?php
//  GridView::widget([
//     'dataProvider' => $dataProvider,
//     'columns' => [
//         'idPenerbit',
//         'namaPenerbit',
//         []
        
//     ],
// ]) ?>


<table class = "table table-bordered" id="dtBasicExample">
    
      <br>

      <?= Html::a('<i class = "glyphicon glyphicon-plus"></i> Tambah', ['/pengarang/create'], ['class'=>'btn btn-primary']) ?>
      <br> <br>
    
      <tr>
        <th> id </th>
        <th> Nama Pengarang </th>
        <th></th>
       
      </tr>

      <?php
       foreach ($data as $value) : ?>
        <tr>
        <td> <?= $value ['id']; ?></td>
        <td> <?= $value ['namaPengarang']; ?></td>

        <td> 
        <?php $form = ActiveForm::begin(); ?>
        <?= Html::a('<i class = "glyphicon glyphicon-remove"></i> Hapus', ['pengarang/delete', 'id' => $value['id']], [
                'class' => 'btn btn-sm btn-danger',
                'data-confirm' => 'Are you sure?',
                'data-method' => 'post',
            ]) ?>
        <?php ActiveForm::end(); ?>

        <?= Html::a('<i class = "glyphicon glyphicon-pencil"></i> Ubah', ['pengarang/update', 'id' => $value['id']], [
                'class' => 'btn btn-sm btn-success'
            ]) ?>

      </td>
      
       </tr>
       <?php endforeach ?>
       </table>