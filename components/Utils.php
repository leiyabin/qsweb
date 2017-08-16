<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/10/30
 * Time: 22:36
 */

namespace app\components;


use app\consts\UtilsConst;

class Utils
{
    public static function getDefault(array $array, $field, $default_value)
    {
        if (isset($array[$field])) {
            return $array[$field];
        } else {
            return $default_value;
        }
    }

    public static function lMd5($code)
    {
        $code .= 'lyblxy';
        return md5($code);
    }

    public static function getLength($value)
    {
        return mb_strlen($value, 'utf-8');
    }

    public static function subStr($content, $size)
    {
        if (self::getLength($content) > $size) {
            return mb_substr($content, 0, $size - 2, "utf-8") . '...';
        }
        return $content;
    }

    public static function formatDateTime($timestamp, $format = 'Y-m-d H:i:s')
    {
        return date($format, $timestamp);
    }

    public static function validPhone($phone)
    {
        return preg_match('/^1\d{10}$/', $phone);
    }

    public static function validEmail($email)
    {
        return preg_match('/^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/', $email);
    }

    public static function validVal($val, $required, $minLength = 0, $maxLength = false)
    {
        if ($required && empty($val)) {
            return false;
        }
        if (!empty($val) && $minLength && Utils::getLength($val) < $minLength) {
            return false;
        }
        if (!empty($val) && $maxLength && Utils::getLength($val) > $maxLength) {
            return false;
        }
        return true;
    }

    public static function validNum($val, $required, $min = 1, $max = UtilsConst::MAX_INT)
    {
        if ($required && empty($val)) {
            return false;
        }
        if (!empty($val) && $min && Utils::getLength($val) < $min) {
            return false;
        }
        if (!empty($val) && $max && Utils::getLength($val) > $max) {
            return false;
        }
        return true;
    }

    public static function getLowerFileExt($file_name)
    {
        $temp_arr = explode(".", $file_name);
        $file_ext = array_pop($temp_arr);
        $file_ext = trim($file_ext);
        $file_ext = strtolower($file_ext);
        return $file_ext;
    }

    public static function getImgUrl($img_name, $default_img = '')
    {
        if (!empty($img_name)) {
            if(strpos($img_name, 'http') !== false){
                return $img_name;
            }else{
                return IMG_HOST . $img_name;
            }
        }
        return $default_img;
    }

    public static function safeHtml($html)
    {
        if (is_array($html)) {
            foreach ($html as $k => $v) {
                $html[$k] = self::safeHtml($v);
            }
            return $html;
        }
        return htmlspecialchars($html, ENT_QUOTES, 'utf-8');
    }

    public static function getSummary($content, $length, $start = 0)
    {
        $content = strip_tags($content);
        $content = preg_replace('/\s/', '', $content);
        $summary = mb_substr($content, $start, $length, "utf-8");
        return $summary;
    }

    public static function getValue($obj, $field, $default = '')
    {
        if (is_object($obj) && isset($obj->$field)) {
            return $obj->$field;
        }
        if (is_array($obj) && isset($obj[$field])) {
            return $obj[$field];
        }
        return $default;
    }

}