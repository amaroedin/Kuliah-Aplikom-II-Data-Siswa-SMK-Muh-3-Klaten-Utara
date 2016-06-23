<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'static/css/bootstrap.css',
        'static/css/login.css',
        'static/plugins/font-awesome/css/font-awesome.min.css',
    ];
    public $js = [
    	'static/js/bootstrap.min.js',
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
