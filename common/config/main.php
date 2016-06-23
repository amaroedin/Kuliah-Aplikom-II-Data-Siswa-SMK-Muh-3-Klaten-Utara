<?php

use yii\web\Request;
// $baseUrl = str_replace('backend', '', (new Request)->getBaseUrl());
$baseUrl = (new Request)->getBaseUrl();
Yii::setAlias('rootUrl', dirname($baseUrl));
$frontendBaseUrl = str_replace('backend', '', (new Request)->getBaseUrl());
Yii::setAlias('frontendBaseUrl', $frontendBaseUrl);

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'id',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'common\components\WebUser',
        ],
        'authManager'=>[
            'class' => 'common\components\UserAccess',
        ],

        'date' => [
            'class' => 'common\components\Date'
        ],
        'urlManagerFrontEnd' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => $frontendBaseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
];
