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
        $res = $this->introduction_rpc->get($id);
        if (!empty($res->id)) {
            $res->img_url = Utils::getImgUrl($res->img);
            return $res;
        }
        return [];
    }

    public function getList($page_info, $class_id = 0)
    {
        $list = $this->introduction_rpc->getList($page_info, $class_id);
        if (!empty($list)) {
            foreach ($list->introduction_list as $key => $broker) {
                $list->introduction_list[$key]->img_url = Utils::getImgUrl($broker->img, '/static/web/images/default_house.jpg');
            }
        }
        return $list;
    }


}