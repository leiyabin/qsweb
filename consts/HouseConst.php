<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/22
 * Time: 22:57
 */

namespace app\consts;


class HouseConst
{
    //售价区间
    const PRICE_INTERVAL_1 = 1;
    const PRICE_INTERVAL_2 = 2;
    const PRICE_INTERVAL_3 = 3;
    const PRICE_INTERVAL_4 = 4;
    const PRICE_INTERVAL_5 = 5;
    const PRICE_INTERVAL_6 = 6;
    const PRICE_INTERVAL_7 = 7;
    const PRICE_INTERVAL_8 = 8;
    public static $price_interval = [
        self::PRICE_INTERVAL_1 => '200万以下',
        self::PRICE_INTERVAL_2 => '200万~300万',
        self::PRICE_INTERVAL_3 => '300万~400万',
        self::PRICE_INTERVAL_4 => '400万~500万',
        self::PRICE_INTERVAL_5 => '500万~600万',
        self::PRICE_INTERVAL_6 => '600万~700万',
        self::PRICE_INTERVAL_7 => '700万~800万',
        self::PRICE_INTERVAL_8 => '800万以上'
    ];

    //面积区间
    const AREA_INTERVAL_1 = 1;
    const AREA_INTERVAL_2 = 2;
    const AREA_INTERVAL_3 = 3;
    const AREA_INTERVAL_4 = 4;
    const AREA_INTERVAL_5 = 5;
    const AREA_INTERVAL_6 = 6;
    const AREA_INTERVAL_7 = 7;
    const AREA_INTERVAL_8 = 8;
    public static $area_interval = [
        self::AREA_INTERVAL_1 => '50平以下',
        self::AREA_INTERVAL_2 => '50平~70平',
        self::AREA_INTERVAL_3 => '70平~90平',
        self::AREA_INTERVAL_4 => '90平~110平',
        self::AREA_INTERVAL_5 => '110平~130平',
        self::AREA_INTERVAL_6 => '130平~150平',
        self::AREA_INTERVAL_7 => '150平~200平',
        self::AREA_INTERVAL_8 => '200平以上'
    ];
}