<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Skpd
 *
 * @property int $skpd_id
 * @property string|null $skpd_nama
 * @property int|null $skpd_status
 * @property string|null $skpd_ip
 * @property string|null $skpd_tipe
 * @property string|null $skpd_kode
 * @property string|null $skpd_keterangan
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $links
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Skpd newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Skpd newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Skpd onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Skpd query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Skpd whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Skpd whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Skpd whereSkpdId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Skpd whereSkpdIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Skpd whereSkpdKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Skpd whereSkpdKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Skpd whereSkpdNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Skpd whereSkpdStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Skpd whereSkpdTipe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Skpd whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Skpd withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Skpd withoutTrashed()
 * @mixin \Eloquent
 */
class Skpd extends Model
{
    use SoftDeletes;

    protected $primaryKey = "skpd_id";
    protected $table = "tb_skpd";

    public function getLinksAttribute()
    {
        return generate_links_api("skpd", $this->attributes[$this->primaryKey]);
    }

    public function getDetailsAttribute()
    {
        return null;
    }

    protected $appends = ['links', 'details'];


}
