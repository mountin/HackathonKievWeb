<?php

$params = require(__DIR__ . '/params.php');
$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'view' => [
        ],
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-black',
                ],
            ],
        ],

        'request' => [
	    'baseUrl' => '',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'hack',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,

            'showScriptName' => false,
            'rules' => [
		'' => 'site/index',
	        '<action>'=>'site/<action>',
                '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
                '<_c:[\w\-]+>' => '<_c>/index',
                '<_c:[\w\-]+>/<_a:[getmap]+>/<filter:\w+>' => '<_c>/<_a>', //reexp for  map filter
                '<_c:[\w\-]+>/<_a:[\w\-]+>/<id:\d+>' => '<_c>/<_a>',

                '<_c:[\w\-]+>/<_a:[\w\-]+>/<param1>/<param2>' => '<_c>/view',
                '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
                '<controller:\w+>/<action:\w+>/*' => '<controller>/<action>',
            ],
        ],
//        'cache' => [
//            'class' => 'yii\caching\FileCache',
//        ],
        'user' => [

            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    //$config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '192.168.*.*']
    ];

}

return $config;
