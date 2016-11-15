<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/13
 * Time: 18:33
 */

namespace app\manager;


use app\rpc\ConfigRpc;

class ConfigManager
{
    public $config_rpc;

    public function __construct()
    {
        $this->config_rpc = new ConfigRpc();
    }

    public function getClassList($page = 1, $pre_page = 20)
    {
        return $this->config_rpc->getClassList($page, $pre_page);
    }

    public function addClass($class)
    {
        return $this->config_rpc->addClass($class);
    }

    public function editClass($class)
    {
        return $this->config_rpc->editClass($class);
    }

    public function getClass($id)
    {
        return $this->config_rpc->getClass($id);
    }

    public function getInfoList($page = 1, $per_page = 20)
    {
        return $this->config_rpc->getInfoList($page, $per_page);
    }

    public function addInfo($info)
    {
        return $this->config_rpc->addInfo($info);
    }

    public function editInfo($info)
    {
        return $this->config_rpc->editInfo($info);
    }

    public function getInfo($id)
    {
        return $this->config_rpc->getInfo($id);
    }
}