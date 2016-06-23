<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use common\models\UserGrup;

$list_grup = ArrayHelper::map(UserGrup::find()->orderBy('nama')->asArray()->all(), 'id', 'nama');

?>
<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'post',
    'id' => 'pjax-search',
    'fieldConfig' => [
        'template' => '{input}'
    ]
]) ?>

<?= $form->field($model, 'id_grup')->widget(Select2::classname(), [
                    'data' => $list_grup,
                    'options' => ['prompt' => 'Semua Level', 'class' => 'form-control search'],
                    'size' => 'sm',
                    'hideSearch' => true,
                    'pluginOptions'=>[
                        'allowClear' => true,
                        'width' => '250px',
                    ],
                ])->label(false);?>

<?= $form->field($model, 'keyword', [
                'inputOptions' => [
                    'class' => 'form-control input-sm inline tooltips',
                    'placeholder' => 'Cari data...',
                    'title'=>'Cari berdasarkan username atau nama',
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