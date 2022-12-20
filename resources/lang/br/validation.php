<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | O campo following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'O campo :attribute deve ser aceito.',
    'accepted_if' => 'O campo :attribute deve ser aceito quando :other for :value.',
    'active_url' => 'O campo :attribute não contém uma URL válida.',
    'after' => 'O campo :attribute deve conter uma data posterior a :date.',
    'after_or_equal' => 'O campo :attribute deve conter uma data igual ou posterior a :date.',
    'alpha' => 'O campo :attribute deve conter apenas letras.',
    'alpha_dash' => 'O campo :attribute deve conter apenas letras, números, hífen (-) e underline (_).',
    'alpha_num' => 'O campo :attribute deve conter apenas letras e números.',
    'array' => 'O campo :attribute deve ser uma matriz.',
    'before' => 'O campo :attribute deve ser uma data anterior a :date.',
    'before_or_equal' => 'O campo :attribute deve conter uma data igual ou anterior a :date.',
    'between' => [
        'numeric' => 'O campo :attribute deve ser entre :min e :max.',
        'file' => 'O campo :attribute deve ter entre :min e :max Kb.',
        'string' => 'O campo :attribute deve ter entre :min e :max caracteres.',
        'array' => 'O campo :attribute deve ter entre :min e :max itens.',
    ],
    'boolean' => 'O campo :attribute deve ser verdadeiro (true) ou falso (false).',
    'confirmed' => 'O campo :attribute (confirmação) não corresponde.',
    'current_password' => 'O campo password está incorreto.',
    'date' => 'O campo :attribute não contém uma data válida.',
    'date_equals' => 'O campo :attribute deve ser igual a :date.',
    'date_format' => 'O campo :attribute deve conter uma data no formato :format.',
    'declined' => 'O campo :attribute deve ser recusado.',
    'declined_if' => 'O campo :attribute deve ser recusado quando :other for :value.',
    'different' => 'O campo :attribute e :other precisam ser diferentes.',
    'digits' => 'O campo :attribute deve ter :digits dígitos.',
    'digits_between' => 'O campo :attribute deve ter entre :min e :max dígitos.',
    'dimensions' => 'O campo :attribute contém um arquivo com dimensões inválidas.',
    'distinct' => 'O campo :attribute tem um valor duplicado.',
    'email' => 'O campo :attribute deve conter um e-mail válido.',
    'ends_with' => 'O campo :attribute deve terminar com um dos seguintes: :values.',
    'enum' => 'O campo selecionado :attribute é inválido.',
    'exists' => 'O campo selecionado :attribute é inválido.',
    'file' => 'O campo :attribute deve conter um arquivo válido.',
    'filled' => 'O campo :attribute deve ser preenchido.',
    'gt' => [
        'numeric' => 'O campo :attribute deve ser maior que :value.',
        'file' => 'O campo :attribute deve ser superior a :value Kb.',
        'string' => 'O campo :attribute deve conter mais de :value caracteres.',
        'array' => 'O campo :attribute deve conter mais de :value itens.',
    ],
    'gte' => [
        'numeric' => 'O campo :attribute deve ser maior ou igual a :value.',
        'file' => 'O campo :attribute deve ser maior ou igual a :value Kb.',
        'string' => 'O campo :attribute deve ser maior ou igual a :value caracteres.',
        'array' => 'O campo :attribute deve conter :value ou mais itens.',
    ],
    'image' => 'O campo :attribute deve ser uma imagem.',
    'in' => 'O campo selecionado :attribute é inválido.',
    'in_array' => 'O campo :attribute não existe em :other.',
    'integer' => 'O campo :attribute deve ser um número inteiro.',
    'ip' => 'O campo :attribute deve conter um endereço IP válido.',
    'ipv4' => 'O campo :attribute deve conter um endereço IPv4 válido.',
    'ipv6' => 'O campo :attribute deve conter um endereço IPv6 válido.',
    'json' => 'O campo :attribute deve conter uma string JSON válida.',
    'lt' => [
        'numeric' => 'O campo :attribute deve ser menor que :value.',
        'file' => 'O campo :attribute deve ser menor que :value Kb.',
        'string' => 'O campo :attribute deve ser menos que :value caracteres.',
        'array' => 'O campo :attribute deve ter menos que :value itens.',
    ],
    'lte' => [
        'numeric' => 'O campo :attribute deve ser menor ou igual a :value.',
        'file' => 'O campo :attribute deve ser menor ou igual a :value kilobytes.',
        'string' => 'O campo :attribute deve ter :value ou menos caracteres.',
        'array' => 'O campo :attribute não deve ter mais de :value itens.',
    ],
    'mac_address' => 'O campo :attribute deve conter um endereço MAC válido.',
    'max' => [
        'numeric' => 'O campo :attribute não deve ser maior que :max.',
        'file' => 'O campo :attribute não deve ser maior que :max Kb.',
        'string' => 'O campo :attribute não deve ter mais que :max caracteres.',
        'array' => 'O campo :attribute não deve ter mais que :max itens.',
    ],
    'mimes' => 'O campo :attribute deve conter um arquivo de um destes tipos: :values.',
    'mimetypes' => 'O campo :attribute deve conter um arquivo de um destes tipos: :values.',
    'min' => [
        'numeric' => 'O campo :attribute deve ser pelo menos :min.',
        'file' => 'O campo :attribute deve ter pelo menos :min Kb.',
        'string' => 'O campo :attribute deve ter pelo menos :min caracteres.',
        'array' => 'O campo :attribute deve ter pelo menos :min itens.',
    ],
    'multiple_of' => 'O campo :attribute deve ser múltiplo de :value.',
    'not_in' => 'O campo selecionado :attribute é inválido.',
    'not_regex' => 'O campo :attribute contém um formato inválido.',
    'numeric' => 'O campo :attribute deve ser um número.',
    'password' => 'O campo password está incorreto.',
    'present' => 'O campo :attribute deve estar presente.',
    'prohibited' => 'O campo :attribute é proibido.',
    'prohibited_if' => 'O campo :attribute é proibido quando :other for :value.',
    'prohibited_unless' => 'O campo :attribute é proibido a menos que :other estiver em :values.',
    'prohibits' => 'O campo :attribute proíbe :other de estar presente.',
    'regex' => 'O campo :attribute tem formato inválido.',
    'required' => 'O campo :attribute é obrigatório.',
    'required_array_keys' => 'O campo :attribute campo deve conter entradas para: :values.',
    'required_if' => 'O campo :attribute é obrigatório quando :other for :value.',
    'required_unless' => 'O campo :attribute é obrigatório a menos que :other estiver em :values.',
    'required_with' => 'O campo :attribute é obrigatório quando :values estiver presente.',
    'required_with_all' => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_without' => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos seguintes estiver presente: :values',
    'same' => 'O campo :attribute e :other precisar conter a mesma informação.',
    'size' => [
        'numeric' => 'O campo :attribute deve ter :size.',
        'file' => 'O campo :attribute deve ter :size Kb.',
        'string' => 'O campo :attribute deve ter :size caracteres.',
        'array' => 'O campo :attribute deve ter :size itens.',
    ],
    'starts_with' => 'O campo :attribute deve começar com um dos seguintes: :values.',
    'string' => 'O campo :attribute deve ser um texto.',
    'timezone' => 'O campo :attribute deve ter um Timezone válido.',
    'unique' => 'O campo :attribute já está em uso.',
    'uploaded' => 'O campo :attribute falhou ao ser enviado.',
    'url' => 'O campo :attribute deve conter uma URL válida.',
    'uuid' => 'O campo :attribute deve conter um UUID válido.',

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
    | O campo following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
