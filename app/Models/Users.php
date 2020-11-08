<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Users
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string $username
 * @property string|null $avatar
 * @property string|null $phone
 * @property string $role
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $links
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Users withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $api_token
 * @property string|null $remember_toen
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users whereRememberToen($value)
 * @property int|null $provider_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Users whereProviderId($value)
 */
class Users extends Model
{
    use SoftDeletes;

    protected $primaryKey = "id";
    protected $table = "users";

    public function getLinksAttribute()
{
    return generate_links_api("user", $this->attributes[$this->primaryKey]);
}

    protected $appends = ['links'];

    
}
