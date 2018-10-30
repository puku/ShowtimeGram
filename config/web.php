<?php

use yii\caching\FileCache;
use yii\debug\Module as Debug;
use yii\gii\Module as Gii;
use yii\log\FileTarget;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'ShowtimeGram',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',

        '@photo' =>__DIR__ .'/../public_html/images',
        '@photo-web' => '/images',
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'test',
        ],
        'cache' => [
            'class' => FileCache::class,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
    'params' => $params,
];

if (YII_DEBUG) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => Debug::class,
        'allowedIPs' => ['*'],
    ];
}

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => Gii::class,
        'allowedIPs' => ['*'],
    ];
}

return $config;
