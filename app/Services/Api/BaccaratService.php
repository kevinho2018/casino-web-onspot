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
     * @param $request
     * @return BaccaratHistoryCollection
     */
    public function getBaccaratHistoryReport($request)
    {
        $searchStartTime = $request->get('startAt');
        $searchEndTime = $request->get('endAt');
        $status = $request->get('modifiedStatus');

        return new BaccaratHistoryCollection(BaccaratHistoryResource::collection($this->baccaratRepository->getBaccaratHistoryReport($searchStartTime, $searchEndTime, $status)));
    }
}