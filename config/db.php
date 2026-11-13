<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=kinokrujok;charset=utf8mb4',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8mb4',
    'enableSchemaCache' => YII_ENV_PROD,
    'schemaCacheDuration' => 3600,
    'schemaCache' => 'cache',
		'enableSchemaCache' => false,
];