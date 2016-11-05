<?php
/**
 * AdministratorsController.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */

namespace app\controllers\admin;

use app\components\LController;
use Yii;
use app\manager\AdminManager;
use yii\data\Pagination;

class AdminController extends LController
{
    /**
     * @var AdminManager
     */
    public $admin_manager;

    public function init()
    {
        parent::init();
        $this->admin_manager = new AdminManager();
    }

    public function actionIndex()
    {
        $list = $this->admin_manager->getList();
        $pages = new Pagination(['totalCount' => $list['total'], 'defaultPageSize' => $list['per_page']]);
        $list = $list['admin'];
        return $this->render('index', [
            'list'  => &$list,
            'pages' => $pages
        ]);
    }

    //添加
    public function actionAdd()
    {
        $request = Yii::$app->request;
        if (!$request->isPost) {
            return $this->render('add');
        } else {
        }
    }

    //修改
    public function actionEdit()
    {
        $request = Yii::$app->request;
        $id = (int)$request->get('id', $request->post('id'));
        if (!$id) {

        }
        if (!$request->isPost) {

        } else {

        }
    }

    /**
     * 删除用户,支持批量删除
     * @return array
     * @throws \Exception
     * @throws \yii\db\Exception
     */
    public function actionDelete()
    {
        $request = Yii::$app->request;
        $ids = $request->get('ids');
        if (!$ids) {
            return $this->error('请选中至少一个');
        }
        $ids = array_filter(explode(',', $ids));
        if (empty($ids)) {
            return $this->error('ids参数不合法');
        }
    }

    //登录日志
    public function actionLogs()
    {
//        $query = AdministratorLogin::find();
//        //搜索
//        $searchConditions = Yii::$app->request->get('search');
//        if (!empty($searchConditions)) {
//            if (!empty($searchConditions['username'])) {
//                $query->where('username like :username',[':username'=>'%'.$searchConditions['username'].'%']);
//            }
//        }
//        $countQuery = clone $query;
//        $pages = new Pagination(['totalCount'=>$countQuery->count(),'defaultPageSize'=>20]);
//        $list = $query->offset($pages->offset)->limit($pages->limit)->orderBy('id desc')->all();
//        return $this->render('logs',[
//            'list' => &$list,
//            'pages' => $pages
//        ]);
    }
}