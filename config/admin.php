<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Icon
    |--------------------------------------------------------------------------
    */

    'icon' => '/img/admin/logo-branca.png',
    'login_icon' => '/img/admin/logo-original.png',

    /*
    |--------------------------------------------------------------------------
    | Timestamp Format
    |--------------------------------------------------------------------------
    */

    'timestamp_format' => 'd/m/Y H:i:s',

    /*
    |--------------------------------------------------------------------------
    | Date Format
    |--------------------------------------------------------------------------
    */

    'date_format' => 'd/m/Y H:i:s',

    /*
    |--------------------------------------------------------------------------
    | Menu
    |--------------------------------------------------------------------------
    */

    'menu' => [
        [
            'header' => 'Dashboard',
            'items' => [
                [
                    'label' => 'Principal',
                    'route' => 'web.admin.default.show',
                    'icon' => 'fa-md fal fa-chart-pie',
                ],
            ],
        ],
        [
            'header' => 'Cadastros',
            'items' => [
                [
                    'label' => 'Futebolista',
                    'icon' => 'fa-md fal fa-user-friends',
                    'route' => 'web.admin.footballers.index',
                    'policy' => ['list', 'App\\Models\\Footballer'],
                ],
                [
                    'label' => 'Modalidade',
                    'icon' => 'fa-md fal fa-cogs',
                    'route' => 'web.admin.modalities.index',
                    'policy' => ['list', 'App\\Models\\Modality'],
                ],
                [
                    'label' => 'Position',
                    'icon' => 'fa-md fal fa-map-marker-alt',
                    'route' => 'web.admin.positions.index',
                    'policy' => ['list', 'App\\Models\\Position'],
                ],
                [
                    'label' => 'Formação Tática',
                    'icon' => 'fa-md fal fa-chalkboard-teacher',
                    'route' => 'web.admin.tactical_formations.index',
                    'policy' => ['list', 'App\\Models\\TacticalFormation'],
                ],
                [
                    'label' => 'Marcação',
                    'icon' => 'fa-md fal fa-shield-alt',
                    'route' => 'web.admin.markings.index',
                    'policy' => ['list', 'App\\Models\\Marking'],
                ],
                
                
            ],
            
        ],
       
        [
            'header' => 'Relatórios',
            'items' => [
                [
                    'label' => 'Log de Atividades',
                    'icon' => 'fa-md fal fa-heart-rate',
                    'route' => 'web.admin.activities.index',
                    'policy' => ['list', 'App\\Models\\Activity'],
                ],
                
            ],
        ],
        [
            'header' => 'Sistema',
            'items' => [
                [
                    'id' => 'access-control',
                    'label' => 'Controle de Acesso',
                    'icon' => 'fa-md fal fa-lock',
                    'policy' => ['list', 'App\\Models\\User'],
                    'items' => [
                        [
                            'label' => 'Usuários',
                            'route' => 'web.admin.users.index',
                            'policy' => ['list', 'App\\Models\\User'],
                        ],
                        [
                            'label' => 'Papéis',
                            'route' => 'web.admin.roles.index',
                            'policy' => ['list', 'App\\Models\\Role'],
                        ],
                    ],
                ],
                
                [
                    'label' => 'Exportações',
                    'icon' => 'fa-md fal fa-database',
                    'route' => 'web.admin.exports.index',
                    'policy' => ['list', 'App\\Models\\Export'],
                ],
                [
                    'label' => 'Webhooks',
                    'icon' => 'fa-md fal fa-terminal',
                    'route' => 'web.admin.webhooks.index',
                    'policy' => ['list', 'App\\Models\\Webhook'],
                ],
                [
                    'label' => 'Processamento',
                    'icon' => 'fa-md fal fa-server',
                    'link' => '/horizon',
                    'pjax' => false,
                    'policy' => ['manage', 'App\\Models\\User'],
                ],
            ],
        ],
    ],
];
