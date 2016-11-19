<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/17
 * Time: 21:38
 */

namespace app\controllers\admin;

use app\components\LController;
use app\components\Utils;
use app\consts\ErrorCode;
use app\exception\RequestException;
use app\exception\UploadException;
use Yii;

class FileController extends LController
{
    private $file_type = [
        'image' => ['png', 'jpg', 'jpeg', 'gif', 'bmp']
    ];

    public function actionAddimg()
    {
        if (count($_FILES) != 0) {
            $file_name = key($_FILES);
            if ($_FILES[$file_name]['error'] > 0) {
                $this->throwError($_FILES[$file_name]['error']);
            } else {
                $file_ext = Utils::getLowerFileExt($_FILES[$file_name]['name']);
                $new_file_name = $this->saveImg($file_ext, $_FILES[$file_name]['tmp_name']);
                return $this->success($new_file_name);
            }
        } else {
            throw new RequestException('请上传文件！');
        }
    }

    private function throwError($error_code)
    {
        switch ($error_code) {
            case 1:
                throw new UploadException('文件大小超过' . UPLOAD_MAX_FILESIZE, ErrorCode::ACTION_ERROR);
                break;
            case 2:
                throw new UploadException('文件大小超过' . POST_MAX_SIZE, ErrorCode::ACTION_ERROR);
                break;
            case 3:
                Yii::error('文件只有部分被上传');
                throw new UploadException('文件上传失败，请稍后重试！', ErrorCode::SYSTEM_ERROR);
                break;
            case 4:
                throw new UploadException('没有文件被上传', ErrorCode::ACTION_ERROR);
                break;
            case 6:
                Yii::error('找不到临时文件夹');
                throw new UploadException('文件上传失败，请稍后重试！', ErrorCode::SYSTEM_ERROR);
                break;
            case 7:
                Yii::error('文件写入失败');
                throw new UploadException('文件上传失败，请稍后重试！', ErrorCode::SYSTEM_ERROR);
                break;
            default:
                throw new UploadException('文件上传失败，请稍后重试！', ErrorCode::ACTION_ERROR);
        }
    }

    private function saveImg($file_ext, $tmp_name)
    {
        if (!in_array($file_ext, $this->file_type['image'])) {
            throw new UploadException('只允许' . implode(',', $this->file_type['image']) . '格式的文件。', ErrorCode::ACTION_ERROR);
        }
        $new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;

        $file_path = WEB_PATH . UPLOAD_IMG_PATH . $new_file_name;
        if (move_uploaded_file($tmp_name, $file_path) === false) {
            throw new UploadException('上传文件失败', ErrorCode::SYSTEM_ERROR);
        }
        @chmod($file_path, 0644);
        return ['file_name' => $new_file_name, 'file_path' => UPLOAD_IMG_PATH . $new_file_name];
    }
}