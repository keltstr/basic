<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\ForumMessage;
class ForumController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $data = new \app\models\ForumPost;
        if ($data->load(Yii::$app->request->post()) && $data->validate()) {
            $data->save();
        }
        $catList = \app\models\ForumCategory::catlist();
        $model = \app\models\ForumPost::find()
            ->where(['status' => 1])
            ->orderBy('id desc')
            ->all();
        return $this->render('index',array('model'=>$model,'data'=>$data,'catList'=>$catList));
    }
    
    public function actionPost($id) {
        $post = $this->loadModel($id);
        $model = new \app\models\ForumMessage;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
        }
        $messages = \app\models\ForumMessage::find()
            ->where(['status' => 1,'post_id'=>$id,'answer'=>0])
            ->orderBy('id asc')
            ->all();
        $category = \app\models\ForumCategory::findOne($post->category);
        return $this->render('post',array('post'=>$post,'messages'=>$messages,'category'=>$category,'model'=>$model));
    }
    
    public function actionCat($id) {
        $model = \app\models\ForumPost::find()
                ->where(['status' => 1,'category'=>$id])
                ->orderBy('id desc')
                ->all();
        return $this->render('cat',['model'=>$model]);
    }

        public function loadModel($id)
    {
        $model = \app\models\ForumPost::findOne($id);
        if ($model === null)
            throw new \yii\web\HttpException(404, 'Запрашиваемая страница не существует.');
        return $model;
    }
    
    public function actionDelete() {
        $type = $_POST['type'];
        switch ($_POST['type']) {
            case 'message':
                $model = ForumMessage::deleteAll(['id'=>$_POST['id']]);
                return json_encode(['status'=>1]);
                break;
            case 'post':
                $model = \app\models\ForumPost::deleteAll(['id'=>$_POST['id']]);
                return json_encode(['status'=>1]);
                break;
            default:
                break;
        }
    }

}
