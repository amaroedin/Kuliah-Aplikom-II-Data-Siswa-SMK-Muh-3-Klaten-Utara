<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

?>

<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'post',
    'id' => 'pjax-search',
    'fieldConfig' => [
        'template' => '{input}'
    ]
]) ?>

<?= $form->field($model, 'keyword', [
                'inputOptions' => [
                    'class' => 'form-control input-sm inline tooltips',
                    'placeholder' => 'Cari data...',
                    'title'=>'Cari berdasarkan nis, nisn atau nama',
                    'style' => 'width:200px;'
                ],
                'template' => '<div class="input-group">{input}<span class="input-group-btn"><button type="submit" class="btn btn-sm"><i class="fa fa-search"></i> Cari</button></span></div>',
            ])->label(false); ?>

<?php ActiveForm::end(); ?>

<?php $this->registerJs("
$('.search').change(function(){
    $('#pjax-search').submit();
});
$('#pjax-search').submit(function(){
    $.pjax.reload({
        container:'#pjax-table',
        type:'POST',
        data: $(this).serialize()
    });
    return false;
});", \yii\web\View::POS_END); ?>