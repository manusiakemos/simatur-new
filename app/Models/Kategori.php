<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Kategori
 *
 * @property int $kategori_id
 * @property string|null $kategori_nama
 * @property string|null $kategori_slug
 * @property int|null $kategori_status
 * @property string|null $kategori_gambar
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $links
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kategori newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kategori newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Kategori onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kategori query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kategori whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kategori whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kategori whereKategoriGambar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kategori whereKategoriId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kategori whereKategoriNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kategori whereKategoriSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kategori whereKategoriStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Kategori whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Kategori withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Kategori withoutTrashed()
 * @mixin \Eloquent
 */
class Kategori extends Model
{
    use SoftDeletes;

    protected $primaryKey = "kategori_id";
    protected $table = "kategori";

    public function getLinksAttribute()
{
    return generate_links_api("kategori", $this->attributes[$this->primaryKey]);
}

    protected $appends = ['links'];

    
}
