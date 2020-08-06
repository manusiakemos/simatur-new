<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Arsip
 *
 * @property int $arsip_id
 * @property string|null $arsip_name
 * @property string|null $arsip_file
 * @property string|null $arsip_slug
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $links
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Arsip newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Arsip newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Arsip onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Arsip query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Arsip whereArsipFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Arsip whereArsipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Arsip whereArsipName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Arsip whereArsipSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Arsip whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Arsip whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Arsip whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Arsip withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Arsip withoutTrashed()
 * @mixin \Eloquent
 */
class Arsip extends Model
{
    use SoftDeletes;

    protected $primaryKey = "arsip_id";
    protected $table = "_arsip";

    public function getArsipFilePathAttribute()
    {
        $x = $this->attributes['arsip_slug'];
        return route('file.download', $x);
    }

    public function getLinksAttribute()
    {
        return generate_links_api("arsip", $this->attributes[$this->primaryKey]);
    }

    protected $appends = ['links','arsip_file_path'];


}
