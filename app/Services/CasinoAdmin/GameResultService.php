<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/17
 * Time: 下午5:03
 */

namespace App\Services\CasinoAdmin;

use App\Http\Requests\GameResultCancelRequest;
use App\Http\Requests\GameResultModifyRequest;
use GuzzleHttp\Client;
use App\Repositories\BaccaratRepository;
use App\Services\Game\CountGameResultService;

const GAME_SERVER_HOST_TESTING = 'http://192.168.119.72:8881/';

const GAME_SERVER_HOST_STAGE = 'http://52.79.50.1:8881/';

const GAME_SERVER_HOST_PRODUCTION = 'http://54.65.37.189:8881/';

/**
 * Class GameResultService
 * @property BaccaratRepository baccaratRepository
 * @property CountGameResultService countGameResultService
 * @package App\Services\CasinoAdmin
 */
class GameResultService
{
    /**
     * GameResultService constructor.
     * @param BaccaratRepository $baccaratRepository
     * @param CountGameResultService $countGameResultService
     */
    public function __construct(
        BaccaratRepository $baccaratRepository,
        CountGameResultService $countGameResultService
    ) {
        $this->baccaratRepository = $baccaratRepository;
        $this->countGameResultService = $countGameResultService;
    }

    /**
     * @param GameResultModifyRequest $request
     */
    public function modifyBaccaratHistory(GameResultModifyRequest $request)
    {
        // Count who is Winner
        // $this->countGameResultService->StoreGameResult($request->get('player-card-1'), $request->get('banker-card-1'), $request->get('player-card-2'), $request->get('banker-card-2'), $request->get('player-card-3'), $request->get('banker-card-3'));
        // $WinSpot = $this->countGameResultService->getWinnerResult();

        $this->baccaratRepository->modifyBaccaratHistory($request);
    }

    /**
     * @param GameResultCancelRequest $request
     */
    public function cancelBaccaratHistory(GameResultCancelRequest $request)
    {
        $this->baccaratRepository->cancelBaccaratHistory($request);
    }

    /**
     * @param $body
     * @return string
     */
    public function putGameModify(array $body)
    {
        // Guzzle 設定
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
        $url = $this->gameServerHostMapping(config('app.env')).config('Api.SignalRServer.PutGameResultModify');

        $responseString = 'Message:';

        // 產生 GuzzleHttp Client
        $client = new Client([
            'headers' => $headers
        ]);

        $guzzleResponse = $client->request(
            'PUT',
            $url,
            ['body' => json_encode($body)]
        );

        // 回應格式處理
        $responseString = $responseString . $guzzleResponse->getBody()->getContents();
        $responseArray = [
            'StatusCode' => $guzzleResponse->getStatusCode(),
            'body' => $guzzleResponse->getBody(),
            'content' => $guzzleResponse->getBody()->getContents()
        ];

        return $responseString;
    }

    /**
     * @param GameResultCancelRequest $request
     * @return string
     */
    public function putCancel(GameResultCancelRequest $request)
    {
        // Body 內容處理
        $body = array();
        $body['TableName'] = $request->get('cancel-GameSelect');
        $body['TableId'] = $request->get('cancel-TableId');
        $body['Round'] = $request->get('cancel-GameRound');
        $body['Run'] = $request->get('cancel-GameRun');
        $body['ChangeType'] = $request->get('cancel-ModifiedStatus');
        $body['ChangeResult'] = ',,,,,';
        $body['ChangeAnnouncemet'] = '[取消公告] 百家樂' . $request->get('cancel-GameRound') . '輪' . $request->get('cancel-GameRun') . '，因結果錯誤已取消，請會員至歷史帳務查看，謝謝。';

        return $this->putGameModify($body);
    }

    /**
     * @param GameResultModifyRequest $request
     * @return string
     */
    public function putModify(GameResultModifyRequest $request)
    {
        // Body 內容處理
        $body = array();
        $body['TableName'] = $request->get('modify-GameSelect');
        $body['TableId'] = $request->get('modify-TableId');
        $body['Round'] = $request->get('modify-GameRound');
        $body['Run'] = $request->get('modify-GameRun');
        $body['ChangeType'] = $request->get('modify-ModifiedStatus');
        $body['ChangeResult'] = $request->get('player-card-1') . ',' .
            $request->get('banker-card-1') . ',' .
            $request->get('player-card-2') . ',' .
            $request->get('banker-card-2') . ',' .
            $request->get('player-card-3') . ',' .
            $request->get('banker-card-3') . ',';
        $body['ChangeAnnouncemet'] = '[改單公告] 百家樂' . $request->get('modify-GameRound') . '輪' . $request->get('modify-GameRun') .'局結果錯誤已重新修正，請會員至歷史帳務查看，謝謝。';

        return $this->putGameModify($body);
    }

    /**
     * @param $app_env
     * @return mixed
     */
    private function gameServerHostMapping($app_env)
    {
        $dictionary = [
            'testing' => GAME_SERVER_HOST_STAGE,
            //'testing' => GAME_SERVER_HOST_TESTING,
            'local' => GAME_SERVER_HOST_TESTING,
            'staging' => GAME_SERVER_HOST_STAGE,
            'production' => GAME_SERVER_HOST_PRODUCTION
        ];

        return isset($dictionary[$app_env]) ? $dictionary[$app_env] : GAME_SERVER_HOST_PRODUCTION;
    }
}