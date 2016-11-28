<?php
/**
 * Created by PhpStorm.
 * User: lyb
 * Date: 2016/11/12
 * Time: 21:19
 */

namespace app\model;

use Yii;
use app\components\LModel;

class SessionModel extends LModel
{
    public static function tableName()
    {
        return '{{%session}}';
    }

    /**
     * @return SessionModel
     */
    public static function model()
    {
        return parent::model();
    }

    public function read($id)
    {
        $session = $this->find()
            ->where(['id' => $id])
            ->andFilterCompare('expires', time(), '>')
            ->asArray()
            ->one();
        return $session;
    }

    public function write($id, $data)
    {
        $expires = SESSION_LIFE_TIME + time();
        $sql = sprintf(' REPLACE INTO t_session SET id=%s,expires =%d,`data`=%s', $id, $expires, $data);
        $res = SessionModel::getDb()->createCommand($sql)->execute();
        return $res;
    }

    public function destroy($id)
    {
        $session = $this->findOne($id);
        $res = $session->delete();
        return $res;
    }

    public function gc()
    {
        $condition = ['expires', time(), '<'];
        $res = SessionModel::deleteAll($condition);
        return $res;
    }

}