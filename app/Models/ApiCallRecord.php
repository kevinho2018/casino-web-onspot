<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiCallRecord
 *
 * @package App\Models
 * @property int $RecordId
 * @property string $Status
 * @property string $Ip
 * @property string $RequestMethod 請求方法
 * @property string $RequestContent 請求內容
 * @property string $RequestUrl 來源url
 * @property string $RequestApi 請求操作 Api
 * @property string $ResponseContent Api 回應內容
 * @property string $RequestTime
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApiCallRecord whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApiCallRecord whereRecordId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApiCallRecord whereRequestApi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApiCallRecord whereRequestContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApiCallRecord whereRequestMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApiCallRecord whereRequestTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApiCallRecord whereRequestUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApiCallRecord whereResponseContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ApiCallRecord whereStatus($value)
 * @mixin \Eloquent
 */
class ApiCallRecord extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ApiCallRecord';

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
        'Status',
        'Ip',
        'RequestMethod',
        'RequestContent',
        'RequestUrl',
        'RequestApi',
        'ResponseContent',
        'RequestTime'
    ];
}
