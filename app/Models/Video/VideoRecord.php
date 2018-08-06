<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoRecord extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'VideoRecord';

    /**
     * primaryKey
     *
     * @var integer
     * @access protected
     */
    protected $primaryKey = 'RecordId';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'RecordId',
        'TableId',
        'TrnId',
        'Round',
        'Run',
        'StartTime'
    ];
}
