<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/10/27
 * Time: 16:55
 */

namespace app\components;

use app\consts\ErrorCode;
use app\exception\RequestException;
use app\exception\RpcException;
use Yii;

class LRpc
{
    private $post;
    private $retry = 0;
    private $custom = array();
    private $option = array(
        'CURLOPT_HEADER' => 0,
        'CURLOPT_TIMEOUT' => 30,
        'CURLOPT_ENCODING' => '',
        'CURLOPT_IPRESOLVE' => 1,
        'CURLOPT_RETURNTRANSFER' => true,
        'CURLOPT_SSL_VERIFYPEER' => false,
        'CURLOPT_CONNECTTIMEOUT' => 10,
    );

    private $info;
    private $data;
    private $error;
    private $message;
    private $result;

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

    public function result()
    {
        return $this->result;
    }


    /**
     * Set POST data
     * @param array|string $data
     * @param null|string $value
     * @return self
     */
    public function post($data, $value = null)
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
            $this->set('CURLOPT_SAFE_UPLOAD', true);
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
        if (!$this->error) {
            $fp = @fopen($path, 'w');
            if ($fp === false) {
                $this->error = true;
                $this->message = "The path {$path} is not writable.";
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
        $url = RPCURL . $url;
        return $this->set('CURLOPT_URL', $url)->process();
    }

    /**
     * Set option
     * @param array|string $item
     * @param null|string $value
     * @return self
     */
    public function set($item, $value = null)
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
     * Set retry times
     * @param int $times
     * @return self
     */
    public function retry($times = 0)
    {
        $this->retry = $times;
        return $this;
    }

    /**
     * Task process
     * @param int $retry
     * @return self
     */
    private function process($retry = 0)
    {
        $ch = curl_init();

        $option = array_merge($this->option, $this->custom);
        foreach ($option as $key => $val) {
            if (is_string($key)) {
                $key = constant(strtoupper($key));
            }
            curl_setopt($ch, $key, $val);
        }

        if ($this->post) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->build_array($this->post));
        }
        Yii::info('RPC: url| params|');
        $this->data = (string)curl_exec($ch);
        $this->info = curl_getinfo($ch);
        $this->error = curl_errno($ch) > 0;
        $this->message = $this->error ? curl_error($ch) : '';

        curl_close($ch);

        if ($this->error && $retry < $this->retry) {
            $this->process($retry + 1);
        }

        $this->processResult();

        $this->post = array();
        $this->retry = 0;

        return $this;
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
        if ($this->error) {
            Yii::error($this->message);
            throw new RpcException($this->message, ErrorCode::SYSTEM_ERROR);
        } else {
            $res = json_decode($this->data);
            if ($res['ret'] == 1) {
                $this->result = $res['data'];
            } else {
                if ($res['data']['code'] >= ErrorCode::ACTION_ERROR) {
                    Yii::error('RPC_ERR: ' . $res['data']['msg']);
                } else {

                }
                throw new RpcException('', ErrorCode::ACTION_ERROR);
            }
        }
    }
}
