<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/20
 * Time: 下午2:47
 */

namespace App\Services\Game;

/**
 * Class BaccaratGameRuleService
 * @package App\Services\Game
 */
class BaccaratGameRuleService
{
    /**
     * 遊戲種類：標準、西洋、免水
     */
    const TYPE_STANDARD = 1;
    const TYPE_WESTERN = 2;
    const TYPE_NO_REFUND = 3;

    /**
     * 遊戲種類中文：標準、西洋、免水
     */
    const TYPE_STANDARD_CHINESE = '標準';
    const TYPE_STANDARD_ENGLISH = 'Standard';

    const TYPE_WESTERN_CHINESE = '西洋';
    const TYPE_WESTERN_ENGLISH = 'Western';

    const TYPE_NO_REFUND_CHINESE = '免水';
    const TYPE_NO_REFUND_ENGLISH = 'NoRefund';

    protected $typeEnglishToChineseArray = [
        self::TYPE_STANDARD_ENGLISH => self::TYPE_STANDARD_CHINESE,
        self::TYPE_WESTERN_ENGLISH => self::TYPE_WESTERN_CHINESE,
        self::TYPE_NO_REFUND_ENGLISH => self::TYPE_NO_REFUND_CHINESE
    ];

    protected $typeCodeToChineseArray = [
        self::TYPE_STANDARD => self::TYPE_STANDARD_CHINESE,
        self::TYPE_WESTERN => self::TYPE_WESTERN_CHINESE,
        self::TYPE_NO_REFUND => self::TYPE_NO_REFUND_CHINESE
    ];

    /**
     * @var array
     */
    public static $POKER_LIST = [
        'S1', 'S2', 'S3', 'S4', 'S5', 'S6', 'S7', 'S8', 'S9', 'S0', 'SJ', 'SQ', 'SK',
        'H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9', 'H0', 'HJ', 'HQ', 'HK',
        'D1', 'D2', 'D3', 'D4', 'D5', 'D6', 'D7', 'D8', 'D9', 'D0', 'DJ', 'DQ', 'DK',
        'C1', 'C2', 'C3', 'C4', 'C5', 'C6', 'C7', 'C8', 'C9', 'C0', 'CJ', 'CQ', 'CK',
    ];

    public function typeEnglishToChinese($type)
    {
        return $this->typeEnglishToChineseArray[$type];
    }

    public function typeCodeToChinese($typecode)
    {
        return $this->typeCodeToChineseArray[$typecode];
    }
}