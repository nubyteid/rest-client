<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\grid\GridView;;
use yii\widgets\ActiveForm;
?>
<h1>Data Buku</h1>

<?php
//  echo GridView::widget([
//     'dataProvider' => $dataProvider,
//     'columns' => [
//         'idBuku',
//         'judul',
//         //'penerbit',
        
//     ],
// ]) ?>

<table class = "table table-bordered" id="dtBasicExample">
    
      <br>

      <?= Html::a('<i class = "glyphicon glyphicon-plus"></i> Tambah', ['/buku/create'], ['class'=>'btn btn-primary']) ?>
      <br> <br>
    
      <tr>
        <th> id Buku</th>
        <th>Judul Buku </th>
        <th> Pengarang</th>
        <th> Penerbit</th>
      </tr>

      <?php
       foreach ($data as $result) : ?>
      <tr>
       <?php
        // $a= json_decode('['.$value['penerbit'].']',true);
        if($result['penerbit']) {
            $pengarang[] = $result['pengarang']; }
        if($result['pengarang']) {
            $penerbit[] = $result['penerbit'];   
        } ?>

         <td><?= $result['idBuku']?></td>
         <td><?= $result['judul']?></td>
         <td><?= ($pengarang[0]['namaPengarang'])?></td>
         <td><?= ($penerbit[0]['namaPenerbit'])?></td>
       </tr> 
       <?php endforeach; ?>
       </table>


