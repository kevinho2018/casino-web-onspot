<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/9/28
 * Time: 上午11:15
 */

namespace App\Presenters;

/**
 * Class GameResultModifyPresenter
 * @package App\Presenters
 */
class GameResultModifyPresenter
{
    /**
     * @param $suit
     * @return string
     */
    public function showCards($suit)
    {
        $options = '';
        for ($i=1; $i<13; $i++) {
            switch ($i) {
                case '11':
                    $i = 'J';
                    break;
                case '12':
                    $i = 'Q';
                    break;
                case '13':
                    $i = 'K';
                    break;
                default:
                    break;
            }
            $value = $this->suitWordMapping($suit) . $i;
            dd($value);
            $message = $this->suitMapping($suit) . $i;
            $options = $options . "<option value=$value>" . $message . "</option>";
        }
        return $options;
    }

    /**
     * @param $suit
     * @return mixed
     */
    private function suitMapping($suit)
    {
        $dictionary = [
            'hearts' => '紅心',
            'spades' => '黑桃',
            'diamonds' => '方塊',
            'clubs' => '梅花'
        ];
        return isset($dictionary[$suit]) ? $dictionary[$suit] : $suit;
    }

    /**
     * @param $suit
     * @return mixed
     */
    private function suitWordMapping($suit)
    {
        $dictionary = [
            'hearts' => 'H',
            'spades' => 'S',
            'diamonds' => 'D',
            'clubs' => 'C'
        ];
        return isset($dictionary[$suit]) ? $dictionary[$suit] : $suit;
    }
}