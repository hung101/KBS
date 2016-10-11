<?php

use kartik\mpdf\Pdf;

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
	// eddie start
    /*'modules' => [
        'audit' => 'bedezign\yii2\audit\Audit',
    ],*/
	// eddie end
    'components' => [
        'user' => [
            'identityClass' => 'common\models\PublicUser',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_backendUser',
                'path' => '/',
                'httpOnly' => true,
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'session' => [
            'name' => 'PHPBACKSESSID',
            'savePath' => __DIR__ . '/../runtime/sessions',
            'cookieParams' => [
                'path' => '/',
            ],  
        ],
        // eddie (print) start 
        'pdf' => [
            'class' => Pdf::classname(),
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'marginLeft' => 0,
            'marginRight' => 0,
            'marginTop' => 0,
            'marginBottom' => 0,
            'marginHeader' => 0,
            'marginFooter' => 0,
            // refer settings section for all configuration options
        ]
        // eddie (print) end 
    ],
    'params' => $params,
];
