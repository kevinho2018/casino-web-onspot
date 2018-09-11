<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/20
 * Time: 下午2:46
 */

namespace App\Services\Game;


/**
 * Class CountGameResultService
 * @package App\Services\Game
 */
class CountGameResultService
{
    protected $result;

    public function StoreGameResult($banker1, $banker2, $banker3, $player1, $player2, $player3)
    {
        $this->result = [];
        $this->result['player'] = 0;
        $this->result['banker'] = 0;
        $this->result['playerFirstTwoCard'] = 0;
        $this->result['bankerFirstTwoCard'] = 0;

        // 閒莊閒莊
        $this->result['player'] += self::card2Point($player1);
        $this->result['banker'] += self::card2Point($banker1);
        $this->result['player'] += self::card2Point($player2);
        $this->result['banker'] += self::card2Point($banker2);

        // 閒莊前兩張點數合
        $this->result['playerFirstTwoCard'] = ($this->result['player'] %= 10);
        $this->result['bankerFirstTwoCard'] = ($this->result['banker'] %= 10);

        if ($player3 != null) {
            $this->result['player'] += self::card2Point($player3);
        }
        if ($banker3 != null) {
            $this->result['banker'] += self::card2Point($banker3);
        }

        $this->result['player'] %= 10;
        $this->result['banker'] %= 10;
    }

    /**
     * @param array $code
     * @return int
     */
    private static function card2Point(array $code)
    {
        if (!in_array($code, BaccaratGameRuleService::$POKER_LIST, true)) {
            return 0;
        }

        switch ($code{1}) {
            case '1':
            case '2':
            case '3':
            case '4':
            case '5':
            case '6':
            case '7':
            case '8':
            case '9':
                return (int) $code{1};
            case '0':
            case 'J':
            case 'Q':
            case 'K':
                return 0;
        }
    }

    /**
     * @return string
     */
    public function getWinnerResult()
    {
        if ($this->result['banker'] > $this->result['player']) {
            return 'Banker';
        } elseif ($this->result['banker'] == $this->result['player']) {
            return 'Tie';
        } else {
            return 'Player';
        }
    }

    public function getGameResultChinese()
    {
        return sprintf("閒家%d點 - 莊家%d點", $this->result['player'], $this->result['banker']);
    }

    public function getCalculateGameResult()
    {
        return $this->result;
    }

    public function getBankerPoint()
    {
        return $this->result['banker'];
    }

    public function getPlayerPoint()
    {
        return $this->result['player'];
    }

    public function getBankerFirstTwoCardPoint()
    {
        return $this->result['bankerFirstTwoCard'];
    }

    public function getPlayerFirstTwoCardPoint()
    {
        return $this->result['playerFirstTwoCard'];
    }
}
