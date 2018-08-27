<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServerApiCallRecord extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ServerApiCallRecord';

    /**
     * primaryKey
     *
     * @var integer
     * @access protected
     */
    protected $primaryKey = 'ServerApiId';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ServerApiId',
        'IP',
        'Url',
        'RequestMethod',
        'RequestParams',
        'ResponseStatus',
        'ResponseCode',
        'ResponseFullContent',
        'RequestTime',
        'ResponseTime',
    ];
}
