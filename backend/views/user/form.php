<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use common\models\UserGrup;

// options dropdown
$list_status = ['1' => 'Aktif', '0' => 'Tidak Aktif'];
$list_grup = ArrayHelper::map(UserGrup::find()->orderBy('nama')->asArray()->all(), 'id', 'nama');

?>

	<div class="col-md-12">
		<div class="panel">
			<div class="box-header">
				<h2 class="box-title">Form Pengguna</h2>
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

				    <?= $form->field($model, 'id_grup')->widget(Select2::classname(), [
		                'data' => $list_grup,
		                'options' => [
		                    'placeholder' => 'Pilih Level', 
		                    'class' => 'form-control sm-input',
		                ],
		                'pluginOptions' => [
		                	'width' => '200px'
		                ]
		            ]);?>

		            <?= $form->field($model, 'nama')->textInput(['class' => 'form-control']);?>
		            <?= $form->field($model, 'username')->textInput(['class' => 'form-control']);?>
		            <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control']);?>
					<?= $form->field($model, 'repeat_password')->passwordInput(['class' => 'form-control']);?>
					<?= $model->id == Yii::$app->user->identity->id ? '' : $form->field($model, 'status')->radioList($list_status);?>

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