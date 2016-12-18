<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/13
 * Time: 10:36
 */
return [
    'traceLevel' => YII_DEBUG ? 3 : 0,
    'targets'    => [
        [
            'class'      => 'yii\log\FileTarget',
            'levels'     => ['error', 'info'],
            'logVars'    => [],
            'categories' => ['application', 'request', 'response', 'rpc'],
            'logFile'    => '@app/runtime/logs/app.all.log',
        ],
        [
            'class'      => 'yii\log\FileTarget',
            'levels'     => ['info'],
            'logVars'    => [],
            'categories' => ['request'],
            'logFile'    => '@app/runtime/logs/request.info.log'
        ],
        [
            'class'      => 'yii\log\FileTarget',
            'levels'     => ['error'],
            'logVars'    => [],
            'categories' => ['request'],
            'logFile'    => '@app/runtime/logs/request.error.log'
        ],
        [
            'class'      => 'yii\log\FileTarget',
            'levels'     => ['info'],
            'logVars'    => [],
            'categories' => ['response'],
            'logFile'    => '@app/runtime/logs/response.info.log'
        ],
        [
            'class'      => 'yii\log\FileTarget',
            'levels'     => ['error'],
            'logVars'    => [],
            'categories' => ['response'],
            'logFile'    => '@app/runtime/logs/response.error.log'
        ],
        [
            'class'      => 'yii\log\FileTarget',
            'levels'     => ['error'],
            'logVars'    => [],
            'categories' => ['rpc'],
            'logFile'    => '@app/runtime/logs/rpc.error.log'
        ],
        [
            'class'      => 'yii\log\FileTarget',
            'levels'     => ['info'],
            'logVars'    => [],
            'categories' => ['rpc'],
            'logFile'    => '@app/runtime/logs/rpc.info.log'
        ],
    ],
];