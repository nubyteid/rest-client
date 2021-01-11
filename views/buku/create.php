<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idBuku')?>

    <?= $form->field($model, 'judul') ?>

    <?= $form->field($model, 'idPenerbit')
        ->dropDownList(
            $arrayPenerbit,           // Flat array ('id'=>'label')
            ['prompt'=>'Pilih Penerbit']    // options
        ) ->label('Penerbit'); ?>

<?= $form->field($model, 'idPengarang')
        ->dropDownList(
            $arrayPengarang,           // Flat array ('id'=>'label')
            ['prompt'=>'Pilih Pengarang']    // options
        ) ->label('Pengarang'); ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>