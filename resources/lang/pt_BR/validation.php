<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'O campo :attribute deve ser aceito.',
    'active_url' => 'O campo :attribute não é uma URL válida.',
    'after' => 'O campo :attribute deve ser uma data posterior a :date.',
    'after_or_equal' => 'O campo :attribute deve ser uma data posterior ou igual a :date.',
    'alpha' => 'O campo :attribute só pode conter letras.',
    'alpha_dash' => 'O campo :attribute só pode conter letras, números e traços.',
    'alpha_num' => 'O campo :attribute só pode conter letras e números.',
    'array' => 'O campo :attribute deve ser uma matriz.',
    'before' => 'O campo :attribute deve ser uma data anterior :date.',
    'before_or_equal' => 'O campo :attribute deve ser uma data anterior ou igual a :date.',
    'between' => [
        'numeric' => 'O campo :attribute deve ser entre :min e :max.',
        'file' => 'O campo :attribute deve ser entre :min e :max kilobytes.',
        'string' => 'O campo :attribute deve ser entre :min e :max caracteres.',
        'array' => 'O campo :attribute deve ter entre :min e :max itens.',
    ],
    'boolean' => 'O campo :attribute deve ser verdadeiro ou falso.',
    'block_email' => 'O campo :attribute é inválido.',
    'brite_verifier' => 'O campo :attribute é inválido.',
    'company_document' => 'O campo :attribute não é um CNPJ válido.',
    'confirmed' => 'O campo :attribute de confirmação não confere.',
    'date' => 'O campo :attribute não é uma data válida.',
    'date_format' => 'O campo :attribute não corresponde ao formato :format.',
    'different' => 'Os campos :attribute e :other devem ser diferentes.',
    'digits' => 'O campo :attribute deve ter :digits dígitos.',
    'digits_between' => 'O campo :attribute deve ter entre :min e :max dígitos.',
    'dimensions' => 'O campo :attribute tem dimensões de imagem inválidas.',
    'distinct' => 'O campo :attribute e o campo :other tem um valor duplicado.',
    'document' => 'O campo :attribute não é um CPF válido.',
    'email' => 'O campo :attribute deve ser um endereço de e-mail válido.',
    'email_domain_invalid' => 'O campo :attribute deve ser um domínio de e-mail válido.',
    'ends_with' => 'O campo :attribute deve terminar com um dos valores: :values',
    'exists' => 'O campo :attribute selecionado é inválido.',
    'file' => 'O campo :attribute deve ser um arquivo.',
    'filled' => 'O campo :attribute deve ter um valor.',
    'gt' => [
        'numeric' => 'O campo :attribute deve ser maior que :value.',
        'file' => 'O campo :attribute deve ser maior que :value kilobytes.',
        'string' => 'O campo :attribute deve ser maior que :value caracteres.',
        'array' => 'O campo :attribute deve conter mais de :value itens.',
    ],
    'gte' => [
        'numeric' => 'O campo :attribute deve ser maior ou igual a :value.',
        'file' => 'O campo :attribute deve ser maior ou igual a :value kilobytes.',
        'string' => 'O campo :attribute deve ser maior ou igual a :value caracteres.',
        'array' => 'O campo :attribute deve conter :value itens ou mais.',
    ],
    'image' => 'O campo :attribute deve ser uma imagem.',
    'in' => 'O campo :attribute selecionado é inválido.',
    'in_array' => 'O campo :attribute não existe em :other.',
    'integer' => 'O campo :attribute deve ser um número inteiro.',
    'ip' => 'O campo :attribute deve ser um endereço de IP válido.',
    'ipv4' => 'O campo :attribute deve ser um endereço IPv4 válido.',
    'ipv6' => 'O campo :attribute deve ser um endereço IPv6 válido.',
    'json' => 'O campo :attribute deve ser uma string JSON válida.',
    'lt' => [
        'numeric' => 'O campo :attribute deve ser menor que :value.',
        'file' => 'O campo :attribute deve ser menor que :value kilobytes.',
        'string' => 'O campo :attribute deve ser menor que :value caracteres.',
        'array' => 'O campo :attribute deve conter menos de :value itens.',
    ],
    'lte' => [
        'numeric' => 'O campo :attribute deve ser menor ou igual a :value.',
        'file' => 'O campo :attribute deve ser menor ou igual a :value kilobytes.',
        'string' => 'O campo :attribute deve ser menor ou igual a :value caracteres.',
        'array' => 'O campo :attribute não deve conter mais que :value itens.',
    ],
    'max' => [
        'numeric' => 'O campo :attribute não pode ser superior a :max.',
        'file' => 'O campo :attribute não pode ser superior a :max kilobytes.',
        'string' => 'O campo :attribute não pode ser superior a :max caracteres.',
        'array' => 'O campo :attribute não pode ter mais do que :max itens.',
    ],
    'mimes' => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'mimetypes' => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'min' => [
        'numeric' => 'O campo :attribute deve ser pelo menos :min.',
        'file' => 'O campo :attribute deve ter pelo menos :min kilobytes.',
        'string' => 'O campo :attribute deve ter pelo menos :min caracteres.',
        'array' => 'O campo :attribute deve ter pelo menos :min itens.',
    ],
    'not_in' => 'O campo :attribute selecionado é inválido.',
    'not_regex' => 'O campo :attribute possui um formato inválido.',
    'numeric' => 'O campo :attribute deve ser um número.',
    'phone' => 'O campo :attribute não é um telefone válido.',
    'present' => 'O campo :attribute deve estar presente.',
    'regex' => 'O campo :attribute tem um formato inválido.',
    'recaptcha_verifier' => 'O reCAPTCHA é inválido ou expirou.',
    'required' => 'O campo :attribute é obrigatório.',
    'required_if' => 'O campo :attribute é obrigatório quando :other for :value.',
    'required_unless' => 'O campo :attribute é obrigatório exceto quando :other for :values.',
    'required_with' => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all' => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_without' => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos :values estão presentes.',
    'same' => 'Os campos :attribute e :other devem corresponder.',
    'size' => [
        'numeric' => 'O campo :attribute deve ser :size.',
        'file' => 'O campo :attribute deve ser :size kilobytes.',
        'string' => 'O campo :attribute deve ser :size caracteres.',
        'array' => 'O campo :attribute deve conter :size itens.',
    ],
    'string' => 'O campo :attribute deve ser uma string.',
    'timezone' => 'O campo :attribute deve ser uma zona válida.',
    'unique' => 'O campo :attribute já está sendo utilizado.',
    'uploaded' => 'Ocorreu uma falha no upload do campo :attribute.',
    'url' => 'O campo :attribute tem um formato inválido.',
    'uuid' => 'O campo :attribute deve ser um UUID válido.',

    'isin' => 'O :attribute não é um International Securities Identification Number (ISIN) válido.',
    'iban' => 'O :attribute não é um International Bank Account Number (IBAN) válido.',
    'bic' => 'O :attribute não é um Business Identifier Code (BIC) válido.',
    'hexcolor' => 'O :attribute não é uma cor válida.',
    'creditcard' => 'O :attribute não é um número de cartão de crédito válido.',
    'isbn' => 'O :attribute não é um International Standard Book Number (ISBN) válido.',
    'isodate' => 'O :attribute não é uma data no formato ISO 8601.',
    'username' => 'O :attribute não é um username válido.',
    'htmlclean' => 'O :attribute contém código HTML não permitido.',
    'password' => ':attribute precisa ter de 6 to 64 caracteres, incluindo pelo menos um dígito, uma letra maiúscula, uma letra minúscula e um símbolo especial.',
    'alpha_space' => ':attribute must contain only alphabetic characters and spaces.',
    'domainname' => ':attribute não é um nome de domínio válido.',
    'empty_with' => 'Ou :attribute ou o outro campo precisa ser preenchido, não os dois.',
    'already_has_subscription' => 'Você já possui esse conteúdo',
    'already_has_subscription.description' => 'Você já possui uma assinatura ativa dessa série. Se você está tendo problemas para acessar o conteúdo, entre em contato com o suporte técnico.',
    'already_has_report' => 'Você já possui esse relatório',
    'already_has_report.description' => 'Se você está tendo problemas para acessar o conteúdo, entre em contato com o suporte técnico.',
    'already_has_scheduled_subscription' => 'Você já possui uma assinatura agendada',
    'already_has_scheduled_subscription.description' => 'Não é possível realizar o upgrade da sua assinatura atual antes de ela ser iniciada.',
    'already_has_book_limit' => 'Vendas limitadas',
    'already_has_book_limit.description' => 'Você atingiu o limite de compras desse produto por CPF.',
    'already_has_book' => 'Você já possui este livro',
    'already_has_book.description' => 'Estamos limitando a oferta a um livro por assinante.',
    'already_has_linked' => 'Você já possui esse conteúdo',
    'already_has_linked.description' => 'Você já possui uma assinatura ativa dessa série. Se você está tendo problemas para acessar o conteúdo, entre em contato com o suporte técnico.',
    'already_has_renewal_offer' => 'Você já possui essa oferta',
    'already_has_renewal_offer.description' => '',
    'already_has_gift_renewal_offer' => 'Você já possui essa oferta',
    'already_has_gift_renewal_offer.description' => '',
    'event_registration_sold_out' => 'Inscrições esgotadas',
    'event_registration_sold_out.description' => 'Infelizmente as inscrições para esse evento esgotaram',
    'book_not_in_stock' => 'Livro fora de estoque',
    'book_not_in_stock.description' => 'Essa oferta já não está mais disponível.',
    'book_has_no_prerequisites' => 'Você não possui os pré-requisitos desta oferta.',
    'book_has_no_prerequisites.description' => '',
    'email_account_invalid' => 'O campo :attribute não contém uma conta de email válida.',
    'email_address_invalid' => 'O campo :attribute não contém um endereço de email válido.',
    'box_size_invalid_format' => 'O valor :value do campo :attribute possui um formato inválido.',
    'box_size_invalid_size' => 'O valor :value do campo :attribute possui uma das dimensões igual a zero.',
    'captcha' => 'O valor :value do campo :attribute é inválido.',
    'required_if_any' => 'É obrigatório um dos campos: :values, quando :attribute for :value.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'observations' => 'Observações',
        'cancellation_type' => 'Tipo de cancelamento',
        'reasons' => 'Motivo do Cancelamento',
        'subject' => 'Assunto',
        'description' => 'Descrição',
        'sizes' => 'Tamanho',
    ],

];
