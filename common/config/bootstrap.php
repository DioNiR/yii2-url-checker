<?php
$env = Dotenv\Dotenv::createUnsafeImmutable(dirname(__DIR__, 2));
$env->load();

$env->required('APP_FRONTEND_HOST');
$env->required('APP_FRONTEND_URL');
$env->required('APP_FRONTEND_COOKIE_SALT');
$env->required('APP_BACKEND_HOST');
$env->required('APP_BACKEND_URL');
$env->required('APP_BACKEND_COOKIE_SALT');

$env->required('YII_ENV')->allowedValues(['prod', 'dev']);
$env->required('YII_DEBUG')->isBoolean();
$env->required('YII_TRACE_LEVEL')->isInteger();

$env->required('MYSQL_HOST');
$env->required('MYSQL_USER');
$env->required('MYSQL_PASSWORD');
$env->required('MYSQL_DATABASE');

Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(__DIR__, 2) . '/frontend');
Yii::setAlias('@backend', dirname(__DIR__, 2) . '/backend');
Yii::setAlias('@console', dirname(__DIR__, 2) . '/console');
