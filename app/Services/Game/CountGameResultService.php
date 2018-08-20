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

    private static function card2Point($code)
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

    /**
     * 判斷是否為天牌
     * @param $playerFirstTwoCard
     * @param $bankerFirstTwoCard
     * @return bool
     */
    private function isFirstTwoCardNatural($playerFirstTwoCard, $bankerFirstTwoCard)
    {
        return ($playerFirstTwoCard > 7 || $bankerFirstTwoCard > 7);
    }

    /**
     * 判斷玩家是否需要補牌
     * @param $playerFirstTwoCard
     * @return bool
     */
    private function isPlayerDealNeed($playerFirstTwoCard)
    {
        return $playerFirstTwoCard < 6;
    }

    /**
     * 判斷莊家是否要補牌
     * @param $bankerFirstTwoCard
     * @param $Card5
     * @return bool
     */
    private function isBankerDealNeeded($bankerFirstTwoCard, $Card5)
    {
        if ($bankerFirstTwoCard <= 2) {
            return true;
        }

        $player3 = "";

        if ($Card5 != null) {
            $player3 = $Card5{1};
        }

        if ($bankerFirstTwoCard == 3) {
            return $player3 != "8";
        } elseif ($bankerFirstTwoCard == 4) {
            return ($player3 != "1" &&
                $player3 != "8" &&
                $player3 != "9" &&
                $player3 != "0" &&
                $player3 != "K" &&
                $player3 != "Q" &&
                $player3 != "J");
        } elseif ($bankerFirstTwoCard == 5) {
            return ($player3 != "1" &&
                $player3 != "2" &&
                $player3 != "3" &&
                $player3 != "8" &&
                $player3 != "9" &&
                $player3 != "0" &&
                $player3 != "K" &&
                $player3 != "Q" &&
                $player3 != "J");
        } elseif ($bankerFirstTwoCard == 6) {
            return ($player3 == "6" || $player3 == "7");
        }
        return false;
    }

    /**
     * 判斷牌局前四張牌是否缺牌
     * @param $detailValue
     * @return bool
     */
    private function isFirstFourCardLoss($detailValue)
    {
        return ($detailValue['Card1'] == null
            || $detailValue['Card2'] == null
            || $detailValue['Card3'] == null
            || $detailValue['Card4'] == null) ? true : false;
    }

    /**
     * 判斷牌局是否符合補牌規則
     * @param $detailValue
     * @return bool
     */
    public function isDealCorrect($detailValue)
    {
        if ($this->isFirstFourCardLoss($detailValue)) {
            return false;
        }

        $this->StoreGameResult($detailValue['Card2'], $detailValue['Card4'], $detailValue['Card6'], $detailValue['Card1'], $detailValue['Card3'], $detailValue['Card5']);
        $playerFirstTwoCard = $this->getPlayerFirstTwoCardPoint();
        $bankerFirstTwoCard = $this->getBankerFirstTwoCardPoint();

        if (!$this->isFirstTwoCardNatural($playerFirstTwoCard, $bankerFirstTwoCard)
            && $this->isPlayerDealNeed($playerFirstTwoCard)
            && $detailValue['Card5'] == null
        ) {
            return false; // 1. 該補牌未補牌 // 1.1不為天牌、閒家需補牌、但是未補牌
        } elseif (!$this->isFirstTwoCardNatural($playerFirstTwoCard, $bankerFirstTwoCard)
            && $this->isBankerDealNeeded($bankerFirstTwoCard, $detailValue['Card5'])
            && $detailValue['Card6'] == null
        ) {
            return false; // 1.2不為天牌、莊家需補牌、但是未補牌
        } elseif ($this->isFirstTwoCardNatural($playerFirstTwoCard, $bankerFirstTwoCard)
            && ($detailValue['Card5'] != null || $detailValue['Card6'] != null)
        ) {
            return false; // 2. 不該補牌卻補牌 // 2.1天牌，但是閒家或莊家補牌
        } elseif (!$this->isPlayerDealNeed($playerFirstTwoCard)
            && $detailValue['Card5'] != null
        ) {
            return false; // 2.2閒家不需要補牌，卻補牌
        } elseif (!$this->isBankerDealNeeded($bankerFirstTwoCard, $detailValue['Card5'])
            && $detailValue['Card6'] != null
        ) {
            return false; // 2.3莊家不需要補牌，卻補牌
        }

        return true; // 符合補牌規則名單
    }
}
