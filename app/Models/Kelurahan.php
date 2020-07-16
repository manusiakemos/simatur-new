<?php

namespace App\Models;

use App\Scopes\KelurahanTabalong;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Kelurahan
 *
 * @property int $kelurahan_id
 * @property int $kecamatan_id
 * @property string|null $kelurahan_kd
 * @property string $kelurahan_nama
 * @property string|null $kelurahan_kantor_desa
 * @property string|null $kelurahan_kodepos
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kelurahan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kelurahan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kelurahan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kelurahan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kelurahan whereKecamatanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kelurahan whereKelurahanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kelurahan whereKelurahanKantorDesa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kelurahan whereKelurahanKd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kelurahan whereKelurahanKodepos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kelurahan whereKelurahanNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kelurahan whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Kelurahan extends Model
{
    protected $table = "tb_kelurahan";

    protected $primaryKey = "Kelurahan_id";

    protected static function booted()
    {
        static::addGlobalScope(new KelurahanTabalong());
    }

    public function getKelurahanNamaAttribute()
    {
        return strtoupper($this->attributes['kelurahan_nama'] . ' kecamatan ' . $this->attributes['kecamatan_nama']);
    }
}
