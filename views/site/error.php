<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
$this->params['breadcrumbs'] = ['404'];
?>
<div class="site-error text-center">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="col-lg-12">
        <div class="col-lg-4"></div>
        <div class=" col-lg-4 text-center center-block alert alert-danger">
            <div class="center-block"><?= nl2br(Html::encode($message)) ?></div>
        </div>
        <div class="col-lg-4"></div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-12">
        <img class="center-block" src="/img/gif/404.gif">
    </div>
    <div class="clearfix"></div>

</div>
