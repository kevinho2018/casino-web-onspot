<?php

namespace App\Models\BaccaratHistory;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BaccaratHistory\BaccaratHistory
 *
 * @property int $HistoryId
 * @property string $TableId 桌號
 * @property int $Round 輪號
 * @property int $Run 局號
 * @property string $WinSpot 牌局結果:莊家(Banker), 閒家(Player), 和(Tie)
 * @property string $Card1 閒1
 * @property string $Card2 莊1
 * @property string $Card3 閒2
 * @property string $Card4 莊2
 * @property string $Card5 閒補3
 * @property string $Card6 莊補3
 * @property string $ModifiedStatus 牌局狀態:未修改(Normal),改單(Modified),事後取消(Canceled)
 * @property string $ModifiedTime 牌局修改時間
 * @property string $CreateTime
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaccaratHistory\BaccaratHistory whereCard1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaccaratHistory\BaccaratHistory whereCard2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaccaratHistory\BaccaratHistory whereCard3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaccaratHistory\BaccaratHistory whereCard4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaccaratHistory\BaccaratHistory whereCard5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaccaratHistory\BaccaratHistory whereCard6($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaccaratHistory\BaccaratHistory whereCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaccaratHistory\BaccaratHistory whereHistoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaccaratHistory\BaccaratHistory whereModifiedStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaccaratHistory\BaccaratHistory whereModifiedTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaccaratHistory\BaccaratHistory whereRound($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaccaratHistory\BaccaratHistory whereRun($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaccaratHistory\BaccaratHistory whereTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaccaratHistory\BaccaratHistory whereWinSpot($value)
 * @mixin \Eloquent
 */
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
