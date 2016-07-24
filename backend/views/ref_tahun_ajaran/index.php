<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

?>

<div class="col-md-12">
	<div class="panel">
		<div class="box-header">
			<div class="pull-left">
				<?= Html::a('<i class="fa fa-plus"></i> Tambah Data', ['create'], ['class' => 'btn btn-success btn-sm']);?>
				<?= Html::a('Hapus Data', 'javascript:delete_all()', ['class' => 'btn btn-danger btn-sm confirmation btn_delete_all']);?>
			</div>
			<div class="pull-right">
				<?= $this->render('_search', [
									'model' => $searchModel
					]);?>
			</div>
			<div class="clearfix"></div>
		</div>

		<?php Pjax::begin(['id' => 'pjax-table', 'clientOptions' => ['method' => 'POST']]); ?>
			<?= GridView::widget([
				'id' => 'table-view-grid',
				'tableOptions' => ['class' => 'table table-responsive table-striped table_content'],
				'layout' => '<div class="box-body">
								<div class="content-box-wrapper">
									{items}
								</div>
							</div>
							<div class="box-footer clearfix">
								<div class="pull-left">
									{pager}
								</div>
								<div class="pull-right">{summary}</div>
							</div>',
				'dataProvider' => $dataProvider,
	            'columns' => [
	                ['class' => 'yii\grid\SerialColumn',
	                        'header' => 'No',
	                        'options' => ['style' => 'width:20px;']
	                ],

	                [
	                	'class' => 'yii\grid\CheckboxColumn',
	                    'header'=> '<input type="checkbox" class="checkall">',
	                    'headerOptions'=> ["style"=>"width:10px;text-align:center;"],
	                    'checkboxOptions' => function ($model, $key, $index, $column) {
	                    	// if(($model->tahun_awal == date('Y')-1) && ($model->tahun_akhir == date('Y'))) {
	                    	// 	return ['hidden' => true];
	                    	// }else{
	                    		return ['class' => 'checkbox_delete_all', 'id'=>$model->id];
	                    	// }
	                    }
	                ],

	                [
	                	'class' => 'yii\grid\ActionColumn',
	                    'header' => 'Aksi',
	                    'headerOptions' => ['style' => 'width:1%;text-align:center'],
	                    'contentOptions' => ["style"=>"text-align:center;white-space:nowrap;", 'class' => 'action'],
	                    'template' => '{update} {delete}',
	                    'buttons' => [
	                    	'update' => function($url, $model, $key) {
	                    		return Html::a('<i class="fa fa-edit"></i>', $url, [
			                    			'title' => Yii::t('yii', 'Edit'),
			                    			'class' => 'btn-circle tooltips',
			                    			'data-pjax' => '0'
			                    		]);
	                    	},
	                    	'delete' => function($url, $model, $key) {
	                    		/*return (($model->tahun_awal != date('Y')-1) && ($model->tahun_akhir != date('Y'))) ? Html::a('<i class="fa fa-trash-o"></i>', $url, [
	                    					'title' => Yii::t('yii', 'Hapus'),
	                    					'class' => 'btn-circle tooltips',
	                    					'data-pjax' => '0'
	                    				]) : '';*/

								return Html::a('<i class="fa fa-trash-o"></i>', $url, [
	                    					'title' => Yii::t('yii', 'Hapus'),
	                    					'class' => 'btn-circle tooltips confirmation',
	                    					'data-pjax' => '0'
	                    				]);
	                    	}
	                    ]
	                ],

	                ['headerOptions' => ['align' => 'left'],
	                	'attribute' => 'periode'
	                ],

	                ['headerOptions' => ['align' => 'left'],
	                	'attribute' => 'tanggal_awal',
	                	'value' => function($model) {
	                		return $model->tanggal_awal ? Yii::$app->date->format_tanggal($model->tanggal_awal) : '-';
	                	}
	                ],

	                ['headerOptions' => ['align' => 'left'],
	                	'attribute' => 'tanggal_akhir',
	                	'value' => function($model) {
	                		return $model->tanggal_akhir ? Yii::$app->date->format_tanggal($model->tanggal_akhir) : '-';
	                	}
	                ]
	            ],
	            'pager' => [
	                'prevPageLabel' => '&lsaquo;',  
	                'nextPageLabel' => '&rsaquo;',  
	                'firstPageLabel'=>'&laquo;',  
	                'lastPageLabel'=>'&raquo;',   
	                'maxButtonCount'=>Yii::$app->params['paging']['maxButtonCount'],
                ],
			]);?>
		<?php Pjax::end();?>
	</div>
</div>