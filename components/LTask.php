<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/12/18
 * Time: 21:35
 */

namespace app\components;


class LTask
{
    public static $task_list = [];

    public static function add(array $callback, array $params)
    {
        self::$task_list[] = ['callback' => $callback, 'params' => $params];
    }

    //todo 撤销任务
    public static function revoke($task_id)
    {
        if (isset(self::$task_list[$task_id])) {
            unset(self::$task_list[$task_id]);
        }
    }

    public static function run()
    {
        fastcgi_finish_request();
        if (!empty(self::$task_list)) {
            foreach (self::$task_list as $task) {
                try {
                    call_user_func_array($task['callback'], $task['params']);
                } catch (\Exception $e) {
                    $info = sprintf(' [function]: %s [params]: %s [error]: %s', json_encode($task['callback'], JSON_UNESCAPED_UNICODE),
                        json_encode($task['params'], JSON_UNESCAPED_UNICODE), $e->getMessage());
                    log($info);
                }
            }
        }
    }

    public function log($info)
    {
        $log_str = sprintf('%s [task_error] : %s ', date('Y-m-d H:i:s'), $info);
        file_put_contents(SYSTEM_LOG_PATH . '/task.error.log', $log_str . PHP_EOL, FILE_APPEND);
    }
}