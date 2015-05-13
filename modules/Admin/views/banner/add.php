<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Banner */
/* @var $form ActiveForm */
$this->title = $id ? 'Редактировать баннер' : 'Добавить баннер';
$this->params['breadcrumbs'][] = ['label'=>'Баннеры','url'=>'/admin/banner/'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-add">

    <?php $form = ActiveForm::begin([
        'id' => 'add-banner-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'description') ?>
        <?= $form->field($model, 'url') ?>
        <?= $form->field($model, 'image') ?>
        <div class="form-group field-banner-status required">
            <label class="col-lg-1 control-label" for="banner-status">Статус</label>
            <div class="col-lg-3">
                <?= Html::activeDropDownList($model, 'status',[1=>'Включить',0=>'Выключить'],['class' => 'form-control']) ?>
            </div>
            <div class="col-lg-8">
                <div class="help-block"></div>
            </div>
        </div>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- banner-add -->
