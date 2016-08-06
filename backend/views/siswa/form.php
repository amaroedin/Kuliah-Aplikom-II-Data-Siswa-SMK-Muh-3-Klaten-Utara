<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use kartik\widgets\DepDrop;
use yii\helpers\ArrayHelper;
use common\models\RefJurusan;
use common\models\RefAgama;
use common\models\Provinsi;
use common\models\Kabupaten;
use common\models\Kecamatan;
use common\models\Desa;
use common\models\RefAsalSekolah;
use common\models\RefJenisTinggal;
use common\models\RefAlatTransportasi;
use common\models\RefPendidikan;
use common\models\RefPenghasilan;
use common\models\RefJenisKartuBsm;
use common\models\RefKelas;
use common\models\RefTahunAjaran;

// default selected options
$model->id_provinsi = Yii::$app->params['default_kode_provinsi'];
$model->id_kabupaten = Yii::$app->params['default_kode_kabupaten'];

// Options
$list_status = Yii::$app->params['list_status'];
$list_jenis_kelamin = Yii::$app->params['list_jenis_kelamin'];
$list_tahun = Yii::$app->date->list_tahun(date("Y") - 20, 1920);
$list_agama = ArrayHelper::map(RefAgama::find()->asArray()->all(), 'id', 'nama');
$list_golongan_darah = ArrayHelper::map([['id' => 'A'], ['id' => 'B'], ['id' => 'AB'], ['id' => 'O']], 'id', 'id');
$list_provinsi = ArrayHelper::map(Provinsi::find()->asArray()->all(), 'kode', 'nama');
$list_kabupaten = ArrayHelper::map(Kabupaten::find()->where(['LEFT(kode, 2)' => $model->id_provinsi])->asArray()->all(), 'kode', 'nama');
$list_asal_sekolah = ArrayHelper::map(RefAsalSekolah::find()->asArray()->all(), 'id', 'nama');
$list_jenis_tinggal = ArrayHelper::map(RefJenisTinggal::find()->asArray()->all(), 'id', 'nama');
$list_alat_transportasi = ArrayHelper::map(RefAlatTransportasi::find()->asArray()->all(), 'id', 'nama');
$list_pendidikan = ArrayHelper::map(RefPendidikan::find()->asArray()->all(), 'id', 'nama');
$list_penghasilan = ArrayHelper::map(RefPenghasilan::find()->asArray()->all(), 'id', 'nominal');
$list_jurusan = ArrayHelper::map(RefJurusan::find()->asArray()->all(), 'id', 'nama');
$list_jenis_kartu = ArrayHelper::map(RefJenisKartuBsm::find()->asArray()->all(), 'id', 'nama');
$list_kelas = ArrayHelper::map(RefKelas::find()->asArray()->all(), 'id', 'nama');
$list_tahun_ajaran = ArrayHelper::map(RefTahunAjaran::find()->asArray()->all(), 'id', 'periode');

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

				    <div class="form-group">
				    	<div class="col-sm-9">
				    		<label class="label-control"><h3>Biodata Siswa</h3></label>
				    	</div>
				    </div>

				    <?php// = $form->errorSummary($model); ?>

				    <?= $form->field($model, 'id_tahun_ajaran')->widget(Select2::classname(), [
	                    'data' => $list_tahun_ajaran,
	                    'options' => [
	                        'placeholder' => 'Pilih Tahun Ajaran', 
	                        'class' => 'form-control md-input',
	                    ],
	                    'pluginOptions' => [
	                    	'width' => '200px'
	                    ]
	                ]);?>

				    <?= $form->field($model, 'id_kelas')->widget(Select2::classname(), [
	                    'data' => $list_kelas,
	                    'options' => [
	                        'placeholder' => 'Pilih Kelas', 
	                        'class' => 'form-control md-input',
	                    ],
	                    'pluginOptions' => [
	                    	'width' => '200px'
	                    ]
	                ]);?>

				    <?= $form->field($model, 'id_ref_jurusan')->widget(Select2::classname(), [
	                    'data' => $list_jurusan,
	                    'options' => [
	                        'placeholder' => 'Pilih Jurusan', 
	                        'class' => 'form-control md-input',
	                    ],
	                    'pluginOptions' => [
	                    	'width' => '200px'
	                    ]
	                ]);?>

				    <?= $form->field($model, 'nis')->textInput(['class' => 'form-control', 'style' => 'width:300px;']); ?>
				    <?= $form->field($model, 'nisn')->textInput(['class' => 'form-control', 'style' => 'width:300px;']); ?>
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
				    <?= $form->field($model, 'tempat_lahir')->textInput(['class' => 'form-control', 'style' => 'width:200px;']); ?>
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
				    <?= $form->field($model, 'idKecamatan')->widget(DepDrop::classname(), [
	                    'type'=>DepDrop::TYPE_SELECT2,
	                    'data'=> array(),
	                    'options'=>['class'=>'form-control', 'prompt'=>'Pilih Kecamatan'],
	                    'select2Options'=>['pluginOptions'=>['width' => '260px']],
	                    'pluginOptions'=>[
	                        'loadingText'=>'Pilih Kecamatan',
	                        'depends'=>['siswa-id_kabupaten'],
	                        'placeholder'=>'Pilih Kecamatan',
	                        'url'=>Url::to(['/ajax/getkecamatan']),
	                        'initialize'=>true,
	                    ],
	                ]);?>
				    <?= $form->field($model, 'id_desa')->widget(DepDrop::classname(), [
	                    'type'=>DepDrop::TYPE_SELECT2,
	                    'data'=> array(),
	                    'options'=>['class'=>'form-control', 'prompt'=>'Pilih Desa'],
	                    'select2Options'=>['pluginOptions'=>['width' => '260px']],
	                    'pluginOptions'=>[
	                        'loadingText'=>'Pilih Desa',
	                        'depends'=>['siswa-idkecamatan'],
	                        'placeholder'=>'Pilih Desa',
	                        'url'=>Url::to(['/ajax/getdesa']),
	                        'initialize'=>true,
	                    ],
	                ]);?>
	                <?= $form->field($model, 'kode_pos')->textInput(['class' => 'form-control', 'style' => 'width:100px;']);?>
	                <?= $form->field($model, 'no_telpon')->textInput(['class' => 'form-control', 'style' => 'width:330px;'])->label('No Telpon / HP');?>
	                <?= $form->field($model, 'email')->textInput(['class' => 'form-control', 'style' => 'width:330px;']);?>
	                <?= $form->field($model, 'nik')->textInput(['class' => 'form-control', 'style' => 'width:250px;']);?>
	                <?= $form->field($model, 'nomor_skhun')->textInput(['class' => 'form-control', 'style' => 'width:250px;']);?>
				    <?= $form->field($model, 'kebutuhan_khusus')->widget(Select2::classname(), [
	                    'data' => $list_status,
	                    'options' => [
	                        'class' => 'form-control md-input',
	                    ],
	                    'pluginOptions' => [
	                    	'width' => '100px'
	                    ]
	                ]);?>
	                <?= $form->field($model, 'tinggi_badan', [
	                	'inputTemplate' => '<div class="input-group">{input}<div class="input-group-addon"><strong>cm</strong></div></div>'
	                ])->textInput(['class' => 'form-control', 'style' => 'width:80px;']);?>
	                <?= $form->field($model, 'berat_badan', [
	                	'inputTemplate' => '<div class="input-group">{input}<div class="input-group-addon"><strong>kg</strong></div></div>'
	                ])->textInput(['class' => 'form-control', 'style' => 'width:80px;']);?>
				    <?= $form->field($model, 'id_ref_jenis_tinggal')->widget(Select2::classname(), [
	                    'data' => $list_jenis_tinggal,
	                    'options' => [
	                        'placeholder' => 'Pilih Jenis Tinggal', 
	                        'class' => 'form-control md-input',
	                    ],
	                    'pluginOptions' => [
	                    	'width' => '300px'
	                    ]
	                ]);?>
	                <?= $form->field($model, 'id_ref_alat_transportasi')->widget(Select2::classname(), [
	                    'data' => $list_alat_transportasi,
	                    'options' => [
	                        'placeholder' => 'Pilih Alat Transportasi', 
	                        'class' => 'form-control md-input',
	                    ],
	                    'pluginOptions' => [
	                    	'width' => '300px'
	                    ]
	                ]);?>
				    <?= $form->field($model, 'status_kps')->widget(Select2::classname(), [
	                    'data' => $list_status,
	                    'options' => [
	                        'class' => 'form-control md-input',
	                    ],
	                    'pluginOptions' => [
	                    	'width' => '100px'
	                    ]
	                ]);?>
	                <?= $form->field($model, 'nomor_kps')->textInput(['class' => 'form-control', 'style' => 'width:250px;']);?>
				    <?= $form->field($model, 'id_jenis_kartu_bsm')->widget(Select2::classname(), [
	                    'data' => $list_jenis_kartu,
	                    'options' => [
	                        'placeholder' => 'Pilih Jenis Kartu', 
	                        'class' => 'form-control md-input'
	                    ],
	                    'pluginOptions' => [
	                    	'width' => '200px'
	                    ]
	                ]);?>
	                <?= $form->field($model, 'nomor_kartu_bsm')->textInput(['class' => 'form-control', 'style' => 'width:250px;']);?>
				    <?= $form->field($model, 'id_ref_asal_sekolah')->widget(Select2::classname(), [
	                    'data' => $list_asal_sekolah,
	                    'options' => [
	                        'placeholder' => 'Pilih Asal Sekolah', 
	                        'class' => 'form-control md-input',
	                    ],
	                    'pluginOptions' => [
	                    	'width' => '300px'
	                    ]
	                ]);?>
	                <?= $form->field($model, 'nomor_peserta_un_smp')->textInput(['class' => 'form-control', 'style' => 'width:250px;']);?>
	                <?= $form->field($model, 'nomor_skhun')->textInput(['class' => 'form-control', 'style' => 'width:250px;']);?>
	                
	                <div class="form-group">
				    	<div class="col-sm-9">
				    		<label class="label-control"><h3>Data Ayah</h3></label>
				    	</div>
				    </div>

	                <?= $form->field($modelOrtu, 'nama_ayah')->textInput(['class' => 'form-control']);?>
	                <?= $form->field($modelOrtu, 'tahun_lahir_ayah')->widget(Select2::classname(), [
	                    'data' => $list_tahun,
	                    'options' => [
	                        'placeholder' => 'Pilih Tahun', 
	                        'class' => 'form-control md-input',
	                    ],
	                    'pluginOptions' => [
	                    	'width' => '150px'
	                    ]
	                ]);?>
	                <?= $form->field($modelOrtu, 'id_ref_pendidikan_ayah')->widget(Select2::classname(), [
	                    'data' => $list_pendidikan,
	                    'options' => [
	                        'placeholder' => 'Pilih Pendidikan', 
	                        'class' => 'form-control md-input',
	                    ],
	                    'pluginOptions' => [
	                    	'width' => '300px'
	                    ]
	                ]);?>
	                <?= $form->field($modelOrtu, 'pekerjaan_ayah')->textInput(['class' => 'form-control', 'style' => 'width:300px;']);?>
	                <?= $form->field($modelOrtu, 'id_ref_penghasilan_ayah')->widget(Select2::classname(), [
	                    'data' => $list_penghasilan,
	                    'options' => [
	                        'placeholder' => 'Pilih Penghasilan', 
	                        'class' => 'form-control md-input',
	                    ],
	                    'pluginOptions' => [
	                    	'width' => '300px'
	                    ]
	                ]);?>

	                <div class="form-group">
				    	<div class="col-sm-9">
				    		<label class="label-control"><h3>Data Ibu</h3></label>
				    	</div>
				    </div>

				    <?= $form->field($modelOrtu, 'nama_ibu')->textInput(['class' => 'form-control']);?>
	                <?= $form->field($modelOrtu, 'tahun_lahir_ibu')->widget(Select2::classname(), [
	                    'data' => $list_tahun,
	                    'options' => [
	                        'placeholder' => 'Pilih Tahun', 
	                        'class' => 'form-control md-input',
	                    ],
	                    'pluginOptions' => [
	                    	'width' => '150px'
	                    ]
	                ]);?>
	                <?= $form->field($modelOrtu, 'id_ref_pendidikan_ibu')->widget(Select2::classname(), [
	                    'data' => $list_pendidikan,
	                    'options' => [
	                        'placeholder' => 'Pilih Pendidikan', 
	                        'class' => 'form-control md-input',
	                    ],
	                    'pluginOptions' => [
	                    	'width' => '300px'
	                    ]
	                ]);?>
	                <?= $form->field($modelOrtu, 'pekerjaan_ibu')->textInput(['class' => 'form-control', 'style' => 'width:300px;']);?>
	                <?= $form->field($modelOrtu, 'id_ref_penghasilan_ibu')->widget(Select2::classname(), [
	                    'data' => $list_penghasilan,
	                    'options' => [
	                        'placeholder' => 'Pilih Penghasilan', 
	                        'class' => 'form-control md-input',
	                    ],
	                    'pluginOptions' => [
	                    	'width' => '300px'
	                    ]
	                ]);?>


	                <div class="form-group">
				    	<div class="col-sm-9">
				    		<label class="label-control"><h3>Data Wali</h3></label>
				    	</div>
				    </div>

				    <?= $form->field($modelOrtu, 'nama_wali')->textInput(['class' => 'form-control']);?>
	                <?= $form->field($modelOrtu, 'tahun_lahir_wali')->widget(Select2::classname(), [
	                    'data' => $list_tahun,
	                    'options' => [
	                        'placeholder' => 'Pilih Tahun', 
	                        'class' => 'form-control md-input',
	                    ],
	                    'pluginOptions' => [
	                    	'width' => '150px'
	                    ]
	                ]);?>
	                <?= $form->field($modelOrtu, 'id_ref_pendidikan_wali')->widget(Select2::classname(), [
	                    'data' => $list_pendidikan,
	                    'options' => [
	                        'placeholder' => 'Pilih Pendidikan', 
	                        'class' => 'form-control md-input',
	                    ],
	                    'pluginOptions' => [
	                    	'width' => '300px'
	                    ]
	                ]);?>
	                <?= $form->field($modelOrtu, 'pekerjaan_wali')->textInput(['class' => 'form-control', 'style' => 'width:300px;']);?>
	                <?= $form->field($modelOrtu, 'id_ref_penghasilan_wali')->widget(Select2::classname(), [
	                    'data' => $list_penghasilan,
	                    'options' => [
	                        'placeholder' => 'Pilih Penghasilan', 
	                        'class' => 'form-control md-input',
	                    ],
	                    'pluginOptions' => [
	                    	'width' => '300px'
	                    ]
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

	<script type="text/javascript">
		$(function(){

		});
	</script>