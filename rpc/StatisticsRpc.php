<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/12/7
 * Time: 8:37
 */

namespace app\rpc;
use app\components\LRpc;

class StatisticsRpc extends LRpc
{
    public function get()
    {
        return LRpc::init()->post()->url('/reptile/get');
    }
}