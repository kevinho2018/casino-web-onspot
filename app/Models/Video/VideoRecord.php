<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Video\VideoRecord
 *
 * @property int $RecordId
 * @property string $TableId 桌號
 * @property int $Round 輪號
 * @property int $Run 局號
 * @property string $StartTime 牌局開始時間
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoRecord whereRecordId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoRecord whereRound($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoRecord whereRun($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoRecord whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoRecord whereTableId($value)
 * @mixin \Eloquent
 */
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
        'Round',
        'Run',
        'StartTime'
    ];
}
