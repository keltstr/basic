<?php

namespace app\modules\Admin\controllers;
use Yii;
use yii\web\Controller;
class ActionController extends Controller
{
    public $layout = 'admin';
    public function actionIndex()
    {
        if (!Yii::$app->user->isAdmin()) {
            $this->redirect('/site/index');
        }
        return $this->render('index');
    }
    
    public function actionLogout() {
        Yii::$app->user->logout(true);
        Yii::$app->getSession()->setFlash('success', 'Вы успешно вышли из панели управления');
        $this->redirect('/site/index');
    }
    
    public function actionG() {
        echo 123;
    }
}
