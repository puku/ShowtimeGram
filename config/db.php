<?php

use yii\db\Connection;

return [
    'class' => Connection::class,
    'dsn' => 'sqlite:'.__DIR__ . '/../sqlite.db',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
