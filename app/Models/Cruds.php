<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\CrudGenerator
 *
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CrudGenerator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CrudGenerator newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CrudGenerator onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CrudGenerator query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CrudGenerator withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CrudGenerator withoutTrashed()
 * @mixin \Eloquent
 * @property int $crud_id
 * @property mixed $crud_json
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cruds whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cruds whereCrudId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cruds whereCrudJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cruds whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cruds whereUpdatedAt($value)
 */
class Cruds extends Model
{
    protected $connection = "cruds";
    protected $primaryKey = "crud_id";
    use SoftDeletes;
}
