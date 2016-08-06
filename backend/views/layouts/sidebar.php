<?php
    use yii\helpers\Url;
    use yii\widgets\Menu;

    $user_grup = Yii::$app->user->identity->idGrup;
?>

	<?= Menu::widget([
            'encodeLabels' => false,
            'activateItems' => true,
            'activateParents' => true,
            'options' => [
        			    	'class' => 'sidebar-menu'
        			    ],
            'items' => [
	            [
	                'label' => '<i class="fa fa-desktop"></i>Dashboard', 
	                'url' => ['/'],
	                'visible' => Yii::$app->user->isAdmin()
	            ],

	            [
	            	'label' => '<i class="fa fa-cubes"></i>Pengaturan<span class="fa fa-angle-left pull-right"></span>',
	            	'url' => '#',
	            	'options' => ['class' => 'treeview'],
	            	'items' => [
		            	[
		            		'label' => 'Tahun Ajaran',
		            		'url' => ['/ref_tahun_ajaran/clear'],
		            		'visible' => Yii::$app->user->isAdmin()
		            	],

		            	[
		            		'label' => 'Kelas',
		            		'url' => ['/ref_kelas/clear'],
		            		'visible' => Yii::$app->user->isAdmin()
		            	],

		            	[
		            		'label' => 'Jurusan',
		            		'url' => ['/ref_jurusan/clear'],
		            		'visible' => Yii::$app->user->isAdmin()
		            	],

		            	[
		            		'label' => 'Asal Sekolah',
		            		'url' => ['/ref_asal_sekolah/clear'],
		            		'visible' => Yii::$app->user->isAdmin()
		            	],

		            	[
		            		'label' => 'Pendidikan',
		            		'url' => ['/ref_pendidikan/clear'],
		            		'visible' => Yii::$app->user->isAdmin()
		            	],

		            	[
		            		'label' => 'Penghasilan Orang Tua',
		            		'url' => ['/ref_penghasilan/clear'],
		            		'visible' => Yii::$app->user->isAdmin()
		            	],
	            	]
	            ],

	            [
	            	'label' => '<i class="fa fa-graduation-cap"></i>Data Akademik<span class="fa fa-angle-left pull-right"></span>',
	            	'url' => '#',
	            	'options' => ['class' => 'treeview'],
	            	'items' => [
			            [
			            	'label' => 'Siswa',
			            	'url' => ['/siswa/clear'],
			            ],

			            /*[
			            	'label' => 'Presensi',
			            	'url' => ['/presensi/clear'],
			            ],

			            [
			            	'label' => 'Mutasi',
			            	'url' => ['/mutasi/clear'],
			            ]*/
	            	]
	            ],

	            [
	            	'label' => '<i class="fa fa-users"></i>Pengguna',
	            	'url' => ['/user/clear'],
	            	'visible' => Yii::$app->user->isAdmin()
	            ],
	        ],
	        'submenuTemplate' => "\n<ul class='treeview-menu collapse'>\n{items}\n</ul>\n",
	    ]);
	?>