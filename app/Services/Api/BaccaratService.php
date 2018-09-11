<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/7
 * Time: 下午5:00
 */

namespace App\Services\Api;

use App\Http\Resources\BaccaratHistoryResource as BaccaratHistoryResource;
use App\Http\Resources\BaccaratHistoryCollection as BaccaratHistoryCollection;
use App\Repositories\BaccaratRepository;
use Illuminate\Http\Request;

/**
 * @property BaccaratRepository baccaratRepository
 */
class BaccaratService
{
    /**
     * BaccaratService constructor.
     * @param BaccaratRepository $baccaratRepository
     */
    public function __construct(
        BaccaratRepository $baccaratRepository
    ) {
        $this->baccaratRepository = $baccaratRepository;
    }

    /**
     * @param array $input
     * @return BaccaratHistoryCollection
     */
    public function getBaccaratHistoryReport(array $input)
    {
        $searchStartTime = $input['startAt'];
        $searchEndTime = $input['endAt'];
        $status = $input['modifiedStatus'];

        return new BaccaratHistoryCollection(BaccaratHistoryResource::collection($this->getGameReport($searchStartTime,
            $searchEndTime, $status)));
    }

    /**
     * @param $searchStartTime
     * @param $searchEndTime
     * @param $status
     * @return \Illuminate\Support\Collection
     */
    public function getGameReport($searchStartTime, $searchEndTime, $status)
    {
        return $this->baccaratRepository->getBaccaratHistoryReport($searchStartTime, $searchEndTime, $status);
    }
}
