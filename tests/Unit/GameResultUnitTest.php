<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/9/11
 * Time: 下午5:49
 */

namespace Tests\Unit;

use App\Http\Controllers\VoyagerAuthController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class GameResultUnitTest
 * @package Tests\TestCase
 */
class GameResultUnitTest extends TestCase
{
    use WithoutMiddleware;

    /** @test */
    public function it_can_search_for_gameResult()
    {
        // 1~3 查詢牌局紀錄API
        $this->get('/casino-api/baccarat/game/historySearch?startAt=1900-03-11 00:00:00&endAt=2018-10-10 00:00:00&modifiedStatus=normal')
            ->assertJsonFragment([
                'status' => 'Success',
                'modifiedStatus' => 'normal'
            ])
            ->assertStatus(200);

        // 4~6 查詢影片API
        $this->get('/casino-api/baccarat/video/videoSearch?tableId=E&round=9997185&run=45')
            ->assertJsonFragment([
                'status' => 'Failed',
                'message' => 'Video not exist'
            ])
            ->assertStatus(200);

        // 7 確定登入頁面正常回應
        $this->get('/admin/login')
            ->assertStatus(200);

        // 8 嘗試登入 Error：Session store not set on request
        $request = ['name' => 'kevinho', 'password' => 'ifalo'];
        $this->post('/admin/login', $request)
            ->assertStatus(500);

        // 9 遊戲牌局改單取消頁面
        $this->get('/admin/baccaratHistory-page')
            ->assertStatus(200);

        // 10 Call Game Server 取消牌局耶果
        $prepareData = [
            'cancel-GameSelect' => 'Baccarat',
            'cancel-TableId' => 'A',
            'cancel-GameRound' => '123',
            'cancel-GameRun' => '21',
            'cancel-ModifiedStatus' => 'Canceled'
        ];

        $this->put('/admin/cancel-game-result', $prepareData)
            ->assertStatus(302);

        // 11 Call Game Server 修改牌局結果
        $prepareData = [
            'modify-GameSelect' => 'Baccarat',
            'modify-TableId' => 'A',
            'modify-GameRound' => '123',
            'modify-GameRun' => '21',
            'modify-ModifiedStatus' => 'Modified',
            'player-card-1' => 'SQ',
            'banker-card-1' => 'SK',
            'player-card-2' => 'S0',
            'banker-card-2' => 'S8',
            'player-card-3' => 'S9',
            'banker-card-3' => 'S7',
        ];

        $this->put('/admin/modify-game-result', $prepareData)
            ->assertStatus(302);

        // 12 查詢遊戲牌局頁面
        $response = $this->get('/admin/search-game-result-page');
        $response->assertStatus(200);

        // 13 查詢遊戲牌局

        $temp13 = $this->get('/admin/search-game-result');
        $temp13->assertStatus(200);
    }
}
