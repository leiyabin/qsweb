<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/13
 * Time: 18:33
 */

namespace app\rpc;

use app\components\LRpc;

class ConfigRpc extends LRpc
{
    public function getClassList($page = 1, $per_page = 20)
    {
        $params = [
            'page'     => intval($page),
            'per_page' => intval($per_page),
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

    public function getInfoList($page_info, $class_id = 0, $value = '')
    {
        $params = [
            'page'     => intval($page_info['page']),
            'per_page' => intval($page_info['pre_page']),
            'class_id' => $class_id,
            'value'    => $value
        ];
        return LRpc::init()->post($params)->url('/config/valuelist');
    }

    public function addInfo($info)
    {
        $params = $info;
        return LRpc::init()->post($params)->url('/config/valueadd');
    }

    public function editInfo($info)
    {
        $params = $info;
        return LRpc::init()->post($params)->url('/config/valueedit');
    }

    public function getInfo($id)
    {
        $params = ['id' => $id];
        return LRpc::init()->post($params)->url('/config/getvalue');
    }
}