<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Permohonan
 *
 * @property int $p_id
 * @property string|null $p_desc
 * @property string|null $p_status
 * @property string|null $p_alasan
 * @property int|null $kelurahan_id
 * @property int|null $user_id
 * @property float|null $p_lat
 * @property float|null $p_lng
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $links
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permohonan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permohonan newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permohonan onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permohonan query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permohonan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permohonan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permohonan whereKelurahanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permohonan wherePAlasan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permohonan wherePDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permohonan wherePId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permohonan wherePLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permohonan wherePLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permohonan wherePStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permohonan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permohonan whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permohonan withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permohonan withoutTrashed()
 * @mixin \Eloquent
 */
class Permohonan extends Model
{
    use SoftDeletes;

    protected $primaryKey = "p_id";
    protected $table = "tb_permohonan";

    public function scopeJoinData($query)
    {
        return $query->join("users", "users.id", "=", "tb_permohonan.user_id")
            ->join("tb_provider", "users.provider_id", "=", "tb_provider.provider_id")
            ->join("tb_kelurahan", "tb_permohonan.kelurahan_id", "=", "tb_kelurahan.kelurahan_id")
            ->join("tb_kecamatan", "tb_kelurahan.kecamatan_id", "=", "tb_kecamatan.kecamatan_id");
    }

    public function getLinksAttribute()
    {
        return generate_links_api("permohonan", $this->attributes[$this->primaryKey]);
    }

    protected $appends = ['links'];


}
