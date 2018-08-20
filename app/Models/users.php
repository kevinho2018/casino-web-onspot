<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    ];
}