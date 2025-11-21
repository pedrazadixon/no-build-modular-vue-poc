<?php
define('BASE_URL', 'http://localhost/no-build-modular-vue-poc/');
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>POC</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/quasar@2.18.6/dist/quasar.prod.css" rel="stylesheet" type="text/css" />


    <style>
        html,
        body {
            height: 100%;
        }

        .tab-content {
            transition: transform 0.25s ease, opacity 0.25s ease;
            transform: translate(100%, 2%);
            opacity: 0;
            pointer-events: none;
        }

        .tab-content.active {
            transform: translate(0, 0);
            opacity: 1;
            pointer-events: auto;
            position: relative !important;
        }

        .tab-with-close .close-tab-btn {
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .tab-with-close:hover .close-tab-btn {
            opacity: 1;
        }
    </style>

</head>