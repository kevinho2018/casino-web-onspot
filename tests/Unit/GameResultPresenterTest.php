<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/9/17
 * Time: 下午4:22
 */

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Presenters\GameResultPresenter;

class GameResultPresenterTest extends TestCase
{
    use WithoutMiddleware;

    /** @test */
    public function showCard5Card6Test()
    {
        // 有補牌
        $card = 's5';
        $getImage = asset('images/pokercard/' . $card . '.png');
        $test = new GameResultPresenter();

        $response = $test->showCard5Card6($card);

        $this->assertEquals("<img src = " . $getImage . "></span >", $response);

        // 沒補牌
        $card = '';
        $response = $test->showCard5Card6($card);

        $this->assertEquals(null, $response);
    }

    /** @test */
    public function showVideoDownloadLinkTest()
    {
        $listValue = [
            'TableId' => 'A',
            'Round' => '123',
            'Run' => '23'
        ];

        $test = new GameResultPresenter();
        $response = $test->showVideoDownloadLink($listValue);
        $expected = "http://video.livecasino168.com/" . ucwords($listValue['TableId']) . "/" . $listValue['Round'] . "/" . $listValue['Round'] . "-" . $listValue['Run'] . ".mp4";
        $this->assertEquals($expected, $response);
    }
}
