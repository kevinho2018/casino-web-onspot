<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/9/10
 * Time: 下午4:42
 */

namespace App\Services\CasinoAdmin;

use App\Repositories\ServerApiCallRecordRepository;

class ServerApiCallRecordService
{
    /**
     * @var ServerApiCallRecordRepository
     */
    protected $serverApiCallRecordRepository;

    /**
     * ServerApiCallRecordService constructor.
     * @param ServerApiCallRecordRepository $serverApiCallRecordRepository
     */
    public function __construct(ServerApiCallRecordRepository $serverApiCallRecordRepository)
    {
        $this->serverApiCallRecordRepository = $serverApiCallRecordRepository;
    }

    /**
     * @param array $prepareData
     * @param $serverResponse
     */
    public function success(array $prepareData, string $serverResponse)
    {
        $this->serverApiCallRecordRepository->createData(
            array_merge(
                $prepareData,
                [
                    'Status' => 'Success',
                    'ResponseContent' => $serverResponse
                ]
            )
        );
    }

    /**
     * @param array $prepareData
     * @param string $serverResponse
     */
    public function failed(array $prepareData, string $serverResponse)
    {
        $this->serverApiCallRecordRepository->createData(
            array_merge(
                $prepareData,
                [
                    'Status' => 'Failed',
                    'ResponseContent' => $serverResponse
                ]
            )
        );
    }

}
