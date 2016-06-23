<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use common\models\RefAgama;
use common\models\Provinsi;
use common\models\Kabupaten;
use common\models\Kecamatan;
use common\models\Desa;

// default selected options
$model->id_provinsi = Yii::$app->params['default_kode_provinsi'];
$model->id_kabupaten = Yii::$app->params['default_kode_kabupaten'];

// Options
$list_jenis_kelamin = Yii::$app->params['list_jenis_kelamin'];
$list_agama = ArrayHelper::map(RefAgama::find()->asArray()->all(), 'id', 'nama');
$list_golongan_darah = ArrayHelper::map([['id' => 'A'], ['id' => 'B'], ['id' => 'AB'], ['id' => 'O']], 'id', 'id');
$list_provinsi = ArrayHelper::map(Provinsi::find()->asArray()->all(), 'kode', 'nama');
$list_kabupaten = ArrayHelper::map(Kabupaten::find()->where(['LEFT(kode, 2)' => $model->id_provinsi])->asArray()->all(), 'kode', 'nama');
$list_kecamatan = ArrayHelper::map(Kecamatan::find()->asArray()->all(), 'kode', 'nama');
$list_desa = ArrayHelper::map(Desa::find()->asArray()->all(), 'id', 'nama');

?>

	<div class="col-md-12">
		<div class="panel">
			<div class="box-header">
				<h2 class="box-title">Form Siswa</h2>
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

				    <?= $form->field($model, 'nis')->textInput(['class' => 'form-control', 'style' => 'width:200px;']); ?>
				    <?= $form->field($model, 'nisn')->textInput(['class' => 'form-control', 'style' => 'width:200px;']); ?>
				    <?= $form->field($model, 'nama')->textInput(['class' => 'form-control']); ?>
				    <?= $form->field($model, 'jenis_kelamin')->radioList($list_jenis_kelamin);?>
				    <?= $form->field($model, 'id_ref_agama')->widget(Select2::classname(), [
		                'data' => $list_agama,
		                'options' => [
		                    'placeholder' => 'Pilih Agama', 
		                    'class' => 'form-control sm-input',
		                ],
		                'pluginOptions' => [
		                	'width' => '200px'
		                ]
		            ]);?>
		            <?= $form->field($model, 'tanggal_lahir', [
		            		'inputTemplate' => '<div class="input-group">{input}<div class="input-group-addon"><i class="fa fa-calendar"></i></div></div>'
		            	])->textInput(['class' => 'form-control datepicker', 'value' => Yii::$app->date->konversi_tanggal($model->tanggal_lahir), 'style' => 'width:150px;', 'placeholder' => 'dd/mm/yyyy']);
		            ?>
				    <?= $form->field($model, 'golongan_darah')->radioList($list_golongan_darah);?>
				    <?= $form->field($model, 'alamat')->textInput(['class' => 'form-control']);?>
				    <?= $form->field($model, 'alamat_rt')->textInput(['class' => 'form-control', 'style' => 'width:70px;']);?>
				    <?= $form->field($model, 'alamat_rw')->textInput(['class' => 'form-control', 'style' => 'width:70px;']);?>
				    <?= $form->field($model, 'id_provinsi')->widget(Select2::classname(), [
	                    'data' => $list_provinsi,
	                    'options' => [
	                        'placeholder' => 'Pilih Provinsi', 
	                        'class' => 'form-control md-input',
	                        'disabled'=> true,
	                    ],
	                    'pluginOptions' => [
	                    	'width' => '200px'
	                    ]
	                ]);?>
				    <?= $form->field($model, 'id_kabupaten')->widget(Select2::classname(), [
	                    'data' => $list_kabupaten,
	                    'options' => [
	                        'placeholder' => 'Pilih Kabupaten', 
	                        'class' => 'form-control md-input',
	                        'disabled'=> true,
	                    ],
	                    'pluginOptions' => [
	                    	'width' => '200px'
	                    ]
	                ]);?>
				    <?= $form->field($model, 'id_kecamatan')->widget(DepDrop::classname(), [
	                    'type'=>DepDrop::TYPE_SELECT2,
	                    'data'=> $list_kabupaten,
	                    'options'=>['class'=>'form-control', 'prompt'=>'Pilih Kecamatan'],
	                    'select2Options'=>['pluginOptions'=>['width' => '260px']],
	                    'pluginOptions'=>[
	                        'loadingText'=>'Pilih Kabupaten',
	                        'depends'=>['siswa-id_kabupaten'],
	                        'placeholder'=>'Pilih Kabupaten',
	                        'url'=>Url::to(['/ajax/getkecamatan']),
	                        'initialize'=>true,
	                    ],
	                ]);?>

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