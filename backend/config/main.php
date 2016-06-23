<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

use yii\web\Request;
$baseUrl = str_replace('backend', 'admin', (new Request)->getBaseUrl());

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'homeUrl' => $baseUrl.'/site/home/',
    'modules' => [],
    'components' => [
        'date' => [
            'class' => 'common\components\Date'
        ],
        'request' => [
    		'baseUrl' => $baseUrl,
    	],
        'user' => [
            'class' => 'common\components\WebUser',
            'identityClass' => 'common\models\User',
            // 'enableAutoLogin' => true,
            'autoRenewCookie' => true,
            'enableSession' => true,
            'authTimeout' => 22000,
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
    		'baseUrl' => $baseUrl,
	        'showScriptName' => false,
	        'enablePrettyUrl' => true,
            // 'enableStrictParsing' => true,
	        'rules' => array(
                    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
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
