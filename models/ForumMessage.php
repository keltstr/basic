<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "forum_message".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $author
 * @property string $message
 * @property integer $answer
 * @property integer $status
 * @property string $dateadd
 */
class ForumMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'forum_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'author', 'message', 'dateadd'], 'required'],
            [['post_id', 'author', 'answer', 'status'], 'integer'],
            [['message'], 'string'],
            [['dateadd'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'author' => 'Author',
            'message' => 'Сообщение',
            'answer' => 'Answer',
            'status' => 'Status',
            'dateadd' => 'Dateadd',
        ];
    }
}
