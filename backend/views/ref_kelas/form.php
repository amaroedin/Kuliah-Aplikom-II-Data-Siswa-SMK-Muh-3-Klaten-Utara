<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use common\models\RefJurusan;

$list_tingkatan = Yii::$app->params['list_tingkatan'];
$list_jurusan = ArrayHelper::map(RefJurusan::find()->orderBy('nama')->asArray()->all(), 'id', 'nama');

?>

	<div class="col-md-12">
		<div class="panel">
			<div class="box-header">
				<h2 class="box-title">Form Kelas</h2>
			</div>
			<div class="box-body">
				<div class="content-box-wrapper">
					<?php $form = ActiveForm::begin([
				        'id' => 'form-layout',
				        'options' => ['class' => 'form-horizontal bordered-row', 'data-pjax' => '0'],
				        'enableAjaxValidation' => true,
				        'enableClientValidation' => false,
				        'validateOnBlur' => false,
				        'validateOnChange' => false,
				        'fieldConfig' => [
				            'template' => "<div class='col-sm-2 text-right'>{label}</div><div class='col-sm-6'>{input}{error}</div>\n",
				        ],
				    ]) ?>

				    <?= $form->field($model, 'id_ref_jurusan')->widget(Select2::classname(), [
		                'data' => $list_jurusan,
		                'options' => [
		                    'placeholder' => 'Pilih Jurusan', 
		                    'class' => 'form-control sm-input',
		                ],
		                'pluginOptions' => [
		                	'width' => '200px'
		                ]
		            ]);?>

		            <?= $form->field($model, 'tingkatan')->radioList($list_tingkatan);?>
		            
		            <?= $form->field($model, 'nama')->textInput(['class' => 'form-control']);?>

		            <?= $form->field($model, 'kapasitas')->textInput(['class' => 'form-control', 'style' => 'width:100px;']);?>

					<div class="form-group">
						<div class="col-sm-9 col-md-offset-2">
							<a href="<?= Url::to([$back_url])?>" class="btn btn-danger">Batal</a>
							<button type="submit" class="btn btn-primary">Simpan</button>
							<button type="reset" class="btn btn-default">Bersihkan</button>
						</div>
					</div>

					<?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
	</div>