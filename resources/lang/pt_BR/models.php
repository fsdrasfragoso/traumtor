<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Custom Models Attributes
    |--------------------------------------------------------------------------
    */

    'App\\Libraries\\PaymentGateway\\CreditCard' => [
        'attributes' => [
            'options' => [
                'flag' => [
                    'american_express' => 'American Express',
                    'elo' => 'Elo',
                    'mastercard' => 'Mastercard',
                    'visa' => 'Visa',
                    'hipercard' => 'Hipercard',
                ],
            ],
        ],
    ],

    'App\\Models\\Activity' => [
        'attributes' => [
            'causer' => 'Autor',
            'object' => 'Objeto',
            'action' => 'Ação',
            'subject_type' => 'Objeto',
            'subject_id' => 'ID do Objeto',
            'options' => [
                'subject_type' => [
                    'Conteúdos' => [
                        'App\Models\Author' => 'Autores',
                        'App\Models\Media' => 'Galeria',
                        'App\Models\Category' => 'Categorias',
                        'App\Models\Folder' => 'Pastas',
                        'App\Models\Subfolder' => 'Subpastas',
                        'App\Models\Content' => 'Conteúdos',
                        'App\Models\Page' => 'Páginas',
                    ],
                    'Cadastros' => [
                        'App\Models\Product' => 'Produtos',
                    ],
                    'Vendas' => [
                        'App\Models\Footballer' => 'Futebolista',
                    ],
                ],

                'action' => [
                    'Assinaturas' => [
                        'cancel_by_user' => 'Assinatura cancelada pelo futebolista',
                        'cancel' => 'Assinatura cancelada',
                        'inactivate' => 'Assinatura desativada',
                        'reactivate' => 'Assinatura reativada',
                        'trade' => 'Assinatura trocada',
                    ],
                    'Payment' => [
                        'paid' => 'Fatura paga manualmente.',
                        'failed' => 'Pagamento de fatura rejeitado.',
                        'refunded' => 'Fatura estornada.',
                    ],
                    'Futebolista' => [
                        'login_by_admin' => 'Login pelo admin.',
                        'access_created' => 'Acesso criado.',
                        'access_regenerated' => 'Acesso regerado.',
                        'access_deleted' => 'Acesso deletado.',
                    ],
                    'Exports' => [
                        'download' => 'Download',
                    ],
                    'Recursos' => [
                        'created' => 'Recurso criado',
                        'updated' => 'Recurso atualizado',
                        'deleted' => 'Recurso apagado',
                        'restored' => 'Recurso restaurado',
                    ],
                    'Grupos Telegram' => [
                        'created' => 'Grupo criado',
                        'updated' => 'Grupo atualizado',
                        'deleted' => 'Grupo apagado',
                        'restored' => 'Grupo restaurado',
                    ],
                    'Dashboard Telegram' => [
                        'created' => 'Grupo criado',
                        'updated' => 'Grupo atualizado',
                        'deleted' => 'Grupo apagado',
                        'restored' => 'Grupo restaurado',
                    ],
                ],
            ],
        ],
        'actions' => [
            'label' => 'Log de Atividades',
            'index' => 'Lista de atividades',
        ],
    ],

    'App\\Models\\Payment' => [
        'attributes' => [
            'id' => 'ID',
            'reference' => 'Referência',
            'period' => 'Período',
            'cycle' => 'Ciclo',
            'renovation' => 'Renovação',
            'activation' => 'Ativação',
            'refund_reasons' => [
                'retention' => 'Retenção',
                'cancellation' => 'Cancelamento',
                'test' => 'Teste',
            ],
            'options' => [
                'status' => [
                    'review' => 'Revisão',
                    'pending' => 'Pendente',
                    'paid' => 'Pago',
                    'canceled' => 'Cancelado',
                    'scheduled' => 'Agendado',
                    'failed' => 'Falha',
                ],
            ],
        ],
        'actions' => [
            'label' => 'Faturas',
            'index' => 'Lista de faturas',
            'create' => 'Criar fatura',
            'edit' => 'Editar fatura',
            'delete' => 'Excluir fatura',
            'restore' => 'Restaurar fatura',
            'show' => 'Visualizar fatura',
            'refund' => 'Estornar',

            'success' => [
                'paid' => 'Fatura paga manualmente.',
                'failed' => 'Pagamento de fatura rejeitado.',
                'refunded' => 'Fatura estornada.',
            ],
        ],
    ],

    'App\\Models\\Email' => [
        'attributes' => [
            'options' => [
                'type' => [
                    'expired_credit_card' => 'Cartão de crédito expirado',
                    'expiring_credit_card' => 'Cartão de crédito a expirar',
                    'new_credit' => 'Novo crédito',
                    'password_recovery' => 'Recuperação de senha',
                    'subscription_welcome' => 'Boas-vindas a assinatura',
                    'subscription_renewal' => 'Aviso de renovação',
                    'welcome' => 'Boas-vindas',
                ],
                'status' => [
                    'delivered' => 'Entregue',
                    'rejected' => 'Rejeitado',
                    'sent' => 'Enviado',
                ],
                'reference_types' => [
                    'App\Models\Subscription' => 'Assinatura',                   
                    'App\Models\ReportPurchase' => 'Pedido de Edições Avulsas',
                    'App\Models\LinkedPurchase' => 'Pedido de Vinculada',
                ],
            ],
        ],
    ],

    'App\\Models\\EmailActivity' => [
        'attributes' => [
            'options' => [
                'activity' => [
                    'bounce' => 'Rejeição',
                    'complaint' => 'Marcação como spam',
                    'delivery' => 'Entrega',
                    'send' => 'Envio',
                ],
            ],
        ],
    ],

    'App\\Models\\Footballer' => [
        'name' => 'Futebolista',
        'attributes' => [
            'name' => 'Nome',
            'document' => 'CPF',
            'modalities'=> 'Modalidades',
            'positions' => 'Posições',
            'overall'=> 'Overall',
            'dominant_foot'=>'Pé Dominante',
            'options' => [
                'status' => [
                    'active' => 'Ativo',
                    'blocked' => 'Bloqueado',
                ],
                'dominant_foot' => [
                    'right' => 'Direto', 
                    'left' => 'Esquerdo', 
                    'ambidextrous' => 'Ambidestro',
                ],
            ],
        ],
        'actions' => [
            'label' => 'Futebolista',
            'index' => 'Lista de futebolista',
            'create' => 'Novo futebolista',
            'edit' => 'Editar futebolista',
            'show' => 'Visualizar futebolista',
            'login' => 'Logar como futebolista',

            'success' => [
                'created' => 'Futebolista criado.',
                'updated' => 'Futebolista atualizado.',
                'deleted' => 'Futebolista apagado.',
                'restored' => 'Futebolista restaurado.',
                'login_by_admin' => 'Login pelo admin.',
                'access_created' => 'Acesso criado.',
                'access_regenerated' => 'Acesso regerado.',
                'access_deleted' => 'Acesso deletado.',
            ],
        ],
    ],

    'App\\Models\\Modality' => [
        'name' => 'Modalidade',
        'attributes' => [
            'name' => 'Nome',
            'player_count' => 'Quantidade de jogadores por time ',
            'created_at' => 'Criado Em',
            'updated_at' => 'Atualizado Em',
        ],
        'actions' => [
            'label' => 'Modalidade',
            'index' => 'Lista de modalidades',
            'create' => 'Nova modalidade',
            'edit' => 'Editar modalidade',
            'show' => 'Visualizar modalidade',
            'delete' => 'Apagar modalidade',
            'restore' => 'Restaurar modalidade',

            'success' => [
                'created' => 'Modalidade criada.',
                'updated' => 'Modalidade atualizada.',
                'deleted' => 'Modalidade apagada.',
                'restored' => 'Modalidade restaurada.',
            ],
        ],
    ],

    'App\\Models\\TacticalFormation' => [
        'name' => 'Formação Tática',
        'attributes' => [
            'name' => 'Nome',
            'description' => 'Descrição',
            'modality_id' => 'Modalidade',
            'modality--name'=> 'Modalidade',
            'created_at' => 'Criado Em',
            'updated_at' => 'Atualizado Em',
        ],
        'actions' => [
            'label' => 'Formação Tática',
            'index' => 'Lista de formações táticas',
            'create' => 'Nova formação tática',
            'edit' => 'Editar formação tática',
            'show' => 'Visualizar formação tática',
            'delete' => 'Apagar formação tática',
        
            'success' => [
                'created' => 'Formação tática criada.',
                'updated' => 'Formação tática atualizada.',
                'deleted' => 'Formação tática apagada.',
                'restored' => 'Formação tática restaurada.',
            ],
        ],
    ],

    'App\\Models\\Marking' => [
        'name' => 'Marcação',
        'attributes' => [
            'name' => 'Nome',
            'description' => 'Descrição',
            'advantages' => 'Vantagens',
            'disadvantages' => 'Desvantagens',
            'modality_id' => 'Modalidade',
            'modality--name' => 'Modalidade',
            'created_at' => 'Criado Em',
            'updated_at' => 'Atualizado Em',
        ],
        'actions' => [
            'label' => 'Marcação',
            'index' => 'Lista de marcações',
            'create' => 'Nova marcação',
            'edit' => 'Editar marcação',
            'show' => 'Visualizar marcação',
            'delete' => 'Apagar marcação',

            'success' => [
                'created' => 'Marcação criada.',
                'updated' => 'Marcação atualizada.',
                'deleted' => 'Marcação apagada.',
                'restored' => 'Marcação restaurada.',
            ],
        ],
    ],



    'App\\Models\\Position' => [
        'name' => 'Posição',
        'attributes' => [
            'name' => 'Nome',
            'description' => 'Descrição',
            'modality_id' => 'Modalidade',
            'modality--name'=> 'Modalidade',
            'created_at' => 'Criado Em',
            'updated_at' => 'Atualizado Em',
        ],
        'actions' => [
            'label' => 'Posição',
            'index' => 'Lista de posições',
            'create' => 'Nova posição',
            'edit' => 'Editar posição',
            'show' => 'Visualizar posição',
            'delete' => 'Apagar posição',

            'success' => [
                'created' => 'Posição criada.',
                'updated' => 'Posição atualizada.',
                'deleted' => 'Posição apagada.',
                'restored' => 'Posição restaurada.',
            ],
        ],
    ],



    'App\\Models\\Export' => [
        'attributes' => [
            'users--name' => 'Usuário',
            'options' => [
                'status' => [
                    'created' => 'Criado',
                    'pending' => 'Executando',
                    'success' => 'Sucesso',
                    'failed' => 'Falha',
                ],
            ],
            'model' => 'Seção',
            'size' => 'Tamanho',
        ],
        'actions' => [
            'label' => 'Exportações',
            'index' => 'Lista de exportações',
        ],
    ],

    'App\\Models\\Role' => [
        'attributes' => [
            'permissions' => 'Permissões',
            'users' => 'Usuários',
        ],
        'actions' => [
            'label' => 'Papéis',
            'index' => 'Lista de papéis',
            'create' => 'Criar papel',
            'edit' => 'Editar papel',
            'delete' => 'Excluir papel',
            'restore' => 'Restaurar papel',
        ],
    ],

    'App\\Models\\Setting' => [
        'attributes' => [
            'books' => [
                'enabled' => 'Habilitar e-mails de pedidos de livros',
                'confirmed_page' => 'Corpo do e-mail de livros confirmados',
                'payment_confirmation_page' => 'Corpo do e-mail de pagamento confirmado',
            ],
        ],
    ],

    'App\\Models\\User' => [
        'attributes' => [
            'roles' => 'Papéis',
        ],
        'actions' => [
            'label' => 'Usuários',
            'index' => 'Lista de usuários',
            'create' => 'Criar usuário',
            'edit' => 'Editar usuário',
            'delete' => 'Excluir usuário',
            'restore' => 'Restaurar usuário',
        ],
    ],

    'App\\Models\\Media' => [
        'actions' => [
            'label' => 'Media',
        ],
    ],

    'App\\Models\\Webhook' => [
        'attributes' => [
            'data' => 'Dados',
            'reference' => 'Referência',
        ],
        'actions' => [
            'label' => 'Webhooks',
            'index' => 'Lista de webhooks',
            'create' => 'Criar webhook',
            'edit' => 'Editar webhook',
            'delete' => 'Excluir webhook',
            'restore' => 'Restaurar webhook',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Model Attributes
    |--------------------------------------------------------------------------
    */

    'default' => [
        'attributes' => [
            'actions' => 'Ações',
            'active' => 'Ativo',
            'amount' => 'Valor',
            'book' => 'Livro',
            'short_url' => 'Url encurtada',
            'api_token' => 'Token',
            'blank' => '',
            'book_free_days' => 'Dias Grátis',
            'books--title' => 'Livro',
            'books' => 'Livros',
            'books' => [
                'confirmed_page' => 'E-mail para pedido confirmado',
                'payment_confirmation_page' => 'E-mail para pagamento confirmado',
            ],
            'calculator_fine' => 'Multa',
            'calculator_trial' => 'Degustação',
            'canceled_at' => 'Data de Cancelamento',
            'charge-at' => 'Cobrança',
            'checkout' => 'Checkout',
            'city_select' => 'Cidade',
            'city' => 'Cidade',
            'client' => 'Futebolista',
            'code' => 'Código',
            'complement' => 'Complemento',
            'contents--title' => 'Conteúdo',
            'coupon' => 'Cupom',
            'cover' => 'Capa',
            'logo' => 'Logo',
            'created_at' => 'Data de Cadastro',
            'custom_price' => 'Preço customizável',
            'footballer_id' => 'Futebolista',
            'footballer-addresses-city' => 'Cidade',
            'footballer-addresses-complement' => 'Complemento',
            'footballer-addresses-neighborhood' => 'Bairro',
            'footballer-addresses-number' => 'Número',
            'footballer-addresses-state' => 'Estado',
            'metadata--count_clicks' => 'Cliques',
            'metadata--count_views' => 'Visualizações',
            'custom_price' => 'Preço customizável',
            'subscription-title' => 'Assinatura',
            'invoice-number' => 'NF',
            'footballer-addresses-street' => 'Endereço',
            'footballer-addresses-zip' => 'CEP',
            'footballers--email' => 'E-mail',
            'footballers--name' => 'Futebolista',
            'cvv' => 'Cód. Segurança',
            'cycle' => 'Ciclo',
            'date_info' => 'Data',
            'delivery_code' => 'Código de Rastreio',
            'description' => 'Descrição',
            'discount_cycles' => 'Ciclos do desconto',
            'discount_type' => 'Tipo de desconto',
            'discount_value' => 'Valor do desconto',
            'document' => 'CPF',
            'email_page' => 'Lista de e-mail',
            'email' => 'E-mail',
            'end_at' => 'Fim',
            'engagement_classification' => 'Classificação',
            'engagement_reason' => 'Motivos',
            'expire_at' => 'Expiração',
            'external_code' => 'Ref',
            'flag' => 'Bandeira',
            'folder_id' => 'Pasta',
            'folders' => 'Pastas de conteúdo',
            'gift_renewal_offers--title' => 'Oferta de Renovação',
            'gift_days' => 'Dias de brinde',
            'hide_from' => 'Esconder apenas de quem possui',
            'hide_linked' => 'Esconder vinculadas',
            'hide_presale' => 'Esconder Pré-venda',
            'holder' => 'Titular do cartão',
            'id' => 'ID',
            'internal_code' => 'Código Interno',
            'interval_count' => 'Recorrência',
            'invoice-number' => 'NF',
            'is_active' => 'Apenas ativos',
            'is_nta' => 'NTA?',
            'is_presale' => 'Pré-venda?',
            'javascript' => 'Javascript',
            'linkeds--title' => 'Vinculada',
            'linkeds' => 'Vinculadas',
            'meta[canonical_url]' => 'Meta Canonical Url',
            'meta[og_description]' => 'Meta og:description',
            'meta[og_title]' => 'Meta og:title',
            'meta[og_url]' => 'Meta og:url',
            'mobile' => 'Celular',
            'model_has_roles--role_id' => 'Papel',
            'month' => 'Mês de validade',
            'name' => 'Nome',
            'neighborhood' => 'Bairro',
            'not_show_calls' => 'Não mostrar essa mensagem novamente',
            'number' => 'Número',
            'observation' => 'Observação',
            'og_image' => 'Meta og:image',
            'old_password' => 'Senha atual',
            'order' => 'Ordem',
            'password_confirmation' => 'Confirmação',
            'password' => 'Senha',
            'payment_gateway' => 'Gateway',
            'payment_method' => 'Pagamento',
            'permissions' => 'Permissões',
            'phone' => 'Telefone',
            'plan_id' => 'Plano',
            'plans--title' => 'Plano',
            'coupon--code' => 'Cupom',
            'plans' => 'Planos',
            'price' => 'Preço',
            'privacy' => 'Privacidade',
            'processed' => 'Processado',
            'product_id' => 'Produto',
            'related_plan' => 'Plano Relacionado',
            'product--title' => 'Produto',
            'product' => 'Produto',
            'products_and_plans' => 'Ao comprar',
            'product_types' => 'Outras vendas',
            'properties' => 'Propriedades',
            'publication' => 'Publicação',
            'published_at' => 'Data de Publicação',
            'reason' => 'Razão',
            'recurrence' => 'Recorrência',
            'redirect_url' => 'URL de redirecionamento',
            'reference' => 'Referência',
            'refund_amount' => 'Estornado',
            'requested_refund_at' => 'Data de solicitação do estorno',
            'renew_at' => 'Renovação',
            'response' => 'Resposta',
            'secondaries_plans' => 'Planos secundários',
            'gifts--plan_id' => 'Brinde',
            'serial' => 'Número do cartão',
            'show_to' => 'Mostrar apenas para quem possui',
            'show_showcase_only' => 'Mostrar apenas Vitrine',
            'only_consent' => 'Apenas Consentimentos',
            'show_total_amount' => 'Exibir total geral',
            'slug' => 'Slug',
            'start_at' => 'Início',
            'products' => 'Produtos',
            'allow_carts_repeated' => 'Permitir carrinhos repetidos',
            'allow_footballers_repeated' => 'Permitir futebolista repetidos',
            'only_registereds' => 'Apenas futebolista cadastrados',
            'only_with_phone' => 'Apenas futebolista com telefone',
            'item_type' => 'Tipo',
            'state' => 'Estado',
            'status' => 'Status',
            'street' => 'Logradouro',
            'subfolders' => 'Subpastas',
            'subscription_id' => 'Assinatura',
            'subscription-title' => 'Assinatura',
            'subscriptions' => 'Assinaturas',
            'summary' => 'Resumo',
            'tags' => 'Tags',
            'testimonials--description' => 'Descrição do depoimento',
            'thumb' => 'Thumbnail',
            'title' => 'Título',
            'total' => 'Total',
            'ty_page_button_link' => 'Link do botão',
            'ty_page_button_text' => 'Texto do botão',
            'ty_page_description' => 'Texto da Thank You Page',
            'type' => 'Tipo',
            'unpublished_at' => 'Data de Despublicação',
            'notification_unpublished_at' => 'Data de Despublicação',
            'url' => 'URL',
            'user' => 'Usuário',
            'users--name' => 'Usuário',
            'xpromo' => 'XPROMO',
            'year' => 'Ano de validade',
            'attachments' => 'Anexos',
            'zip_code' => 'CEP',
            'products' => 'Produtos',
            'url_telegram' => 'Link grupo do telegram',
            'old_group' => 'Grupo Desativado',
            'produto' => 'Produto',

            'terms' => [
                'terms_text' => 'Termos de Uso',
            ],

            'politcs' => [
                'politcs_text' => 'Políticas de Privacidade',
            ],

            'options' => [
                'boolean' => [
                    0 => 'Não',
                    1 => 'Sim',
                ],
                'state' => [
                    'AC' => 'AC',
                    'AL' => 'AL',
                    'AM' => 'AM',
                    'AP' => 'AP',
                    'BA' => 'BA',
                    'CE' => 'CE',
                    'DF' => 'DF',
                    'ES' => 'ES',
                    'GO' => 'GO',
                    'MA' => 'MA',
                    'MT' => 'MT',
                    'MS' => 'MS',
                    'MG' => 'MG',
                    'PA' => 'PA',
                    'PB' => 'PB',
                    'PE' => 'PE',
                    'PI' => 'PI',
                    'PR' => 'PR',
                    'RJ' => 'RJ',
                    'RN' => 'RN',
                    'RS' => 'RS',
                    'RO' => 'RO',
                    'RR' => 'RR',
                    'SC' => 'SC',
                    'SP' => 'SP',
                    'SE' => 'SE',
                    'TO' => 'TO',
                ],
                'payment_gateway' => [
                    'manual' => 'Manual',
                    'asaas' => 'Asaas',
                    'ses' => 'SES',
                ],
                'payment_method' => [
                    'credit_card' => 'Cartão de Crédito',
                    'bank_split' => 'Boleto bancário',
                    'pix' => 'Pix',
                    'manual' => 'Manual',
                    'payment_profile' => 'Perfil de pagamento',
                ],
                'discount_type' => [
                    'amount' => 'Valor (R$)',
                    'percentage' => 'Porcentagem (%)',
                ],
                'months' => [
                    1 => 'Janeiro',
                    2 => 'Fevereiro',
                    3 => 'Março',
                    4 => 'Abril',
                    5 => 'Maio',
                    6 => 'Junho',
                    7 => 'Julho',
                    8 => 'Agosto',
                    9 => 'Setembro',
                    10 => 'Outubro',
                    11 => 'Novembro',
                    12 => 'Dezembro',
                ],
            ],
        ],

        'actions' => [
            'label' => 'Recursos',
            'index' => 'Lista de recursos',
            'show' => 'Visualizar recurso',
            'create' => 'Criar recurso',
            'edit' => 'Editar recurso',
            'delete' => 'Remover recurso',
            'restore' => 'Restaurar recurso',
            'save' => 'Salvar alterações',
            'export' => 'Exportar',
            'send_pre_sale' => 'Enviar todos Pré-venda',

            'download_content' => [
                'video' => 'Baixar conteúdo como Vídeo',
                'document' => 'Baixar conteúdo como PDF',
                'spreadsheet' => 'Baixar conteúdo como Planilha',
                'audio' => 'Baixar conteúdo como Áudio',
                'datatable' => 'Baixar conteúdo como Tabela de Dados',
            ],

            'confirmation' => [
                'delete' => 'Tem certeza que deseja excluir este item?',
                'restore' => 'Tem certeza que deseja restaurar este item?',
            ],

            'success' => [
                'created' => 'Recurso criado.',
                'updated' => 'Recurso atualizado.',
                'deleted' => 'Recurso apagado.',
                'restored' => 'Recurso restaurado.',
                'download' => 'Download',
            ],

            'failed' => [
                'created' => 'Falha ao criar recurso.',
                'updated' => 'Falha ao atualizar recurso.',
                'deleted' => 'Falha ao excluir recurso.',
                'restored' => 'Falha ao restaurar recurso.',
            ],
        ],
    ],
];
