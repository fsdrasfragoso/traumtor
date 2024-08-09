<?php

return [
    'methods' => [
        'credit_card' => 'Cartão de Crédito',
        'pix' => 'Pix',
        'payment_profile' => 'Perfil de Pagamento',
        'bank_split' => 'Boleto bancário',
    ],

    'gateways' => [
        'manual' => 'Manual',
        'asaas' => 'Asaas',
    ],

    'webhooks' => [
        'manual' => 'Manual',
        'asaas' => 'Asaas',
    ],

    'default' => [
        'payment_profile' => 'asaas',
        'credit_card' => 'asaas',
        'pix' => 'asaas',
        'bank_split' => 'asaas',
    ],
];
