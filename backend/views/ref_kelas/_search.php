<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use common\models\RefJurusan;

$list_jurusan = ArrayHelper::map(RefJurusan::find()->orderBy('nama')->asArray()->all(), 'id', 'nama');

?>
<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'post',
    'id' => 'pjax-search',
    'fieldConfig' => [
        'template' => '{input}'
    ]
]) ?>

<?= $form->field($model, 'id_ref_jurusan')->widget(Select2::classname(), [
                    'data' => $list_jurusan,
                    'options' => ['prompt' => 'Semua Jurusan', 'class' => 'form-control search'],
                    'size' => 'sm',
                    'hideSearch' => true,
                    'pluginOptions'=>[
                        'allowClear' => true,
                        'width' => '250px',
                    ],
                ])->label(false);?>

<?= $form->field($model, 'tingkatan')->widget(Select2::classname(), [
                    'data' => Yii::$app->params['list_tingkatan'],
                    'options' => ['prompt' => 'Semua Tingkatan', 'class' => 'form-control search'],
                    'size' => 'sm',
                    'hideSearch' => true,
                    'pluginOptions'=>[
                        'allowClear' => true,
                        'width' => '140px',
                    ],
                ])->label(false);?>

<?= $form->field($model, 'keyword', [
                'inputOptions' => [
                    'class' => 'form-control input-sm inline tooltips',
                    'placeholder' => 'Cari data...',
                    'title'=>'Cari berdasarkan nama kelas',
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