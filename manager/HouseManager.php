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
                            $property_type_id = 0, $recommend = 0, $order_by = 'c_t', $rs= '', $address= '')
    {
        $list = $this->house_rpc->getList($page_info, $area_id, $price_interval, $build_area,
            $property_type_id, $recommend, $order_by , $rs, $address);
        if (isset($list->house_list)) {
            foreach ($list->house_list as $key => $value) {
                $list->house_list[$key]->tag = $this->getTag($value->tag);
            }
            return $list;
        }
        return [];
    }

    public function get($id)
    {
        $res = $this->house_rpc->get($id);
        if (!empty($res->id)) {
            if (!empty($res->house_attach)) {
                $res->house_attach->deed_year_name = HouseConst::$deed_year[$res->house_attach->deed_year];
                $res->house_attach->build_type_name = HouseConst::$build_type[$res->house_attach->build_type];
                $res->house_attach->community_img_url = Utils::getImgUrl($res->house_attach->community_img);
            }
            $res->tag = $this->getTag($res->tag);
            $res->broker_img_url = Utils::getImgUrl($res->broker_img, '/static/web/images/broker.png');
            return $res;
        }
        return [];
    }

    public function getRecommend($size = 4)
    {
        $list = $this->house_rpc->getRecommend($size);
        if (isset($list->error_code)) {
            return [];
        }
        return $list;
    }

    private function getTag($tags)
    {
        if (empty($tags)) {
            return [];
        }
        $tag_keys = explode(',', $tags);
        $tag_vals = [];
        if (!empty($tag_keys) && is_array($tag_keys)) {
            foreach ($tag_keys as $val) {
                $tag_vals[] = HouseConst::$feature[$val];
            }
        }
        return $tag_vals;
    }
}