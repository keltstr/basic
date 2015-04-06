<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h1>forum/index</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>
<div class="col-lg-12">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Тип</th>
                <th>Тема</th>
                <th>Сообщения</th>
                <th>Раздел</th>
                <th>Управление</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($model as $post) { ?>
            <?php 
            $category = \app\models\ForumCategory::find()
                ->where(['id' => $post->category])
                ->one();
            $messagesCount = \app\models\ForumMessage::find()
                ->where(['post_id' => $post->id])
                ->count();
            ?>
            <tr>
                <td><div class="fire"><img src="/img/icons/message/message.png"></div></td>
                <td><a href="<?php echo Url::to(['forum/post/','id'=>$post->id]) ?>"><?php echo $post->name; ?></a></td>
                <td><?php echo $messagesCount; ?></td>
                <td><a href="<?php echo Url::to(['forum/cat/','id'=>$post->category]) ?>"><?php echo $category->name; ?></a></td>
                <td>---</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="clearfix"></div>
<?php if (Yii::$app->user->id == 100) { ?>
<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Создать пост</button>
<?php } ?>
<div class="collapse" id="collapseExample">

<hr/>
<div class="col-lg-12 bs-callout bs-callout-info">
<?php
$form = ActiveForm::begin([
    'id' => 'post-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>
    <div class="row"><span class="label label-success hidden" id="answer">Ответ на сообщение #<b></b></span></div>
    <?= $form->field($data, 'name')->textInput(); ?>
    <?= $form->field($data, 'category')->dropDownList($catList); ?>
    <?= Html::activeHiddenInput($data,'author',['value'=>Yii::$app->user->id]);?>
    <?= Html::activeHiddenInput($data,'status',['value'=>1]);?>

    <div class="form-group pull-left">
            <?= Html::submitButton('Написать', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end() ?>
  </div>
</div>