<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/19
 * Time: 23:23
 */

namespace app\manager;

use app\components\Utils;
use app\rpc\IntroductionRpc;

class IntroductionManager
{
    public $introduction_rpc;

    public function __construct()
    {
        $this->introduction_rpc = new IntroductionRpc();
    }

    public function get($id)
    {
        return $this->introduction_rpc->get($id);
    }

    public function getList($page_info, $class_id = 0)
    {
        return $this->introduction_rpc->getList($page_info, $class_id);
    }

    public function add($introduction)
    {
        $content = $introduction['content'];
        $introduction['summary'] = Utils::getSummary($content, 150);
        return $this->introduction_rpc->add($introduction);
    }

    public function edit($introduction)
    {
        $content = $introduction['content'];
        $introduction['summary'] = Utils::getSummary($content, 150);
        $introduction['content'] = Utils::safeHtml($content);
        return $this->introduction_rpc->edit($introduction);
    }

    public function batchDel($ids)
    {
        return $this->introduction_rpc->batchDel($ids);
    }


}