<?php

#################################
##          OneClickMoney      ## 
##    http://oneclickmoney.ru  ##
##     27.03.2015, 10:23:37    ##
##  author: Victor Shumeyko    ##
##  Предназначение :           ##
#################################
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = $post->name;
$this->params['breadcrumbs'] = [
            [
                'label' => 'Форум',
                'url' => ['forum/'],
            ],
            [
                'label' => $category->name,
                'url' => ['forum/cat/', 'id' => $category->id],
            ],
            [
                'label'=>$post->name
            ]
        ]
        ;
?>
<h1><?php echo $post->name;?></h1>

<?php foreach ($messages as $message) { ?>
<?php $userModel = app\models\Users::findOne($message->author); ?>
<?php $userName = $userModel['login'];?>
    <div class="media message" id='message-<?php echo $message->id ?>'>
      <div class="media-left">
        <a href="#message-<?php echo $message->id ?>">
            <img class="media-object" data-src="holder.js/64x64" alt="64x64" style="width: 64px; height: 64px;" src="/img/avatars/<?php echo $post->author; ?>.jpg" data-holder-rendered="true">
            #<?php echo $message->id ?>            
        </a>
          <?php echo $userName ?>[<?php echo $message->author; ?>]
      </div>
      <div class="media-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-clock-o"></i> <?php echo date('d.m.Y H:i:s',$message->dateadd) ?>
                    <?php if($message->author == Yii::$app->user->id) { ?><button type="button" class="transparent close" data-dismiss="alert" aria-label="Close"  data-id="<?php echo $message->id ?>" data-type="message" data-type="message" data-toggle="tooltip" data-placement="top" title="Удалить">&nbsp;<span class="fa fa-trash" aria-hidden="true"></span></button><?php } ?>
                    <button type="button" class="transparent setAnswer" data-dismiss="alert" aria-label="Close"  data-id="<?php echo $message->id ?>" data-type="message" data-type="message" data-toggle="tooltip" data-placement="top" title="Ответить">&nbsp;<span class="fa fa-share-square-o" aria-hidden="true"></span></button>
                    <button type="button" class="transparent setQuote" data-dismiss="alert" aria-label="Close"  data-id="<?php echo $message->id ?>" data-type="message" data-type="message" data-toggle="tooltip" data-placement="top" title="Цитировать"><span class="fa fa-quote-left" aria-hidden="true"></span></button>
                </div>
                <div class="panel-body"><?php echo $message->message ?></div>
            </div>
        <?php
        $answers = \app\models\ForumMessage::find()
            ->where(['status' => 1,'post_id'=>$post->id,'answer'=>$message->id])
            ->orderBy('id asc')
            ->all();
        foreach ($answers as $answer) { ?>
<?php $userNameAnswer = app\models\Users::findOne($answer->author)->login; ?>
        <div class="media answer" id='message-<?php echo $answer->id ?>'>
          <div class="media-left">
            <!--<a href="#">-->
              <img class="media-object" data-src="holder.js/64x64" alt="64x64" style="width: 64px; height: 64px;" src="/img/avatars/<?php echo $answer->author; ?>.jpg" data-holder-rendered="true">
              #<?php echo $answer->id ?>
            <!--</a>-->
            <?php echo $userNameAnswer ?>[<?php echo $answer->author; ?>]
          </div>
          <div class="media-body">
              <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-clock-o"></i> <?php echo date('d-m-Y H:i:s',$answer->dateadd) ?>
                    <?php if($answer->author == Yii::$app->user->id) { ?><button type="button" class="transparent close" data-dismiss="alert" aria-label="Close"  data-id="<?php echo $answer->id ?>" data-type="message" data-type="message" data-toggle="tooltip" data-placement="top" title="Удалить">&nbsp;<span class="fa fa-trash" aria-hidden="true"></span></button><?php } ?>
                    <button type="button" class="transparent setQuote" data-dismiss="alert" aria-label="Close"  data-id="<?php echo $answer->id ?>" data-type="message" data-type="message" data-toggle="tooltip" data-placement="top" title="Цитировать"><span class="fa fa-quote-left" aria-hidden="true"></span></button>
                </div>
                <div class="panel-body"><?php echo $answer->message ?></div>
            </div>
          </div>
        </div>
        <?php } ?>
        </div>
    </div>
<?php } ?>

<?php if (!Yii::$app->user->isGuest) { ?>
<br/>
<hr/>
<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Написать сообщение</button>
<?php } else { ?>
<h3><p class="bg-danger padding-15 text-center">Гости не могут оставлять сообщения.<span class="bottom-dashed pointer" id="login-show">Войти?</span></p></h3>
<?php } ?>
<div class="collapse" id="collapseExample">
<div class="col-lg-12 bs-callout bs-callout-info">
<?php
$form = ActiveForm::begin([
    'id' => 'answer-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>
    <div class="row"><span class="label label-success hidden" id="answer">Ответ на сообщение #<b></b></span></div>
    <?= $form->field($model, 'message')->textarea(); ?>
    <?= Html::activeHiddenInput($model,'author',['value'=>Yii::$app->user->id]);?>
    <?= Html::activeHiddenInput($model,'answer',['value'=>0]);?>
    <?= Html::activeHiddenInput($model,'post_id',['value'=>$post->id]);?>
    <?= Html::activeHiddenInput($model,'dateadd',['value'=>  time()]);?>
    <?= Html::activeHiddenInput($model,'status',['value'=>1]);?>

    <div class="form-group pull-left">
            <?= Html::submitButton('Написать', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end() ?>
  </div>
</div>