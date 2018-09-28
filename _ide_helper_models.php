<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 */
	class User extends \Eloquent {}
}

namespace App\Models\Video{
/**
 * App\Models\Video\VideoRecord
 *
 * @property int $RecordId
 * @property string $TableId 桌號
 * @property int $Round 輪號
 * @property int $Run 局號
 * @property string $StartTime 牌局開始時間
 * @property string $FilePath 影片S3存檔路徑
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoRecord whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoRecord whereRecordId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoRecord whereRound($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoRecord whereRun($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoRecord whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video\VideoRecord whereTableId($value)
 */
	class VideoRecord extends \Eloquent {}
}

namespace App\Models\BaccaratHistory{
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
 */
	class BaccaratHistory extends \Eloquent {}
}

