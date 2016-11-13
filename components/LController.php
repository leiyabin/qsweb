<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/10/27
 * Time: 19:03
 */

namespace app\components;

use app\consts\ErrorCode;
use app\consts\LogConst;
use app\exception\RequestException;
use app\manager\AdminManager;
use yii\web\Controller;
use Yii;

class LController extends Controller
{
    protected $params;
    protected $response_status;
    protected $error_msg = '';
    protected $default_page = 1;
    protected $is_post;
    protected $user_info;
    private static $auth_controllers = ['admin', 'config'];
    public $layout = 'admin';


    public function init()
    {
        $getParams = Yii::$app->request->get();
        $postParams = Yii::$app->request->post();
        $this->params = array_merge($getParams, $postParams);
        $this->is_post = Yii::$app->request->isPost;
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
    public function success($msg = '操作成功！', $redirect = '')
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
        $res_json = json_encode($res, JSON_UNESCAPED_UNICODE);
        $response = sprintf('【RESPONSE】 method: %s url: %s ; params: %s ; result: %s ',
            Yii::$app->request->getMethod(), Yii::$app->request->getUrl(),
            json_encode($this->params, JSON_UNESCAPED_UNICODE), $res_json);
        Yii::info($response, LogConst::RESPONSE);
        return $res_json;
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

    protected function getRequestParam($field, $default = null)
    {
        if (empty($this->params[$field])) {
            return $default;
        }
        return $this->params[$field];
    }

    public function beforeAction($action)
    {

        $request = sprintf('【REQUEST】 method: %s url: %s ; params: %s',
            Yii::$app->request->getMethod(), Yii::$app->request->getUrl(), json_encode($this->params, JSON_UNESCAPED_UNICODE));
        Yii::info($request, LogConst::REQUEST);

        $controller_name = end(explode('/', $this->id));
        if (in_array($controller_name, self::$auth_controllers)) {
            $user_info = AdminManager::auth();
            if (empty($user_info)) {
                throw new RequestException('请先登录！', ErrorCode::FORBIDDEN);
            } else {
                $this->user_info = $user_info;
            }
        }
        return parent::beforeAction($action);
    }

}