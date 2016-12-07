<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/12/7
 * Time: 9:12
 */

namespace app\manager;

use app\rpc\StatisticsRpc;

class StatisticsManager
{
    public $statistics_rpc;

    public function __construct()
    {
        $this->statistics_rpc = new StatisticsRpc();
    }

    public function get()
    {
        $res = $this->statistics_rpc->get();
        if (!empty($res->statistics)) {
            return $res->statistics;
        }
        return [];
    }
}