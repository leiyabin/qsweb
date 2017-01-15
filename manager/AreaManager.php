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

    public function getList($page_info, $class_id = 0, $name = '', $is_trip_area = false)
    {
        return $this->area_rpc->getList($page_info, $class_id, $name, $is_trip_area);
    }

}