<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Kunjungan
 *
 * @property int $kunjungan_id
 * @property string|null $kunjungan_tanggal
 * @property string|null $kunjungan_gambar
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $links
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kunjungan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kunjungan newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Kunjungan onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kunjungan query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kunjungan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kunjungan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kunjungan whereKunjunganGambar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kunjungan whereKunjunganId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kunjungan whereKunjunganTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kunjungan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Kunjungan withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Kunjungan withoutTrashed()
 * @mixin \Eloquent
 * @property int|null $tower_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kunjungan whereTowerId($value)
 */
class Kunjungan extends Model
{
    use SoftDeletes;

    protected $primaryKey = "kunjungan_id";
    protected $table = "tb_kunjungan";

    public function getLinksAttribute()
    {
        return generate_links_api("kunjungan", $this->attributes[$this->primaryKey]);
    }

    public function getKunjunganGambarAttribute($value)
    {
        return asset("uploads/images/$value");
    }

    public function scopeJoinAll($query)
    {
        return $query->leftJoin("tb_tower", "tb_kunjungan.tower_id", "=", "tb_tower.tower_id")
            ->join("tb_kelurahan", "tb_tower.kelurahan_id", "=", "tb_kelurahan.kelurahan_id")
            ->join("tb_kecamatan", "tb_kelurahan.kecamatan_id", "=", "tb_kecamatan.kecamatan_id")
            ->join("tb_provider", "tb_tower.provider_id", "=", "tb_provider.provider_id");
    }

    protected $appends = ['links'];


}
