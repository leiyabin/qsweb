<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/12/4
 * Time: 17:12
 */

namespace app\manager;

use app\components\Utils;
use app\consts\HouseConst;
use app\rpc\HouseRpc;


class HouseManager
{
    public $house_rpc;

    public function __construct()
    {
        $this->house_rpc = new HouseRpc();
    }

    public function getList($page_info, $area_id = 0, $price_interval = [], $build_area = [],
                            $property_type_id = 0, $recommend = 0, $order_by)
    {
        $list = $this->house_rpc->getList($page_info, $area_id, $price_interval, $build_area,
            $property_type_id, $recommend,$order_by);
        if (isset($list->house_list)) {
            return $list;
        }
        return [];
    }

    private function getTag($tags)
    {
        $tag_keys = explode(',', $tags);
        $tag_vals = [];
        foreach ($tag_keys as $val) {
            $tag_vals[] = HouseConst::$feature[$val];
        }
        return $tag_vals;
    }

    public function get($id)
    {
        $res = $this->house_rpc->get($id);
        if (!empty($res->id)) {
            return $res;
        }
        return [];
    }
}