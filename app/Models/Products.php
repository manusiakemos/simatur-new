<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Products
 *
 * @property int $product_id
 * @property int $brand_id
 * @property string $product_name
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Products onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Products whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Products withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Products withoutTrashed()
 * @mixin \Eloquent
 * @property-read mixed $links
 */
class Products extends Model
{
    use SoftDeletes;

    protected $primaryKey = "product_id";
    protected $table = "_product";

    public function getLinksAttribute()
    {
        return generate_links_api('product', $this->attributes[$this->primaryKey]);
    }

    protected $appends = ['links'];

}
