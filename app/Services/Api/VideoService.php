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
     * @param $input
     * @return string
     */
    public function getVideoReport($input)
    {
        $tableId = $input['tableId'];
        $round = $input['round'];
        $run = $input['run'];

        return $this->videoRepository->getVideoReport($tableId, $round, $run);
    }
}
