<!DOCTYPE html>
<html lang="en">

<?php

$assets_version = '1.0.0';

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

if (!defined('BASE_URL')) {
    define('BASE_URL', rtrim($_ENV['BASE_URL'], '/') . '/');
}

if (!defined('APP_VERSION')) {
    define('APP_VERSION', $assets_version);
}
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>POC</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/quasar@2.18.6/dist/quasar.prod.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_URL ?>assets/css/styles.css" rel="stylesheet" type="text/css" />
</head>

<body>