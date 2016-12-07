<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/10/27
 * Time: 16:55
 */

namespace app\components;

use app\consts\ErrorCode;
use app\consts\MsgConst;
use app\exception\RequestException;
use app\exception\RpcException;
use Yii;

class LRpc
{

    private $custom = array();
    private $option = array(
        'CURLOPT_HEADER'         => 0,
        'CURLOPT_TIMEOUT'        => 5,
        'CURLOPT_ENCODING'       => '',
        'CURLOPT_IPRESOLVE'      => 1,
        'CURLOPT_RETURNTRANSFER' => true,
        'CURLOPT_SSL_VERIFYPEER' => false,
        'CURLOPT_CONNECTTIMEOUT' => 3,
        'CURLOPT_POST'           => true,
    );
    private $post;
    private $info;
    private $data;
    private $http_code;
    private $has_error;
    private $error_message;
    private $result;
    private $url;

    private static $instance;

    /**
     * Instance
     * @return LRpc
     */
    public static function init()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Set POST data
     * @param array|string $data
     * @param null|string $value
     * @return self
     */
    public function post($data = [], $value = null)
    {
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                $this->post[$key] = $val;
            }
        } else {
            if ($value === null) {
                $this->post = $data;
            } else {
                $this->post[$data] = $value;
            }
        }
        return $this;
    }

    /**
     * File upload
     * @param string $field
     * @param string $path
     * @param string $type
     * @param string $name
     * @return self
     */
    public function file($field, $path, $type, $name)
    {
        $name = basename($name);
        if (class_exists('CURLFile')) {
            $this->setOption('CURLOPT_SAFE_UPLOAD', true);
            $file = curl_file_create($path, $type, $name);
        } else {
            $file = "@{$path};type={$type};filename={$name}";
        }
        return $this->post($field, $file);
    }

    /**
     * Save file
     * @param string $path
     * @return self
     */
    public function save($path)
    {
        if (!$this->has_error) {
            $fp = @fopen($path, 'w');
            if ($fp === false) {
                $this->has_error = true;
                $this->error_message = "The path {$path} is not writable.";
            } else {
                fwrite($fp, $this->data);
                fclose($fp);
            }
        }
        return $this;
    }

    /**
     * Request URL
     * @param string $url
     * @return self
     */
    public function url($url)
    {
        $this->url = RPC_URL . $url;
        return $this->setOption('CURLOPT_URL', $this->url)->process();
    }

    /**
     * Set option
     * @param array|string $item
     * @param null|string $value
     * @return self
     */
    public function setOption($item, $value = null)
    {
        if (is_array($item)) {
            foreach ($item as $key => $val) {
                $this->custom[$key] = $val;
            }
        } else {
            $this->custom[$item] = $value;
        }
        return $this;
    }

    /**
     * Task process
     * @param int $retry
     * @return self
     */
    private function process()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers = array(
            'Content-Type:application/json;charset=UTF-8',
            'User-Agent:' . USER_AGENT
        ));
        if ($this->post) {
            $this->setOption('CURLOPT_POST', true);
            $this->setOption('CURLOPT_POSTFIELDS', json_encode($this->post, JSON_UNESCAPED_UNICODE));
        }
        $option = array_merge($this->option, $this->custom);
        foreach ($option as $key => $val) {
            if (is_string($key)) {
                $key = constant(strtoupper($key));
            }
            curl_setopt($ch, $key, $val);
        }
        Yii::info(sprintf('RPC_REQUEST: 【url】| %s ; 【params】| %s ', $this->url, json_encode($this->post, JSON_UNESCAPED_UNICODE)));
        $this->data = (string)curl_exec($ch);
        $this->info = curl_getinfo($ch);
        $this->http_code = $this->info['http_code'];
        $this->has_error = curl_errno($ch) > 0;
        $this->error_message = curl_error($ch);

        curl_close($ch);

        $this->processResult();

        $this->post = array();
        Yii::info(sprintf('RPC_RESPONSE: 【result】 | %s ', json_encode($this->result, JSON_UNESCAPED_UNICODE)));
        return $this->result;
    }

    /**
     * Build array
     * @param array $input
     * @param string $pre
     * @return array
     */
    private function build_array($input, $pre = null)
    {
        if (is_array($input)) {
            $output = array();
            foreach ($input as $key => $value) {
                $index = is_null($pre) ? $key : "{$pre}[{$key}]";
                if (is_array($value)) {
                    $output = array_merge($output, $this->build_array($value, $index));
                } else {
                    $output[$index] = $value;
                }
            }
            return $output;
        }
        return $input;
    }

    private function processResult()
    {
        if ($this->http_code != ErrorCode::SUCCESS) {
            $http_error = sprintf('http错误 ：http_code | %d ；error_msg | %s ; info | %s ',
                $this->http_code, $this->error_message, json_encode($this->info, JSON_UNESCAPED_UNICODE));
            $this->rpcError($http_error);
        } elseif ($this->has_error) {
            $this->rpcError($this->error_message);
        } else {
            $res = json_decode($this->data);
            if ($res->ret == 0 && $res->data->error_code < ErrorCode::ACTION_ERROR) {
                $this->rpcError($res->data->msg);
            } else {
                $this->result = $res->data;
            }
        }
    }

    private function rpcError($msg)
    {
        $error_msg = sprintf('【RPC_ERR】: msg | %s ; url | %s ; params | %s ',
            $msg, $this->url, json_encode($this->post, JSON_UNESCAPED_UNICODE));
        Yii::error($error_msg);
        $result = new \stdClass();
        $result->error_code = ErrorCode::SYSTEM_ERROR;
        $result->msg = MsgConst::FAILED_MSG;
        $this->result = $result;
    }
}
