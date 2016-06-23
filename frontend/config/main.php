<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

use yii\web\Request;
$baseUrl = str_replace('frontend', '', (new Request)->getBaseUrl());

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'baseUrl' => $baseUrl,
        ],
        'user' => [
            'class' => 'common\components\WebUser',
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'date' => [
            'class' => 'common\components\Date'
        ],
        'authManager'=>[
            'class' => 'common\components\UserAccess',
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js'=>['jquery.min.js']
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js'=>[]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],

            ],
        ],
        'urlManager' => [
//	        'class' => 'yii\web\UrlManager',
    		'baseUrl' => $baseUrl,
	        'showScriptName' => false,
	        'enablePrettyUrl' => true,
	        'rules' => array(
                    '<controller:\w+>/<action:\w+>/<id>' => '<controller>/<action>',
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
	        ),
        ],
        /*'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],*/
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
