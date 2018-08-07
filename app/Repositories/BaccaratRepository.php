<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/7
 * Time: 下午5:08
 */

namespace App\Repositories;

use App\Models\BaccaratHistory\BaccaratHistory;

class BaccaratRepository
{
    /**
     * @var BaccaratHistory
     */
    protected $baccaratHistory;

    /**
     * BaccaratRepository constructor.
     * @param BaccaratHistory $baccaratHistory
     */
    public function __construct(BaccaratHistory $baccaratHistory)
    {
        $this->baccaratHistory = $baccaratHistory;
    }

    /**
     * @param $searchStartTime
     * @param $searchEndTime
     * @param $status
     * @return \Illuminate\Support\Collection
     */
    public function getBaccaratHistoryReport($searchStartTime, $searchEndTime, $status)
    {
        return $this->baccaratHistory
            ->where('ModifiedTime', '>=', $searchStartTime)
            ->where('ModifiedTime', '<=', $searchEndTime)
            ->where('ModifiedStatus', '=', $status)
            ->get();
    }


}