<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
            'title' => 'Cari berdasarkan periode',
            'style' => 'width:200px;'
        ],
        'template' => '<div class="input-group">{input}<span class="input-group-btn"><button type="submit" class="btn btn-sm"><i class="fa fa-search"></i> Cari</button></span></div>',
    ])->label(false); ?>

<?php ActiveForm::end(); ?>

<?php $this->registerJs("
$('#pjax-search').submit(function(){
    $.pjax.reload({
        container:'#pjax-table',
        type:'POST',
        data: $(this).serialize()
    });
    return false;
});", \yii\web\View::POS_END); ?>