<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Tower
 *
 * @property int $tower_id
 * @property int|null $provider_id
 * @property int|null $kelurahan_id
 * @property string|null $tower_address
 * @property string|null $tower_desc
 * @property float|null $tower_lng
 * @property float|null $tower_lat
 * @property string|null $tower_status
 * @property string|null $tower_size_type
 * @property string|null $tower_owner_type
 * @property string|null $tower_year
 * @property int|null $tower_is_active
 * @property float|null $tower_height
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $links
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tower newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tower newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tower onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tower query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tower whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tower whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tower whereKelurahanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tower whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tower whereTowerAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tower whereTowerDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tower whereTowerHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tower whereTowerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tower whereTowerIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tower whereTowerLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tower whereTowerLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tower whereTowerOwnerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tower whereTowerSizeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tower whereTowerStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tower whereTowerYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tower whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tower withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tower withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $tower_kode
 * @property-read mixed $tower_label
 * @property-read mixed $tower_map
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tower joinAll()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tower whereTowerKode($value)
 * @property-read \App\Models\Kelurahan|null $kelurahan
 * @property-read \App\Models\Provider|null $provider
 */
class Tower extends Model
{
    use SoftDeletes;

    protected $primaryKey = "tower_id";
    protected $table = "tb_tower";

    public function scopeJoinAll($query)
    {
        return $query->join("tb_kelurahan", "tb_tower.kelurahan_id", "=", "tb_kelurahan.kelurahan_id")
            ->join("tb_kecamatan", "tb_kelurahan.kecamatan_id", "=", "tb_kecamatan.kecamatan_id")
            ->join("tb_provider", "tb_tower.provider_id", "=", "tb_provider.provider_id");
    }

    public function getLinksAttribute()
    {
        return generate_links_api("tower", $this->attributes[$this->primaryKey]);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class, "provider_id")->withTrashed();
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, "kelurahan_id");
    }

    public function getTowerMapAttribute()
    {
//        https://www.google.com/maps/search/?api=1&query=58.698017,-152.522067
        $url = "https://www.google.com/maps/search/?api=1&query=";

        $lat = $this->attributes['tower_lat'];
        $lng = $this->attributes['tower_lng'];

        return "$url" . "$lat,$lng";
    }

    public function getTowerLabelAttribute()
    {
        $kec = isset($this->attributes['kecamatan_nama']) ? $this->attributes['kecamatan_nama'] : null;
        $kel = isset($this->attributes['kelurahan_nama']) ? $this->attributes['kelurahan_nama'] : null;
        $kode = isset($this->attributes['tower_kode']) ? $this->attributes['tower_kode'] : null;

        if ($kec && $kel && $kode) {
            return "$kode - Kecamatan $kec Kelurahan $kel";
        } else {
            return $kode;
        }
    }

    protected $appends = ['links', 'tower_map', 'tower_label'];

}
