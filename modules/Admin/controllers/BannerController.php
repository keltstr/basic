<?php

#################################
##          OneClickMoney      ## 
##    http://oneclickmoney.ru  ##
##     13.05.2015, 14:31:57    ##
##  author: Victor Shumeyko    ##
##  Предназначение :           ##
#################################

namespace app\modules\Admin\controllers;
use Yii;
use yii\web\Controller;
use yii\data\Pagination;
class BannerController extends Controller
{
    public $layout = 'admin';
    public function actionIndex()
    {
        $model = \app\models\Banner::find();
        $countModel = clone $model;
        $pagination = new Pagination(['totalCount' => $countModel->count(), 'pageSize'=>10]);
        $banners = \app\models\Banner::find()
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

        return $this->render('index',['banners'=>$banners,'count'=>$countModel->count(),'limit'=>$pagination->limit,'offset'=>$pagination->offset,'pagination'=>$pagination]);
    }
    
    public function actionAdd($id=false)
    {
        if ($id) {
            $model = $this->loadModel($id);
        } else {
            $model = new \app\models\Banner;
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if($model->save()) {
                    if ($id) {
                        Yii::$app->getSession()->setFlash('success', 'Вы успешно обновили баннер');
                    } else {
                        Yii::$app->getSession()->setFlash('success', 'Вы успешно добавили новый баннер');
                    }
                    $this->redirect('/admin/banner/index');
                }
                // form inputs are valid, do something here
                return;
            }
        }

        return $this->render('/banner/add', [
            'model' => $model,
            'id' => $id
        ]);
    }
    
    public function actionDelete($id) {
        $model = $this->loadModel($id);
        if ($model->delete()) {
            Yii::$app->getSession()->setFlash('success', 'Вы успешно удалили баннер');
            $this->redirect('/admin/banner/index');
        }
    }

        public function loadModel($id)
    {
        $model = \app\models\Banner::findOne($id);
        if ($model === null)
            throw new \yii\web\HttpException(404, 'Запрашиваемая страница не существует.');
        return $model;
    }
}
