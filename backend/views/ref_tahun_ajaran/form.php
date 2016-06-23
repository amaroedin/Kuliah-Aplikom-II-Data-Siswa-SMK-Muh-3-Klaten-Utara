<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

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

		            <?= $form->field($model, 'tanggal_awal', [
		            		'inputTemplate' => '<div class="input-group">{input}<div class="input-group-addon"><i class="fa fa-calendar"></i></div></div>'
		            	])->textInput(['class' => 'form-control datepicker', 'value' => Yii::$app->date->konversi_tanggal($model->tanggal_awal), 'style' => 'width:150px;', 'placeholder' => 'dd-mm-yyyy']);
		            ?>
					
		            <?= $form->field($model, 'tanggal_akhir', [
		            		'inputTemplate' => '<div class="input-group">{input}<div class="input-group-addon"><i class="fa fa-calendar"></i></div></div>'
		            	])->textInput(['class' => 'form-control datepicker', 'value' => Yii::$app->date->konversi_tanggal($model->tanggal_akhir), 'style' => 'width:150px;', 'placeholder' => 'dd-mm-yyyy']);
		            ?>

		            <?= $form->field($model, 'periode')->textInput(['class' => 'form-control', 'readonly' => true]);?>

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

	<script type="text/javascript">
		$(function(){
			$('#reftahunajaran-tanggal_awal, #reftahunajaran-tanggal_akhir').change(function(){
				var tgl_awal = $('#reftahunajaran-tanggal_awal').val();
				var tgl_akhir = $('#reftahunajaran-tanggal_akhir').val();
				var tgl_awal_arr = tgl_awal.split('/');
				var tgl_akhir_arr = tgl_akhir.split('/');

				if(tgl_awal && tgl_akhir) {
					var periode = tgl_awal_arr[2]+' - '+tgl_akhir_arr[2];
					$('#reftahunajaran-periode').val(periode);
				}
			});
		});
	</script>