<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/9
 * Time: 下午5:36
 */

namespace App\Repositories;

use App\Models\Video\VideoRecord;

/**
 * @property VideoRecord videoRecord
 */
class VideoRepository
{
    /**
     * @var VideoRecord
     */
    protected $videoRecord;

    /**
     * VideoRepository constructor.
     * @param VideoRecord $videoRecord
     */
    public function __construct(VideoRecord $videoRecord)
    {
        $this->videoRecord = $videoRecord;
    }

    /**
     * @param $tableId
     * @param $round
     * @param $run
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getVideoReport($tableId, $round, $run)
    {
        $temp = $this->videoRecord
            ->where('TableId', '=', $tableId)
            ->where('Round', '=', $round)
            ->where('Run', '=', $run)
            ->get();
        return $temp;
    }
}
