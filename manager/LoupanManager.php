<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/22
 * Time: 22:39
 */

namespace app\manager;

use app\components\Utils;
use app\consts\HouseConst;
use app\rpc\LoupanRpc;

class LoupanManager
{
    public $loupan_rpc;

    public function __construct()
    {
        $this->loupan_rpc = new LoupanRpc();
    }

    public function getList($page_info, $area_id = 0, $name = '', $average_price = 0,
                            $property_type_id = 0, $sale_status = 0, $recommend = 0)
    {
        $list = $this->loupan_rpc->getList($page_info, $area_id, $name, $average_price,
            $property_type_id, $sale_status, $recommend);
        if (isset($list->loupan_list)) {
            foreach ($list->loupan_list as $key => $value) {
                $list->loupan_list[$key]->img_url = Utils::getImgUrl($value->img, '');
                $jiju_arr = explode(',', $value->jiju);
                foreach ($jiju_arr as $key_ => $val) {
                    $jiju_arr[$key_] = $val . '居';
                }
                $list->loupan_list[$key]->jiju = implode('/', $jiju_arr);
                $list->loupan_list[$key]->tag = $this->getTag($value->tag);
            }
        }
        return $list;
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

    public function add($loupan)
    {
        return $this->loupan_rpc->add($loupan);
    }

    public function edit($loupan)
    {
        return $this->loupan_rpc->edit($loupan);
    }

    public function get($id)
    {
        $res = $this->loupan_rpc->getOne($id);
        if (!empty($res->id)) {
            $res->img_url = Utils::getImgUrl($res->img);
            $res->banner_img_url = Utils::getImgUrl($res->banner_img);
            $res->img_1_url = Utils::getImgUrl($res->img_1);
            $res->img_2_url = Utils::getImgUrl($res->img_2);
            $res->img_3_url = Utils::getImgUrl($res->img_3);
            $res->img_4_url = Utils::getImgUrl($res->img_4);
            $res->img_5_url = Utils::getImgUrl($res->img_5);
            $jiju_arr = explode(',', $res->jiju);
            $res->jiju_arr = $jiju_arr;
            $tag_arr = explode(',', $res->tag);
            $res->tag_arr = $tag_arr;
            $res->tag = $this->getTag($res->tag);
            foreach ($res->door_model_list as $key => $door_model) {
                $res->door_model_list[$key]->img_url = Utils::getImgUrl($door_model->img);
                $res->door_model_list[$key]->decoration_name = HouseConst::$decoration[$door_model->decoration];
            }
            return $res;
        }
        return [];
    }

    public function getSimple($id)
    {
        return $this->loupan_rpc->getOne($id);
    }

    public function doorModelList($loupan_id)
    {
        return $this->loupan_rpc->doorModelList($loupan_id);
    }

    public function addDoorModel($door_model)
    {
        return $this->loupan_rpc->doorModelAdd($door_model);
    }

    public function editDoorModel($loupan)
    {
        return $this->loupan_rpc->doorModelEdit($loupan);
    }

    public function getDoorModel($id)
    {
        $res = $this->loupan_rpc->doorModelGet($id);
        if (!empty($res)) {
            $res->img_url = Utils::getImgUrl($res->img);
        }
        return $res;
    }

    public function doorModelBatchDel($id)
    {
        return $this->loupan_rpc->doorModelBatchDel($id);
    }

    public function active($id, $active)
    {
        return $this->loupan_rpc->active($id, $active);
    }
}