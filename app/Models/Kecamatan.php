<?php

namespace App\Models;

use App\Scopes\KecamatanTabalong;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Kecamatan
 *
 * @property int $kecamatan_id
 * @property int $kabupaten_id
 * @property string|null $kecamatan_kd
 * @property string $kecamatan_nama
 * @property string|null $kecamatan_kodepos
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kecamatan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kecamatan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kecamatan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kecamatan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kecamatan whereKabupatenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kecamatan whereKecamatanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kecamatan whereKecamatanKd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kecamatan whereKecamatanKodepos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kecamatan whereKecamatanNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kecamatan whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Kecamatan extends Model
{
    protected $table = "tb_kecamatan";

    protected $primaryKey = "kecamatan_id";

    protected static function booted()
    {
        static::addGlobalScope(new KecamatanTabalong());
    }
}
