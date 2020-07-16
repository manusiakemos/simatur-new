<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Brands
 *
 * @property int $brand_id
 * @property string|null $brand_name
 * @property string|null $brand_status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $links
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brands newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brands newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Brands onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brands query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brands whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brands whereBrandName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brands whereBrandStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brands whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brands whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Brands whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Brands withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Brands withoutTrashed()
 * @mixin \Eloquent
 */
class Brands extends Model
{
    use SoftDeletes;

    protected $primaryKey = "brand_id";
    protected $table = "brands";

    public function getLinksAttribute()
{
    return generate_links_api("brand", $this->attributes[$this->primaryKey]);
}

    protected $appends = ['links'];

    
}
