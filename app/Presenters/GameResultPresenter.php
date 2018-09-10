<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/9/4
 * Time: 上午10:36
 */

namespace App\Presenters;

/**
 * Class GameResultPresenter
 * @package App\Presenters
 */
class GameResultPresenter
{
    /**
     * @param $card
     * @return null|string
     */
    public function showCard5Card6($card)
    {
        // 判斷是否有補牌
        if (! is_null($card) && ($card != '')) {
            $card = lcfirst($card);
            $getImage = asset('images/pokercard/' . $card . '.png');

            return "<img src = " . $getImage . "></span >";
        } else {
            return null;
        }
    }

    /**
     * @param $listValue
     * @return string
     */
    public function showVideoDownloadLink($listValue)
    {
        // 回傳影片連結
        $webSite = "http://video.livecasino168.com/" . ucwords($listValue['TableId']) . "/" . $listValue['Round'] . "/" . $listValue['Round'] . "-" . $listValue['Run'] . ".mp4";

        return $webSite;
    }

    /**
     * @param $card
     * @return string
     */
    public function showCardImage($card)
    {
        // 顯示撲克牌圖片
        $card = lcfirst($card);
        $getImage = asset("images/pokercard/$card.png");

        return "<img src=" . $getImage . ">";
    }
}
