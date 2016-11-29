<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/10/27
 * Time: 17:50
 */

namespace app\components;

use app\consts\ErrorCode;
use app\consts\LogConst;
use Yii;
use yii\web\HttpException;
use yii\web\ErrorAction;
use yii\base\UserException;

class LErrorAction extends ErrorAction
{
    public function run()
    {
        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            // action has been invoked not from error handler, but by direct route, so we display '404 Not Found'
            $exception = new HttpException(404, Yii::t('yii', 'Page not found.'));
        }
        if ($exception instanceof HttpException) {
            $code = $exception->statusCode;
        } else {
            $code = $exception->getCode();
        }
        if ($code == ErrorCode::NOT_FOUND) {
            return \Yii::$app->view->renderFile('@app/views/web/error/404.php');
        }
        if ($exception instanceof UserException) {
            $message = $exception->getMessage();
        } else {
            $message = $this->defaultMessage ?: Yii::t('yii', 'An internal server error occurred.');
        }
        header("Content-type:application/json;charset=utf-8");
        $res = [
            'status' => 0,
            'code'   => $code,
            'msg'    => $message
        ];
        $res_json = json_encode($res, JSON_UNESCAPED_UNICODE);
        $response = sprintf('【RESPONSE】 method: %s url: %s ; params: %s ; result: %s ',
            Yii::$app->request->getMethod(), Yii::$app->request->getUrl(),
            json_encode($this->params, JSON_UNESCAPED_UNICODE), $res_json);
        Yii::info($response, LogConst::RESPONSE);
        return $res_json;
    }
}