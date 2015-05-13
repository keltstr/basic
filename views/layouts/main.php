<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\ActiveForm;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<div class="alert alert-success alert-dismissible fade in" role="alert" id="success-message">
    <button type="button" class="transparent" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <div class="text-center"><strong>Успешно!</strong> <span id="success-message-text"> Best check yo self, you're not looking too good.</span></div>
</div>
<div class="alert alert-danger alert-dismissible fade in" role="alert" id="error-message">
    <button type="button" class="transparent" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <div class="text-center"><strong>Ошибка!</strong> <span id="error-message-text"> Best check yo self, you're not looking too good.</span></div>
</div>
<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Yii2 experiment',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'About', 'url' => ['/site/about']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
                    ['label' => 'Forum', 'url' => ['/forum/index']],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/site/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left col-lg-2">&copy; experiment <?= date('Y') ?></p>
            <p>
                <?php
                $banners = app\models\Banner::find()
                    ->where(['status' => 1])
                    ->orderBy('id desc')
                    ->limit(3)
                    ->all();
                foreach ($banners as $banner) { ?>
                <a href="<?=$banner->url;?>" target="_blank"><img class="footer-banner col-lg-2" title="<?=$banner->description;?>" src="<?=$banner->image;?>"></a>
                <?php } ?>
            </p>
            <p class="pull-right col-lg-3"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
<?php if (Yii::$app->user->isGuest && $this->context->id == 'forum') { ?>
<div class="alert alert-success alert-dismissible lgn" role="alert" id="login-box">
    <button type="button" class="transparent" onclick="closeAlert();"><span aria-hidden="true">×</span></button>
      <p class="text-center">Форма входа</p>
      <?php
      $model = new app\models\LoginForm;
      $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-vertical'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-12 control-label'],
        ],
        'action' => '/login'
    ]); ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'password')->passwordInput() ?>
    <div class="form-group">
        <div class="col-lg-offset-0 col-lg-11">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>
    <?= Html::activeHiddenInput($model, 'returnUrl',['value'=>Yii::$app->request->url]); ?>
      <?php ActiveForm::end(); ?>
    </div>
<?php } ?>
</body>
</html>
<?php 
if (Yii::$app->session->getFlash('success')) {
    echo '<script>setSuccess("'.Yii::$app->session->getFlash('success').'")</script>';
}
if (Yii::$app->session->getFlash('error')) {
    echo '<script>setError("'.Yii::$app->session->getFlash('error').'")</script>';
}
?>
<?php $this->endPage() ?>