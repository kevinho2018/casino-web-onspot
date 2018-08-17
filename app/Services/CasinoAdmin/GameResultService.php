<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/17
 * Time: 下午5:03
 */

namespace App\Services\CasinoAdmin;

use GuzzleHttp\Client;

const GAME_SERVER_HOST_TESTING = "http://192.168.119.72:8881/";

const GAME_SERVER_HOST_STAGE = "http://52.79.50.1:8881/";

const GAME_SERVER_HOST_PRODUCTION = "http://54.65.37.189:8881/";

/**
 * Class GameResultService
 * @package App\Services\CasinoAdmin
 */
class GameResultService
{
    /**
    public function __construct(
        BaccaratRepository $baccaratRepository
    ) {
        $this->baccaratRepository = $baccaratRepository;
    }
     * */

    /**
     * @param $request
     * @return string
     */
    public function putCancel($request)
    {
        // Guzzle 設定
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
        $url = $this->gameServerHostMapping(config('app.env')).config('Api.SignalRServer.PutGameResultModify');

        $responseString = "Message:";

        // Body 內容處理
        $body = array();
        $body['TableName'] = $request->get('cancel-GameSelect');
        $body['TableId'] = $request->get('cancel-TableId');
        $body['Round'] = $request->get('cancel-GameRound');
        $body['Run'] = $request->get('cancel-GameRun');
        $body['ChangeType'] = $request->get('cancel-ModifiedStatus');
        $body['ChangeResult'] = ",,,,,";
        $body['ChangeAnnouncemet'] = $request->get('cancel-Announcement');

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

        return $responseString;
    }

    /**
     * @param $app_env
     * @return mixed
     */
    private function gameServerHostMapping($app_env)
    {
        $dictionary = [
            'testing' => GAME_SERVER_HOST_TESTING,
            'local' => GAME_SERVER_HOST_TESTING,
            'staging' => GAME_SERVER_HOST_STAGE,
            'production' => GAME_SERVER_HOST_PRODUCTION
        ];

        return isset($dictionary[$app_env]) ? $dictionary[$app_env] : GAME_SERVER_HOST_PRODUCTION;
    }
}