<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/9
 * Time: 下午5:34
 */

namespace App\Services\Api;

use App\Repositories\VideoRepository;
use App\Http\Resources\VideoRecordResource as VideoRecordResource;
use App\Http\Resources\VideoRecordCollection as VideoRecordCollection;

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
     * @param $input
     * @return string
     */
    public function getVideoReport($input)
    {
        $tableId = $input['tableId'];
        $round = $input['round'];
        $run = $input['run'];

        $videoLink = 'http://video.livecasino168.com/' . $tableId . '/' . $round . '/' . $round .'-' . $run . ".mp4";

        return $videoLink;
        //return new VideoRecordCollection(VideoRecordResource::collection($this->videoRepository->getVideoReport($tableId, $round, $run)));
    }
}
