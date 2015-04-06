<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="col-lg-12">
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-lg-1">Тип</th>
                <th class="col-lg-7">Тема</th>
                <th class="col-lg-1">Сообщения</th>
                <th class="col-lg-2">Раздел</th>
                <th class="col-lg-1">Управление</th>
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
            
            $lastMessage = \app\models\ForumMessage::find()
                ->where(['post_id' => $post->id])
                ->orderBy('id desc')
                ->select('dateadd')
                ->one();
            if (!$lastMessage) {
                $lastMessage['dateadd'] = 1;
            }

            if ($lastMessage['dateadd'] == time()) {
                $mailIcon = 4;
                $mailTitle = 'Есть новые ответы';
            } else if ($messagesCount > 50) {
                $mailIcon = 3;
                $mailTitle = 'Популярная тема';
            } else if ($messagesCount > 10) {
                $mailIcon = 2;
                $mailTitle = 'Набирает обороты';
            } else {
                $mailIcon = 1;
                $mailTitle = 'Обычная тема';
            }
            ?>
            <tr id="message-<?php echo $post->id?>">
                <td class="col-lg-1"><div class="mail mail-<?php echo $mailIcon;?>" title="<?php echo $mailTitle; ?>"><!--img src="/img/icons/message/message.png"--></div></td>
                <td class="col-lg-7"><a href="<?php echo Url::to(['forum/post/','id'=>$post->id]) ?>"><?php echo $post->name; ?></a></td>
                <td class="col-lg-1 text-center"><?php echo $messagesCount; ?></td>
                <td class="col-lg-2"><a href="<?php echo Url::to(['forum/cat/','id'=>$post->category]) ?>"><?php echo $category->name; ?></a></td>
                <td class="col-lg-1"><a data-id="<?php echo $post->id?>" data-type="post" class="close">Удалить</a></td>
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