<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Zona
 *
 * @property int $zona_id
 * @property string|null $zona_type
 * @property int|null $kelurahan_id
 * @property float|null $zona_lat
 * @property float|null $zona_lng
 * @property float|null $zona_sub_1
 * @property float|null $zona_sub_2
 * @property float|null $zona_rural
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $links
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Zona newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Zona newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Zona onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Zona query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Zona whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Zona whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Zona whereKelurahanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Zona whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Zona whereZonaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Zona whereZonaLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Zona whereZonaLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Zona whereZonaRural($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Zona whereZonaSub1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Zona whereZonaSub2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Zona whereZonaType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Zona withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Zona withoutTrashed()
 * @mixin \Eloquent
 */
class Zona extends Model
{
    use SoftDeletes;

    protected $primaryKey = "zona_id";
    protected $table = "tb_zona";

    public $timestamps = false;

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function getLinksAttribute()
    {
        return generate_links_api("zona", $this->attributes[$this->primaryKey]);
    }

    protected $appends = ['links'];

    public function scopeJoinAll($query)
    {
        return $query->join("tb_kelurahan", "tb_zona.kelurahan_id", "=", "tb_kelurahan.kelurahan_id")
            ->join("tb_kecamatan", "tb_kelurahan.kecamatan_id", "=", "tb_kecamatan.kecamatan_id");
    }


}
