<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Provider;
use App\Models\Tower;
use Illuminate\Http\Request;

class SelectController extends Controller
{
    public function __invoke(Request $request, $type)
    {
        switch ($type) {
            case 'arsip_tipe':
                return [
                    [
                        'text' => 'regulasi',
                        'value' => 'regulasi',
                    ],
                    [
                        'text' => 'lainnya',
                        'value' => 'lainnya',
                    ]
                ];
                break;
            case 'all_operator_provider':
                return Provider::all();
                break;
            case 'tower':
                return Tower::joinall()->get();
                break;
            case 'provider':
                return Provider::where('provider_type', 'provider')
                    ->orWhere('provider_type', 'provider_operator')
                    ->get();
                break;
            case 'operator':
                return Provider::where('provider_type', 'operator')
                    ->orWhere('provider_type', 'provider_operator')
                    ->get();
                break;
            case 'provider_operator':
                return Provider::where('provider_type', 'provider_operator')->get();
                break;
            case 'provider_pemilik':
                return Provider::where('provider_type', 'provider')
                    ->orWhere('provider_type', 'provider_operator')
                    ->get();
                break;
            case 'kelurahan':
                return Kelurahan::all();
                break;
            case 'kecamatan':
                return Kecamatan::all();
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
            case 'provider_type':
                return [
                    [
                        'text' => 'Provider',
                        'value' => 'provider',
                    ],
                    [
                        'text' => 'Operator',
                        'value' => 'operator',
                    ],
                    [
                        'text' => 'Provider Operator',
                        'value' => 'provider_operator',
                    ]
                ];
                break;
            case 'map_type':
                return [
                    [
                        'text' => 'Provider (Pemilik Tower)',
                        'value' => 'provider',
                    ],
                    [
                        'text' => 'Operator (Pengguna Tower)',
                        'value' => 'operator',
                    ],
                ];
                break;
            case 'zona_type':
                return [
                    [
                        'text' => 'Sub Urban',
                        'value' => 'sub_urban',
                    ],
                    [
                        'text' => 'Rural',
                        'value' => 'rural',
                    ],
                ];
                break;
            case 'zona_type_filter':
                return [
                    [
                        'text' => 'Semua',
                        'value' => '',
                    ],
                    [
                        'text' => 'Sub Urban',
                        'value' => 'sub_urban',
                    ],
                    [
                        'text' => 'Rural',
                        'value' => 'rural',
                    ],
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
