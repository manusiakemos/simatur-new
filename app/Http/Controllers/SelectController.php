<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\Provider;
use App\Models\Tower;
use Illuminate\Http\Request;

class SelectController extends Controller
{
    public function __invoke(Request $request, $type)
    {
        switch ($type) {
            case 'tower':
                return Tower::joinall()->get();
                break;
            case 'provider':
                return Provider::all();
                break;
            case 'kelurahan':
                return Kelurahan::all();
                break;

            case 'tower_status':
                return [
                    [
                        'text' => 'diusulkan',
                        'value' => 'diusulkan',
                    ],
                    [
                        'text' => 'disetujui',
                        'value' => 'disetujui',
                    ],
                    [
                        'text' => 'ditolak',
                        'value' => 'ditolak',
                    ]
                ];
                break;
            case 'koneksi_tipe':
                return [
                    [
                        'text' => '2G',
                        'value' => '2g',
                    ],
                    [
                        'text' => '3G',
                        'value' => '3g',
                    ],
                    [
                        'text' => '4G',
                        'value' => '4g',
                    ],
                    [
                        'text' => '5G',
                        'value' => '5g',
                    ]
                ];
                break;

            case 'tower_size_type':
//                'makrocell','mikrocell','rooftop'
                return [
                    [
                        'text' => 'makrocell',
                        'value' => 'makrocell',
                    ],
                    [
                        'text' => 'mikrocell',
                        'value' => 'mikrocell',
                    ],
                    [
                        'text' => 'rooftop',
                        'value' => 'rooftop',
                    ]
                ];
                break;

                case 'tower_owner_type':
//                'provider','pemda','kominfo'
                return [
                    [
                        'text' => 'provider',
                        'value' => 'provider',
                    ],
                    [
                        'text' => 'pemda',
                        'value' => 'pemda',
                    ],
                    [
                        'text' => 'kominfo',
                        'value' => 'kominfo',
                    ]
                ];
                break;

            case 'menu':
                $data = file_get_contents(storage_path("json/menu.json"));
                $data = collect(json_decode($data));
                return $data;
                break;
            case'role':
                return [
                    [
                        'text' => 'super-admin',
                        'value' => 'super-admin',
                    ],
                    [
                        'text' => 'admin',
                        'value' => 'admin',
                    ]
                ];
                break;
            case'status':
                return [
                    [
                        'text' => 'aktif',
                        'value' => 'aktif',
                    ],
                    [
                        'text' => 'nonaktif',
                        'value' => 'nonaktif',
                    ]
                ];
                break;
            case'boolean':
                return [
                    [
                        'text' => 'Ya',
                        'value' => 1,
                    ],
                    [
                        'text' => "Tidak",
                        'value' => 0,
                    ]
                ];
                break;
        }
    }
}
