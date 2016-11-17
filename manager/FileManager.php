<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/17
 * Time: 21:42
 */

namespace app\manager;


class FileManager
{
    public static function saveImg($img_name)
    {
        $img_path = UPLOAD_IMG_PATH . $img_name;

    }

    public static function saveFile($file_name)
    {
        $file_path = UPLOAD_FILE_PATH . $file_name;

    }
}