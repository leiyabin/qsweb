<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/10/30
 * Time: 22:36
 */

namespace app\components;


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

    public static function formatDateTime($timestamp)
    {
        return date('Y-m-d H:i:s', $timestamp);
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

    public static function getLowerFileExt($file_name)
    {
        $temp_arr = explode(".", $file_name);
        $file_ext = array_pop($temp_arr);
        $file_ext = trim($file_ext);
        $file_ext = strtolower($file_ext);
        return $file_ext;
    }

}