<?php

return [
    'accepted'         => ':attribute mora biti prihvacen.',
    'active_url'       => ':attribute nije vazeci URL.',
    'after'            => ':attribute mora biti datum nakon :date.',
    'after_or_equal'   => ':attribute mora biti datum posle ili na dan :date.',
    'alpha'            => ':attribute moze sadrzati samo slova.',
    'alpha_dash'       => ':attribute  moze sadrzati samo slova, brojeve i crticu.',
    'alpha_num'        => ':attribute moze sadrzati samo slova i brojeve.',
    'latin'            => 'The :attribute may only contain ISO basic Latin alphabet letters.',
    'latin_dash_space' => 'The :attribute may only contain ISO basic Latin alphabet letters, numbers, dashes, hyphens and spaces.',
    'array'            => ':attribute mora biti niz.',
    'before'           => ':attribute mora biti pre :date.',
    'before_or_equal'  => ':attribute mora biti datum pre ili na :date.',
    'between'          => [
        'numeric' => ':attribute mora biti izmedju :min i :max.',
        'file'    => ':attribute mora imati minimum :min  i maksimum :max kilobajta.',
        'string'  => ':attribute mora imati minimum :min i maksimum :max karaktera.',
        'array'   => ':attribute mora imati minimum :min i maksimum :max stavki.',
    ],
    'boolean'        => ':attribute mora biti true ili false.',
    'confirmed'      => ':attribute potvrde se ne poklapaju.',
    'date'           => ':attribute nije vazeci datum.',
    'date_equals'    => ':attribute mora biti datum jednak :date.',
    'date_format'    => ':attribute se ne poklapa sa formatom :format.',
    'different'      => ':attribute  i :other se moraju razlikovati.',
    'digits'         => ':attribute mora biti :digits brojeva.',
    'digits_between' => ':attribute mora biti izmedju :min i :max brojeva.',
    'dimensions'     => ':attribute ima nevazece dimenzije slike.',
    'distinct'       => ':attribute ima duplikat vrednost.',
    'email'          => ':attribute mora biti validna email adresa.',
    'ends_with'      => ':attribute se mora zavrsavati sa jednim od :values.',
    'exists'         => 'Izabrani :attribute je nevazeci.',
    'file'           => ':attribute mora biti fajl.',
    'filled'         => ':attribute polje mora imati vrednost.',
    'gt'             => [
        'numeric' => ':attribute mora biti veci od :value.',
        'file'    => ':attribute mora biti veci od :value kilobajta.',
        'string'  => ':attribute mora imati vise od :value karaktera.',
        'array'   => ':attribute mora imati vise od :value stavke.',
    ],
    'gte' => [
        'numeric' => ':attribute mora biti veci ili jednak sa :value.',
        'file'    => ':attribute mora biti veci ili jednak :sa value kilobajta.',
        'string'  => ':attribute mora sadrzati minimum :attribute karaktera.',
        'array'   => ':attribute mora imati :value stavki ili vise.',
    ],
    'image'    => ':attribute mora biti slika.',
    'in'       => 'Izabrani :attribute je nevazeci.',
    'in_array' => ':attribute polje ne postoji u :other.',
    'integer'  => ':attribute mora biti broj.',
    'ip'       => ':attribute mora biti validna IP adresa.',
    'ipv4'     => ':attribute mora biti validna IPv4 adresa.',
    'ipv6'     => ':attribute mora biti validna IPv6 adresa.',
    'json'     => ':attribute mora biti validan JSON string.',
    'lt'       => [
        'numeric' => 'The :attribute must be less than :value.',
        'file'    => 'The :attribute must be less than :value kilobytes.',
        'string'  => 'The :attribute must be less than :value characters.',
        'array'   => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file'    => 'The :attribute must be less than or equal :value kilobytes.',
        'string'  => 'The :attribute must be less than or equal :value characters.',
        'array'   => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'The :attribute may not be greater than :max characters.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'     => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min'       => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'The :attribute must be at least :min characters.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'not_regex'            => 'The :attribute format is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'password'             => 'The password is incorrect.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'The :attribute field is required.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string'      => 'The :attribute must be a string.',
    'timezone'    => 'The :attribute must be a valid zone.',
    'unique'      => 'The :attribute has already been taken.',
    'uploaded'    => 'The :attribute failed to upload.',
    'url'         => 'The :attribute format is invalid.',
    'uuid'        => 'The :attribute must be a valid UUID.',
    'custom'      => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    'reserved_word'                  => 'The :attribute contains reserved word',
    'dont_allow_first_letter_number' => '\":input\" polje ne moze imati za prvo slovo broj',
    'exceeds_maximum_number'         => ':attribute prelazi maksimalnu dozvoljenu duzinu.',
    'db_column'                      => ':attribute moze jedino sadrzati ISO latinska alfabeticna slova, brojeve, srednju crtu i ne moze pocinjati brojem.',
    'attributes'                     => [],
];
