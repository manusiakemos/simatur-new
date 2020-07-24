<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\TowerProvider
 *
 * @property int $tp_id
 * @property int|null $tower_id
 * @property int|null $provider_id
 * @property string|null $koneksi_tipe
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $links
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TowerProvider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TowerProvider newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TowerProvider onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TowerProvider query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TowerProvider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TowerProvider whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TowerProvider whereKoneksiTipe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TowerProvider whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TowerProvider whereTowerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TowerProvider whereTpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TowerProvider whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TowerProvider withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TowerProvider withoutTrashed()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TowerProvider joinAll()
 */
class TowerProvider extends Model
{
    use SoftDeletes;

    protected $primaryKey = "tp_id";
    protected $table = "tb_tower_provider";

    public function getLinksAttribute()
    {
        if (isset($this->attributes[$this->primaryKey])) {
            return generate_links_api("towerprovider", $this->attributes[$this->primaryKey]);
        } else {
            return '-';
        }
    }

    public function scopeJoinAll($query)
    {
        return $query
            ->join("tb_tower", "tb_tower_provider.tower_id", "=", "tb_tower.tower_id")
            ->join("tb_provider", "tb_tower_provider.provider_id", "=", "tb_provider.provider_id")
            ->join("tb_kelurahan", "tb_tower.kelurahan_id", "=", "tb_kelurahan.kelurahan_id")
            ->join("tb_kecamatan", "tb_kelurahan.kecamatan_id", "=", "tb_kecamatan.kecamatan_id");
    }

    protected $appends = ['links'];


}
