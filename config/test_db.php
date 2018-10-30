<?php
$db = require __DIR__ . '/db.php';
$db['dsn'] = 'sqlite:' . __DIR__ . '/../sqlite_test.db';

return $db;
