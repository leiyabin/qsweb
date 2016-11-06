<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/5
 * Time: 15:14
 */

namespace app\manager;
use app\rpc\AdminRpc;

class AdminManager
{
    public $admin_rpc;

    public function __construct()
    {
        $this->admin_rpc = new AdminRpc();
    }

    public function getList($page)
    {
        return $this->admin_rpc->getList($page);
    }

    public function add($admin)
    {
        return $this->admin_rpc->add($admin);
    }

    public function edit($admin)
    {
        return $this->admin_rpc->edit($admin);
    }

    public function del($id)
    {
        return $this->admin_rpc->del($id);
    }
}