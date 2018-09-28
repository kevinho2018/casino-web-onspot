<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/9/10
 * Time: 下午4:37
 */

namespace App\Repositories;

use App\Models\ServerApiCallRecord;

/**
 * Class ServerApiCallRecordRepository
 * @property ServerApiCallRecord serverApiCallRecord
 * @package App\Repositories
 */
class ServerApiCallRecordRepository
{
    /**
     * ServerApiCallRecordRepository constructor.
     * @param ServerApiCallRecord $serverApiCallRecord
     */
    public function __construct(ServerApiCallRecord $serverApiCallRecord)
    {
        $this->serverApiCallRecord = $serverApiCallRecord;
    }

    /**
     * @param array $data
     */
    public function createData(array $data)
    {
        $this->serverApiCallRecord->insert($data);
    }
}
