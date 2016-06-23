<?php
namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'static/css/bootstrap.min.css',
        'static/css/frontpage.css',
        'static/plugins/font-awesome/css/font-awesome.min.css',
        // 'static/plugins/google-icon/stylesheet.css',
        'static/plugins/sweet-alert/sweet-alert.css',
    ];
    public $js = [
    	'static/js/jquery-migrate-1.2.1.min.js',
        'static/js/bootstrap.min.js',
        'static/js/application.js',
        'static/plugins/sweet-alert/sweet-alert.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
	public $jsOptions = [
		'position' => \yii\web\View::POS_HEAD // too high
		//'position' => View::POS_READY // in the html disappear the jquery.jrac.js declaration
		//'position' => View::POS_LOAD // disappear the jquery.jrac.js
		// 'position' => View::POS_END // appear in the bottom of my page, but jquery is more down again
	];
}
