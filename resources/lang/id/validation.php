<?php

return [

    /*
    |---------------------------------------------------------------------------------------
    | Baris Bahasa untuk Validasi
    |---------------------------------------------------------------------------------------
    |
    | Baris bahasa berikut ini berisi standar pesan kesalahan yang digunakan oleh
    | kelas validasi. Beberapa aturan mempunyai multi versi seperti aturan 'size'.
    | Jangan ragu untuk mengoptimalkan setiap pesan yang ada di sini.
    |
    */

    'accepted'             => 'Isian harus diterima.',
    'active_url'           => 'Isian bukan URL yang valid.',
    'after'                => 'Isian harus tanggal setelah :date.',
    'after_or_equal'       => 'Isian harus berupa tanggal setelah atau sama dengan tanggal :date.',
    'alpha'                => 'Isian hanya boleh berisi huruf.',
    'alpha_dash'           => 'Isian hanya boleh berisi huruf, angka, dan strip.',
    'alpha_num'            => 'Isian hanya boleh berisi huruf dan angka.',
    'array'                => 'Isian harus berupa sebuah array.',
    'before'               => 'Isian harus tanggal sebelum :date.',
    'before_or_equal'      => 'Isian harus berupa tanggal sebelum atau sama dengan tanggal :date.',
    'between'              => [
        'numeric' => 'Isian harus antara :min dan :max.',
        'file'    => 'Isian harus antara :min dan :max kilobytes.',
        'string'  => 'Isian harus antara :min dan :max karakter.',
        'array'   => 'Isian harus antara :min dan :max item.',
    ],
    'boolean'              => 'Isian harus berupa true atau false',
    'confirmed'            => 'Konfirmasi tidak cocok.',
    'date'                 => 'Isian bukan tanggal yang valid.',
    'date_format'          => 'Isian tidak cocok dengan format :format.',
    'different'            => 'Isian dan :other harus berbeda.',
    'digits'               => 'Isian harus berupa angka :digits.',
    'digits_between'       => 'Isian harus antara angka :min dan :max.',
    'dimensions'           => 'Bidang tidak memiliki dimensi gambar yang valid.',
    'distinct'             => 'Bidang isian memiliki nilai yang duplikat.',
    'email'                => 'Isian harus berupa alamat surel yang valid.',
    'exists'               => 'Isian yang dipilih tidak valid.',
    'file'                 => 'Bidang harus berupa sebuah berkas.',
    'filled'               => 'Isian harus memiliki nilai.',
    'image'                => 'Isian harus berupa gambar.',
    'in'                   => 'Isian yang dipilih tidak valid.',
    'in_array'             => 'Bidang isian tidak terdapat dalam :other.',
    'integer'              => 'Isian harus merupakan bilangan bulat.',
    'ip'                   => 'Isian harus berupa alamat IP yang valid.',
    'ipv4'                 => 'Isian harus berupa alamat IPv4 yang valid.',
    'ipv6'                 => 'Isian harus berupa alamat IPv6 yang valid.',
    'json'                 => 'Isian harus berupa JSON string yang valid.',
    'max'                  => [
        'numeric' => 'Isian seharusnya tidak lebih dari :max.',
        'file'    => 'Isian seharusnya tidak lebih dari :max kilobytes.',
        'string'  => 'Isian seharusnya tidak lebih dari :max karakter.',
        'array'   => 'Isian seharusnya tidak lebih dari :max item.',
    ],
    'mimes'                => 'Isian harus dokumen berjenis : :values.',
    'mimetypes'            => 'Isian harus dokumen berjenis : :values.',
    'min'                  => [
        'numeric' => 'Isian harus minimal :min.',
        'file'    => 'Isian harus minimal :min kilobytes.',
        'string'  => 'Isian harus minimal :min karakter.',
        'array'   => 'Isian harus minimal :min item.',
    ],
    'not_in'               => 'Isian yang dipilih tidak valid.',
    'numeric'              => 'Isian harus berupa angka.',
    'present'              => 'Bidang isian wajib ada.',
    'regex'                => 'Format isian tidak valid.',
    'required'             => 'Bidang isian wajib diisi.',
    'required_if'          => 'Bidang isian wajib diisi bila :other adalah :value.',
    'required_unless'      => 'Bidang isian wajib diisi kecuali :other memiliki nilai :values.',
    'required_with'        => 'Bidang isian wajib diisi bila terdapat :values.',
    'required_with_all'    => 'Bidang isian wajib diisi bila terdapat :values.',
    'required_without'     => 'Bidang isian wajib diisi bila tidak terdapat :values.',
    'required_without_all' => 'Bidang isian wajib diisi bila tidak terdapat ada :values.',
    'same'                 => 'Isian dan :other harus sama.',
    'size'                 => [
        'numeric' => 'Isian harus berukuran :size.',
        'file'    => 'Isian harus berukuran :size kilobyte.',
        'string'  => 'Isian harus berukuran :size karakter.',
        'array'   => 'Isian harus mengandung :size item.',
    ],
    'string'               => 'Isian harus berupa string.',
    'timezone'             => 'Isian harus berupa zona waktu yang valid.',
    'unique'               => 'Isian sudah ada sebelumnya.',
    'uploaded'             => 'Isian gagal diunggah.',
    'url'                  => 'Format isian tidak valid.',

    /*
    |---------------------------------------------------------------------------------------
    | Baris Bahasa untuk Validasi Kustom
    |---------------------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan pesan validasi kustom untuk atribut dengan menggunakan
    | konvensi "attribute.rule" dalam penamaan baris. Hal ini membuat cepat dalam
    | menentukan spesifik baris bahasa kustom untuk aturan atribut yang diberikan.
    |
    */

    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |---------------------------------------------------------------------------------------
    | Kustom Validasi Atribut
    |---------------------------------------------------------------------------------------
    |
    | Baris bahasa berikut digunakan untuk menukar atribut 'place-holders'
    | dengan sesuatu yang lebih bersahabat dengan pembaca seperti Alamat Surel daripada
    | "surel" saja. Ini benar-benar membantu kita membuat pesan sedikit bersih.
    |
    */

    'attributes'           => [
        //
    ],

];
