<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Items
 *
 * @property int $id
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Items onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Items whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Items withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Items withoutTrashed()
 * @mixin \Eloquent
 */
class Items extends Model
{
    use SoftDeletes;

    protected $primaryKey = "id";
    protected $table = "_item";

    
}
