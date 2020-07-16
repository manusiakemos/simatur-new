<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Provider
 *
 * @property int $provider_id
 * @property string|null $provider_name
 * @property string|null $provider_color
 * @property int|null $provider_operator
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $links
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Provider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Provider newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Provider onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Provider query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Provider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Provider whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Provider whereProviderColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Provider whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Provider whereProviderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Provider whereProviderOperator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Provider whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Provider withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Provider withoutTrashed()
 * @mixin \Eloquent
 */
class Provider extends Model
{
    use SoftDeletes;

    protected $primaryKey = "provider_id";
    protected $table = "tb_provider";

    public function getLinksAttribute()
    {
        return generate_links_api("provider", $this->attributes[$this->primaryKey]);
    }

    protected $appends = ['links'];


}
