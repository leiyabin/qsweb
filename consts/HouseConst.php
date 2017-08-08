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

    //房屋类别
    const HOUSE_TYPE_NEW = 1;
    const HOUSE_TYPE_OLD = 2;

    //装修情况
    const DECORATION_ALL = 0;
    const DECORATION_BLANK = 1;
    const DECORATION_SIMPLE = 2;
    const DECORATION_GENERAL = 3;
    const DECORATION_HARDCOVER = 4;
    const DECORATION_LUXURY = 5;
    public static $decoration = [
        self::DECORATION_ALL       => '不限',
        self::DECORATION_BLANK     => '毛坯',
        self::DECORATION_SIMPLE    => '简装',
        self::DECORATION_GENERAL   => '中装',
        self::DECORATION_HARDCOVER => '精装',
        self::DECORATION_LUXURY    => '豪装',
    ];

    //楼盘销售状态
    const SALE_STATUS_ALL = 0;
    const SALE_STATUS_WAIT = 1;
    const SALE_STATUS_QUEUE = 2;
    const SALE_STATUS_SALING = 3;
    const SALE_STATUS_OVER = 4;
    public static $sale_status = [
        self::SALE_STATUS_ALL    => '不限',
        self::SALE_STATUS_WAIT   => '待售',
        self::SALE_STATUS_QUEUE  => '排卡中',
        self::SALE_STATUS_SALING => '在售',
        self::SALE_STATUS_OVER   => '售罄',
    ];

    //物业类型
    const PROPERTY_TYPE_ALL = 0;
    const PROPERTY_TYPE_HOUSE = 1;
    const PROPERTY_TYPE_SHOP = 2;
    const PROPERTY_TYPE_OFFICE = 3;
    const PROPERTY_TYPE_FACTORY = 5;
    const PROPERTY_TYPE_OTHER = 6;
    public static $property_type = [
        self::PROPERTY_TYPE_ALL     => '不限',
        self::PROPERTY_TYPE_HOUSE   => '住宅',
        self::PROPERTY_TYPE_SHOP    => '商业',
        self::PROPERTY_TYPE_OFFICE  => '写字楼',
        self::PROPERTY_TYPE_FACTORY => '厂房',
        self::PROPERTY_TYPE_OTHER   => '其它',
    ];

    //楼盘特色
    const FEATURE_1_CODE = 1;
    const FEATURE_2_CODE = 2;
    const FEATURE_3_CODE = 3;
    const FEATURE_4_CODE = 4;
    public static $feature = [
        self::FEATURE_1_CODE => ['name' => '精装修', 'color' => 'orange'],
        self::FEATURE_2_CODE => ['name' => '离地铁近', 'color' => 'green'],
        self::FEATURE_3_CODE => ['name' => '车位充足', 'color' => 'blue'],
        self::FEATURE_4_CODE => ['name' => '配套齐全', 'color' => 'yellow']
    ];
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

    //居室情况
    const ROOM_NUM_1 = 1;
    const ROOM_NUM_2 = 2;
    const ROOM_NUM_3 = 3;
    const ROOM_NUM_4 = 4;
    const ROOM_NUM_5 = 5;
    const ROOM_NUM_6 = 6;
    public static $room_num = [
        self::ROOM_NUM_1 => '一居室',
        self::ROOM_NUM_2 => '二居室',
        self::ROOM_NUM_3 => '三居室',
        self::ROOM_NUM_4 => '四居室',
        self::ROOM_NUM_5 => '五居室',
        self::ROOM_NUM_6 => '五居室以上',
    ];

    //付款方式
    const BUY_TYPE_ALL = 1;
    const BUY_TYPE_BUSSINESS_LOAN = 2;
    const BUY_TYPE_FUND_LOAN = 3;

    public static $buy_type = [
        self::BUY_TYPE_ALL            => '全款',
        self::BUY_TYPE_BUSSINESS_LOAN => '商贷',
        self::BUY_TYPE_BUSSINESS_LOAN => '公积金',

    ];

    //房本年限
    const DEED_YEAR_1 = 1;
    const DEED_YEAR_2 = 2;
    const DEED_YEAR_3 = 3;

    public static $deed_year = [
        self::DEED_YEAR_1 => '不满两年',
        self::DEED_YEAR_2 => '满两年',
        self::DEED_YEAR_3 => '满五年',
    ];

    //建筑类型
    const BUILD_TYPE_1 = 1;
    const BUILD_TYPE_2 = 2;
    const BUILD_TYPE_3 = 3;

    public static $build_type = [
        self::BUILD_TYPE_1 => '塔楼',
        self::BUILD_TYPE_2 => '板楼',
        self::BUILD_TYPE_3 => '塔板结合',
    ];

    //经纪人标签
    const BROKER_TYPE_1 = 1;
    const BROKER_TYPE_2 = 2;
    const BROKER_TYPE_3 = 3;
    const BROKER_TYPE_4 = 4;
    const BROKER_TYPE_5 = 5;
    const BROKER_TYPE_6 = 6;

    public static $broker_type = [
        self::BROKER_TYPE_1 => ['name' => '房东信赖', 'color' => 'orange'],
        self::BROKER_TYPE_2 => ['name' => '客户热评', 'color' => 'green'],
        self::BROKER_TYPE_3 => ['name' => '销售达人', 'color' => 'blue'],
        self::BROKER_TYPE_4 => ['name' => '带看活跃', 'color' => 'yellow'],
        self::BROKER_TYPE_5 => ['name' => '法律顾问', 'color' => 'orange'],
        self::BROKER_TYPE_6 => ['name' => '海外顾问', 'color' => 'green']
    ];

    //房型
    const ROOM_TYPE_1 = 1;
    const ROOM_TYPE_2 = 2;
    const ROOM_TYPE_3 = 3;
    const ROOM_TYPE_4 = 4;
    const ROOM_TYPE_5 = 5;
    const ROOM_TYPE_6 = 6;

    public static $room_type = [
        self::ROOM_TYPE_1 => '1室',
        self::ROOM_TYPE_2 => '2室',
        self::ROOM_TYPE_3 => '3室',
        self::ROOM_TYPE_4 => '4室',
        self::ROOM_TYPE_5 => '5室',
        self::ROOM_TYPE_6 => '5室以上',

    ];
}