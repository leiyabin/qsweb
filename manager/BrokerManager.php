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

class BrokerManager
{
    public $broker_rpc;

    public function __construct()
    {
        $this->broker_rpc = new BrokerRpc();
    }

    public function getList($page_info, $position_id = 0, $name = '')
    {
        return $this->broker_rpc->getList($page_info, $position_id, $name);
    }

    public function add($broker)
    {
        return $this->broker_rpc->add($broker);
    }

    public function edit($broker)
    {
        return $this->broker_rpc->edit($broker);
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
}