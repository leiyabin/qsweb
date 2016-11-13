<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/5
 * Time: 15:14
 */

namespace app\manager;

use app\rpc\AdminRpc;
use Yii;
use app\components\LSession;

class AdminManager
{
    const ADMIN_INFO_SESSION = 'admin_info';
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

    public function batchDel($ids)
    {
        return $this->admin_rpc->batchDel($ids);
    }

    public function get($id)
    {
        return $this->admin_rpc->getOne($id);
    }

    public function setPwd($id, $old_password, $new_password)
    {
        return $this->admin_rpc->setPwd($id, $old_password, $new_password);
    }

    public function login($username, $password)
    {
        $res = $this->admin_rpc->login($username, $password);
        if (!isset($res->code)) {
            LSession::set(self::ADMIN_INFO_SESSION, $res, 'QS_ADMIN_SESSION');
        }
        return $res;
    }

    public static function auth()
    {
        return LSession::get(self::ADMIN_INFO_SESSION, 'QS_ADMIN_SESSION');
    }

    public static function destroy()
    {
        return LSession::destroy(self::ADMIN_INFO_SESSION, 'QS_ADMIN_SESSION');
    }
}