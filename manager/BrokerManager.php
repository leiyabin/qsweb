<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/20
 * Time: 15:56
 */

namespace app\manager;

use app\components\Utils;
use app\rpc\BrokerRpc;
use app\consts\HouseConst;

class BrokerManager
{
    public $broker_rpc;

    public function __construct()
    {
        $this->broker_rpc = new BrokerRpc();
    }

    public function getList($page_info, $position_id = 0, $name = '', $broker_type_interval = [])
    {
        $list = $this->broker_rpc->getList($page_info, $position_id, $name, $broker_type_interval);
        if (isset($list->broker_list)) {
            foreach ($list->broker_list as $key => $broker) {
                $list->broker_list[$key]->tag = $this->getTag($broker->tag);
                $list->broker_list[$key]->img_url = Utils::getImgUrl($broker->img, '/static/web/images/default_man.jpg');
            }
        }
        return $list;
    }


    public function get($id)
    {
        $res = $this->broker_rpc->getOne($id);
        if (!empty($res)) {
            $res->img_url = Utils::getImgUrl($res->img);
        }
        return $res;
    }

    public function batchDel($ids)
    {
        return $this->broker_rpc->batchDel($ids);
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
                $tag_vals[] = HouseConst::$broker_type[$val];
            }
        }
        return $tag_vals;
    }
}