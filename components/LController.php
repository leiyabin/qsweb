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
    protected $page_size = 20;
    protected $is_post;
    protected $user_info;
    private static $auth_controllers = [
        'admin', 'config', 'news', 'index', 'file', 'oversea', 'financial'
    ];
    public $layout = 'admin';


    public function init()
    {
        $getParams = Yii::$app->request->get();
        $postParams = Yii::$app->request->post();
        $this->params = array_merge($getParams, $postParams);
//        $this->params = $this->safeHtml($this->params);
        $this->is_post = Yii::$app->request->isPost;
    }

    public $enableCsrfValidation = false;

    /**
     * ajax错误信息
     *
     * @param $error_msg
     * @param mixed $data
     * @param $redirect
     * @return mixed
     */
    public function error($error_msg = '', $data = [], $redirect = '')
    {
        $this->error_msg .= $error_msg;
        $this->response_status = 0;
        return $this->output($this->error_msg, $data, $redirect);
    }

    /**
     * ajax成功信息
     *
     * @param mixed $msg
     * @param mixed $data
     * @param mixed $redirect
     * @return mixed
     */
    public function success($data = [], $msg = '操作成功！', $redirect = '')
    {
        $this->response_status = 1;
        return $this->output($msg, $data, $redirect);
    }

    public function output($msg = '', $data = [], $redirect = '')
    {
        header("Content-type:application/json;charset=utf-8");
        $res = ['status' => $this->response_status];
        if (!empty($msg)) {
            $res['msg'] = $msg;
        }
        if (!empty($data)) {
            $res['data'] = $data;
        }
        if (!empty($redirect)) {
            $res['redirect'] = $redirect;
        }
        $res_json = json_encode($res, JSON_UNESCAPED_UNICODE);
        $response = sprintf('【RESPONSE】 method: %s url: %s ; params: %s ; result: %s ',
            Yii::$app->request->getMethod(), Yii::$app->request->getUrl(),
            json_encode($this->params, JSON_UNESCAPED_UNICODE), $res_json);
        Yii::info($response, LogConst::RESPONSE);
        $res_json = htmlspecialchars_decode($res_json, ENT_QUOTES);
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

    public function runAction($id, $params = [])
    {
        try {
            return parent::runAction($id, $params);
        } catch (\Exception $e) {
            $error_string = sprintf('【error】 MSG:%s ;TRACE:%s ', $e->getMessage(), $e->getTraceAsString());
            Yii::error($error_string);
            $this->renderError($e->getCode(), $e->getMessage());
        }
    }

    private function renderError($error_code, $error_msg)
    {
        if ($error_code == ErrorCode::NOT_FOUND) {
            $this->redirect('/admin/error/404')->send();
        }
        if ($error_code == ErrorCode::FORBIDDEN) {
            $this->redirect('/admin/auth/login')->send();
        }
        header("Content-type:application/json;charset=utf-8");
        $res = [
            'status' => 0,
            'code'   => $error_code,
            'msg'    => $error_msg
        ];
        $res_json = json_encode($res, JSON_UNESCAPED_UNICODE);
        $response = sprintf('【RESPONSE】 method: %s url: %s ; params: %s ; result: %s ',
            Yii::$app->request->getMethod(), Yii::$app->request->getUrl(),
            json_encode($this->params, JSON_UNESCAPED_UNICODE), $res_json);
        Yii::error($response, LogConst::RESPONSE);
        echo $res_json;
        exit ();
    }

}