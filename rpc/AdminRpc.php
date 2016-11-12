<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/3
 * Time: 22:14
 */

namespace app\rpc;


use app\components\LRpc;

class AdminRpc extends LRpc
{
    public function getList($page)
    {
        $params = [
            'page'     => intval($page),
            'per_page' => 20,
        ];
        return LRpc::init()->post($params)->url('/admin/list');
    }

    public function add($admin)
    {
        $params = $admin;
        return LRpc::init()->post($params)->url('/admin/add');
    }

    public function edit($admin)
    {
        $params = $admin;
        return LRpc::init()->post($params)->url('/admin/edit');
    }

    public function del($id)
    {
        $params = ['id' => $id];
        return LRpc::init()->post($params)->url('/admin/del');
    }

    public function getOne($id)
    {
        $params = ['id' => $id];
        return LRpc::init()->post($params)->url('/admin/get');
    }

    public function setPwd($id, $old_password, $new_password)
    {
        $params = [
            'id'           => $id,
            'old_password' => $old_password,
            'new_password' => $new_password
        ];
        return LRpc::init()->post($params)->url('/admin/setpwd');
    }
}