<?php

return [
    'accepted'             => ':Attribute qəbul edilməlidir.',
    'accepted_if'          => ':other :value olduqda :attribute qəbul edilməlidir.',
    'active_url'           => ':Attribute düzgün URL deyil.',
    'after'                => ':Attribute :date tarixindən sonrakı tarix olmalıdır.',
    'after_or_equal'       => ':Attribute :date tarixindən sonrakı və ya eyni tarixdə olmalıdır.',
    'alpha'                => ':Attribute yalnız hərflərdən ibarət olmalıdır.',
    'alpha_dash'           => ':Attribute yalnız hərflərdən, rəqəmlərdən, tire və alt xətlərdən ibarət olmalıdır.',
    'alpha_num'            => ':Attribute yalnız hərflərdən və rəqəmlərdən ibarət olmalıdır.',
    'array'                => ':Attribute massiv olmalıdır.',
    'before'               => ':Attribute :date tarixindən əvvəlki tarix olmalıdır.',
    'before_or_equal'      => ':Attribute :date tarixindən əvvəlki və ya ona bərabər olan bir tarix olmalıdır.',
    'between'              => [
        'array'   => ':Attribute elementlərinin sayı :min ilə :max arasında olmalıdır.',
        'file'    => ':Attribute :min ilə :max kilobayt arasında olmalıdır.',
        'numeric' => ':Attribute :min ilə :max arasında olmalıdır.',
        'string'  => ':Attribute :min ilə :max simvol arasında olmalıdır.',
    ],
    'boolean'              => ':Attribute sahəsi doğru (true) və ya yalan (false) olmalıdır.',
    'confirmed'            => ':Attribute sahəsinin dəyəri təsdiqlənənlə uyğun gəlmir.',
    'current_password'     => 'Şifrə yanlışdır.',
    'date'                 => ':Attribute düzgün tarix olmalıdır.',
    'date_equals'          => ':Attribute :date ilə bərabər tarix olmalıdır.',
    'date_format'          => ':Attribute :format formatına uyğun gəlmir.',
    'declined'             => ':Attribute rədd edilməlidir.',
    'declined_if'          => ':other :value olduqda :attribute rədd edilməlidir.',
    'different'            => ':Attribute və :other fərqli olmalıdır.',
    'digits'               => ':Attribute :digits rəqəmli olmalıdır.',
    'digits_between'       => ':Attribute sahəsindəki rəqəm sayı :min ilə :max arasında olmalıdır.',
    'dimensions'           => ':Attribute sahəsindəki şəklin ölçüləri yanlışdır.',
    'distinct'             => ':Attribute sahəsinin dəyərləri təkrarlanmamalıdır.',
    'email'                => ':Attribute düzgün e-poçt ünvanı olmalıdır.',
    'ends_with'            => ':Attribute sahəsi göstərilən dəyərlərdən biri ilə bitməlidir: :values.',
    'enum'                 => ':Attribute üçün seçilmiş dəyər yanlışdır.',
    'exists'               => ':Attribute üçün seçilmiş dəyər yanlışdır.',
    'file'                 => ':Attribute fayl olmalıdır.',
    'filled'               => ':Attribute sahəsinin dəyəri olmalıdır.',
    'gt'                   => [
        'array'   => ':Attribute sahəsinin dəyəri :value elementdən çox olmalıdır.',
        'file'    => ':Attribute sahəsinin fayl ölçüsü :value kilobaytdan çox olmalıdır.',
        'numeric' => ':Attribute sahəsinin dəyəri :value sayından böyük olmalıdır.',
        'string'  => ':Attribute sahəsinin dəyəri :value simvoldan çox olmalıdır.',
    ],
    'gte'                  => [
        'array'   => ':Attribute :value və ya daha çox elementdən ibarət olmalıdır.',
        'file'    => ':Attribute :value və ya daha çox kilobaytdan ibarət olmalıdır.',
        'numeric' => ':Attribute :value və ya daha böyük olmalıdır.',
        'string'  => ':Attribute :value və ya daha çox simvoldan ibarət olmalıdır.',
    ],
    'image'                => ':Attribute sahəsindəki fayl şəkil olmalıdır.',
    'in'                   => 'Seçilmiş :attribute yanlışdır.',
    'in_array'             => ':Attribute dəyəri :other daxilində mövcud deyil.',
    'integer'              => ':Attribute tam ədəd olmalıdır.',
    'ip'                   => ':Attribute düzgün IP ünvanı olmalıdır.',
    'ipv4'                 => ':Attribute düzgün IPv4 ünvanı olmalıdır.',
    'ipv6'                 => ':Attribute düzgün IPv6 ünvanı olmalıdır.',
    'json'                 => ':Attribute düzgün JSON sətri olmalıdır.',
    'lt'                   => [
        'array'   => ':Attribute sahəsinin dəyəri :value elementdən az olmalıdır.',
        'file'    => ':Attribute sahəsinin fayl ölçüsü :value kilobaytdan az olmalıdır.',
        'numeric' => ':Attribute sahəsinin dəyəri :value sayından kiçik olmalıdır.',
        'string'  => ':Attribute sahəsinin dəyəri :value simvoldan az olmalıdır.',
    ],
    'lte'                  => [
        'array'   => ':Attribute :value və ya daha az elementdən ibarət olmalıdır.',
        'file'    => ':Attribute sahəsinin fayl ölçüsü :value kilobayt və ya daha kiçik olmalıdır.',
        'numeric' => ':Attribute :value və ya daha kiçik olmalıdır.',
        'string'  => ':Attribute :value və ya daha az simvoldan ibarət olmalıdır.',
    ],
    'mac_address'          => ':Attribute düzgün MAC ünvanı olmalıdır.',
    'max'                  => [
        'array'   => ':Attribute ən çoxu :max elementdən ibarət ola bilər.',
        'file'    => ':Attribute sahəsinin fayl ölçüsü ən çoxu :max kilobayt ola bilər.',
        'numeric' => ':Attribute dəyəri :max sayından böyük ola bilməz.',
        'string'  => ':Attribute ən çoxu :max simvoldan ibarət ola bilər.',
    ],
    'mimes'                => ':Attribute sahəsindəki fayl göstərilən növlərdən biri olmalıdır: :values.',
    'mimetypes'            => ':Attribute sahəsindəki fayl göstərilən növlərdən biri olmalıdır: :values.',
    'min'                  => [
        'array'   => ':Attribute ən azı :min elementdən ibarət olmalıdır.',
        'file'    => ':Attribute sahəsinin fayl ölçüsü ən azı :min kilobayt olmalıdır.',
        'numeric' => ':Attribute :min sayından kiçik ola bilməz.',
        'string'  => ':Attribute ən azı :min simvoldan ibarət olmalıdır.',
    ],
    'multiple_of'          => ':Attribute sahəsinin dəyəri :value ədədinin bölünəni olmalıdır.',
    'not_in'               => 'Seçilmiş :attribute yanlışdır.',
    'not_regex'            => ':Attribute sahəsinin formatı yanlışdır.',
    'numeric'              => ':Attribute sahəsinin dəyəri rəqəm olmalıdır.',
    'password'             => 'Şifrə yanlışdır.',
    'present'              => ':Attribute sahəsi mövcud olmalıdır.',
    'prohibited'           => ':Attribute sahəsi qadağandır.',
    'prohibited_if'        => ':other :value olduqda :attribute sahəsi qadağandır.',
    'prohibited_unless'    => ':other :values daxilində olmadığı halda :attribute sahəsi qadağandır.',
    'prohibits'            => ':Attribute sahəsinin dəyəri :other dəyərinin mövcudluğunu qadağan edir.',
    'regex'                => ':Attribute sahəsinin formatı yanlışdır.',
    'required'             => ':Attribute mütləq qeyd edilməlidir.',
    'required_array_keys'  => ':Attribute massivində göstərilən açarlar olmalıdır: :values.',
    'required_if'          => ':other :value olduqda :attribute mütləq qeyd edilməlidir.',
    'required_unless'      => ':other :values daxilində olmadığı halda :attribute mütləq qeyd edilməlidir.',
    'required_with'        => ':values mövcud olduqda :attribute mütləq qeyd edilməlidir.',
    'required_with_all'    => ':values mövcud olduqda :attribute mütləq qeyd edilməlidir.',
    'required_without'     => ':values mövcud olmadıqda :attribute mütləq qeyd edilməlidir.',
    'required_without_all' => ':values mövcud olmadıqda :attribute mütləq qeyd edilməlidir.',
    'same'                 => ':Attribute ilə :other sahəsinin dəyərləri üst-üstə düşməlidir.',
    'size'                 => [
        'array'   => ':Attribute sahəsi :size elementdən ibarət olmalıdır.',
        'file'    => ':Attribute sahəsinin fayl ölçüsü :size kilobayt olmalıdır.',
        'numeric' => ':Attribute dəyəri :size olmalıdır.',
        'string'  => ':Attribute :size simvoldan ibarət olmalıdır.',
    ],
    'starts_with'          => ':Attribute göstərilən dəyərlərdən biri ilə başlamalıdır: :values.',
    'string'               => ':Attribute sahəsinin dəyəri sətir olmalıdır.',
    'timezone'             => ':Attribute sahəsinin dəyəri düzgün vaxt qurşağı olmalıdır.',
    'unique'               => 'Belə bir :attribute artıq mövcuddur.',
    'uploaded'             => ':Attribute yüklənmədi.',
    'url'                  => ':Attribute düzgün URL olmalıdır.',
    'uuid'                 => ':Attribute düzgün UUID olmalıdır.',
    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    'attributes' => [
        'username' => 'İstifadəçi adı',
        'password' => 'Şifrə',
        'state'    => 'Status',
    ],
];
