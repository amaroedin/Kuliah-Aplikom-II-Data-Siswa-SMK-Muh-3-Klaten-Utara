<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

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
        'static/css/layout.css',
        'static/css/skin-themes.min.css',
        'static/css/content-box.css',
        'static/css/utils.css',
        'static/fonts/google-font.css',
        'static/plugins/font-awesome/css/font-awesome.min.css',
        'static/plugins/datepicker/jquery-ui-datepicker-1.10.4.min.css',
        'static/plugins/sweet-alert/sweet-alert.css',
        'static/plugins/jquery-confirm/jquery-confirm.min.css',
    ];
    public $js = [
        'static/js/jquery-migrate-1.2.1.min.js',
        'static/js/bootstrap.min.js',
        'static/js/app.js',
        'static/js/config.js',
        'static/js/jquery.metisMenu.js',
        'static/js/jquery.slimscroll.min.js',
        'static/js/jquery.cookie.js',
        'static/plugins/datepicker/jquery-ui-datepicker-1.10.4.min.js',
        'static/plugins/sweet-alert/sweet-alert.min.js',
        'static/plugins/jquery-confirm/jquery-confirm.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
   public $jsOptions = array(
    'position' => \yii\web\View::POS_HEAD // too high
    //'position' => View::POS_READY // in the html disappear the jquery.jrac.js declaration
    //'position' => View::POS_LOAD // disappear the jquery.jrac.js
     // 'position' => View::POS_END // appear in the bottom of my page, but jquery is more down again
	);
}
