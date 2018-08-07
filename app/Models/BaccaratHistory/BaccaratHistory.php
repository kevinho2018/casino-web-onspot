<?php

namespace App\Models\BaccaratHistory;

use Illuminate\Database\Eloquent\Model;

class BaccaratHistory extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'BaccaratHistory';

    /**
     * No use created_at, updated_at
     *
     * @var
     */
    public $timestamps = false;

    /**
     * primary key
     * @var string
     */
    protected $primaryKey = 'HistoryId';

    /**
     * @var array
     */
    protected $fillable = [
        'TableId',
        'Round',
        'Run',
        'WinSpot',
        'Card1',
        'Card2',
        'Card3',
        'Card4',
        'Card5',
        'Card6',
        'ModifiedStatus',
        'ModifiedTime',
        'CreateTime'
    ];
}
