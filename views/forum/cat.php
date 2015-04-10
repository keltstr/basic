<?php

#################################
##          OneClickMoney      ## 
##    http://oneclickmoney.ru  ##
##     30.03.2015, 14:44:23    ##
##  author: Victor Shumeyko    ##
##  Предназначение :           ##
#################################
use yii\helpers\Url;
?>
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
                <td><?php echo $category->name; ?></td>
                <td>---</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>