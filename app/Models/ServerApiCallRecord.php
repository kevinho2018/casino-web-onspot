<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ServerApiCallRecord
 *
 * @property int $ServerApiId
 * @property string $Status
 * @property string $Account 使用者帳號
 * @property string $Ip
 * @property string $RequestContent 請求內容
 * @property string $RequestUrl 來源url
 * @property string $RequestMethod 請求操作 Api
 * @property string $ResponseContent Api 回應內容
 * @property string $RequestTime
 * @property string $ResponseTime
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerApiCallRecord whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerApiCallRecord whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerApiCallRecord whereRequestContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerApiCallRecord whereRequestMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerApiCallRecord whereRequestTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerApiCallRecord whereRequestUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerApiCallRecord whereResponseContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerApiCallRecord whereResponseTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerApiCallRecord whereServerApiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerApiCallRecord whereStatus($value)
 * @mixin \Eloquent
 */
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
        'Status',
        'Account',
        'Ip',
        'RequestContent',
        'RequestUrl',
        'RequestMethod',
        'ResponseContent',
        'RequestTime',
        'ResponseTime'
    ];
}
