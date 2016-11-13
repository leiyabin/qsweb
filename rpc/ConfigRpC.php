<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/13
 * Time: 18:33
 */

namespace app\rpc;

use app\components\LRpc;

class ConfigRpC extends LRpc
{
    public function getClassList($page)
    {
        $params = [
            'page'     => intval($page),
            'per_page' => 20,
        ];
        return LRpc::init()->post($params)->url('/config/classlist');
    }

    public function addClass($class)
    {
        $params = $class;
        return LRpc::init()->post($params)->url('/config/classadd');
    }

    public function editClass($class)
    {
        $params = $class;
        return LRpc::init()->post($params)->url('/config/classedit');
    }

    public function getClass($id)
    {
        $params = ['id' => $id];
        return LRpc::init()->post($params)->url('/config/getclass');
    }

    public function getInfoList($page)
    {
        $params = [
            'page'     => intval($page),
            'per_page' => 20,
        ];
        return LRpc::init()->post($params)->url('/config/infolist');
    }

    public function addInfo($info)
    {
        $params = $info;
        return LRpc::init()->post($params)->url('/config/infoadd');
    }

    public function editInfo($info)
    {
        $params = $info;
        return LRpc::init()->post($params)->url('/config/infoedit');
    }

    public function getInfo($id)
    {
        $params = ['id' => $id];
        return LRpc::init()->post($params)->url('/config/getinfo');
    }
}