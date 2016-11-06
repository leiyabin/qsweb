<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/10/27
 * Time: 19:03
 */

namespace app\components;

use yii\web\Controller;
use Yii;

class LController extends Controller
{
    protected $params;
    protected $response_status;
    protected $error_msg = '';
    protected $default_page = 1;
    public $layout = 'admin';

    public function init()
    {
        $getParams = Yii::$app->request->get();
        $postParams = Yii::$app->request->post();
        $this->params = array_merge($getParams, $postParams);
    }

    public $enableCsrfValidation = false;

    /**
     * ajax错误信息
     *
     * @param $error_msg
     * @param $redirect
     * @return mixed
     */
    public function error($error_msg = '', $redirect = '')
    {
        $this->error_msg .= $error_msg;
        $this->response_status = 0;
        return $this->output($this->error_msg, $redirect);
    }

    /**
     * ajax成功信息
     *
     * @param mixed $msg
     * @param mixed $redirect
     * @return mixed
     */
    public function success($msg = '', $redirect = '')
    {
        $this->response_status = 1;
        return $this->output($msg, $redirect);
    }

    public function output($msg = '', $redirect = '')
    {
        header("Content-type:application/json;charset=utf-8");
        $res = ['status' => $this->response_status];
        if (!empty($msg)) {
            $res['msg'] = $msg;
        }
        if (!empty($redirect)) {
            $res['redirect'] = $redirect;
        }
        return json_encode($res, JSON_UNESCAPED_UNICODE);
    }

    protected function hasError($res)
    {
        if (isset($res->code)) {
            $this->error_msg .= $res->msg;
            return true;
        } else {
            return false;
        }
    }

}