<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\users
 *
 * @property int $id
 * @property int|null $role_id
 * @property string $name
 * @property string $email
 * @property string|null $avatar
 * @property string $password
 * @property string|null $remember_token
 * @property string|null $settings
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\users whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\users whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\users whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\users whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\users whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\users wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\users whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\users whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\users whereSettings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\users whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class users extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * primaryKey
     *
     * @var integer
     * @access protected
     */
    protected $primaryKey = 'id';
}