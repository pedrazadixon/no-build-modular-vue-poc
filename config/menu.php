<?php

return [
    [
        'icon' => 'home',
        'text' => 'Home',
        'url' => 'https://placehold.co/400?text=Hello',
    ],
    [
        'icon' => 'calendar_month',
        'text' => 'Agendas',
        'url' => BASE_URL . 'modules/agendas/index.php',
    ],
    [
        'icon' => 'countertops',
        'text' => 'Counter',
        'url' => BASE_URL . 'modules/counter/index.php',
    ],
    [
        'icon' => 'calculate',
        'text' => 'Form',
        'url' => BASE_URL . 'modules/form/index.php',
    ],
    [
        'icon' => 'note_add',
        'text' => 'Blank',
        'url' => BASE_URL . 'modules/_blank/index.php',
    ],
    [
        'icon' => 'sms',
        'text' => 'Dialog',
        'url' => BASE_URL . 'modules/dialog/index.php',
    ],
    [
        'icon' => 'whatshot',
        'text' => 'Trending',
        'items' => [
            [
                'icon' => 'fireplace',
                'text' => 'Today',
                'url' => 'https://placehold.co/400?text=Today',
            ],
            [
                'icon' => 'local_fire_department',
                'text' => 'This week',
                'url' => 'https://placehold.co/400?text=This+week',
            ],
        ],
    ],
    [
        'icon' => 'subscriptions',
        'text' => 'Subscriptions',
        'url' => 'https://placehold.co/400?text=Subscriptions',
    ],
    [
        'icon' => 'folder',
        'text' => 'Reports',
        'items' => [
            [
                'icon' => 'insert_drive_file',
                'text' => 'Report 1',
                'url' => 'https://placehold.co/400?text=Report+1',
            ],
            [
                'icon' => 'insert_drive_file',
                'text' => 'Report 2',
                'url' => 'https://placehold.co/400?text=Report+2',
            ],
            [
                'icon' => 'insert_drive_file',
                'text' => 'Report 3',
                'url' => 'https://placehold.co/400?text=Report+3',
            ],
        ],
    ],
];
