<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/20
 * Time: 14:27
 */

namespace app\manager;


use app\rpc\AreaRpc;

class AreaManager
{
    public $area_rpc;

    public function __construct()
    {
        $this->area_rpc = new AreaRpc();
    }

    public function getList($page_info, $class_id = 0, $name = '')
    {
        return $this->area_rpc->getList($page_info, $class_id, $name);
    }

    public function add($area)
    {
        return $this->area_rpc->add($area);
    }

    public function edit($area)
    {
        return $this->area_rpc->edit($area);
    }

    public function get($id)
    {
        return $this->area_rpc->getOne($id);
    }

    public function batchDel($ids)
    {
        return $this->area_rpc->batchDel($ids);
    }


    public function getByClassId($class_id)
    {
        return $this->area_rpc->getByClassId($class_id);
    }
}