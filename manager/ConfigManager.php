<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/13
 * Time: 18:33
 */

namespace app\manager;


use app\rpc\ConfigRpC;

class ConfigManager
{
    public $config_rpc;

    public function __construct()
    {
        $this->config_rpc = new ConfigRpC();
    }

    public function getClassList($page)
    {
        return $this->config_rpc->getClassList($page);
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

    public function getInfoList($page)
    {
        return $this->config_rpc->getInfoList($page);
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