<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/9
 * Time: 下午5:34
 */

namespace App\Services\Api;

use App\Repositories\VideoRepository;

/**
 * @property VideoRepository videoRepository
 */
class VideoService
{
    /**
     * VideoService constructor.
     * @param VideoRepository $videoRepository
     */
    public function __construct(
        VideoRepository $videoRepository
    ) {
        $this->videoRepository = $videoRepository;
    }

    /**
     * @param array $input
     * @return array
     */
    public function getVideoReport(array $input)
    {
        $tableId = $input['tableId'];
        $round = $input['round'];
        $run = $input['run'];

        // 檢查此桌輪局是否存在
        if ($this->videoRepository->getVideoReport($tableId, $round, $run) == null) {
            return [
                'status' => 'Failed',
                'message' => 'Video not exist'
            ];
        }

        $videoLink = 'http://video.livecasino168.com/' . $tableId . '/' . $round . '/' . $round .'-' . $run . ".mp4";

        return [
            "status" => "Success",
            "videoLink" => $videoLink
        ];
    }
}
