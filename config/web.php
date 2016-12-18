<?php

require(__DIR__ . '/define.php');

$params = require(__DIR__ . '/params.php');

$config = [
    'id'           => 'basic',
    'language'     => 'zh-CN',
    'defaultRoute' => '/web/index/index',
    'basePath'     => dirname(__DIR__),
    'bootstrap'    => ['log'],
    'components'   => [
        'request'       => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'bdZT_oJ1cjlVep23SLGkoAUASxJS1Mgk',
            'parsers'             => [
                'application/json' => 'yii\web\JsonParser',
                'text/json'        => 'yii\web\JsonParser',
            ]
        ],
        'response'      => [
            'class'         => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                $response->statusCode = 200;
            },
        ],
        'cache'         => [
            'class' => 'yii\caching\FileCache',
        ],
        'user'          => [
            'identityClass'   => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        //后台用户
        'administrator' => [
            'class'           => 'yii\web\User',
            'loginUrl'        => ['admin/auth/login'],
            'identityClass'   => 'app\models\Administrator',
            'enableAutoLogin' => true,
        ],
        'errorHandler'  => [
            'errorAction' => 'site/error',
        ],
        'mailer'        => [
            'class'            => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'log'           => require(__DIR__ . '/log.php'),
        'lsession'      => require(__DIR__ . '/lsession.php'),
        'session'       => [
            'class'        => 'yii\web\DbSession',
            'db'           => 'db',
            'sessionTable' => 't_session',
        ],
        'urlManager'    => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [
            ],
        ],
    ],
    'params'       => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
