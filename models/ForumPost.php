<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "forum_post".
 *
 * @property integer $id
 * @property string $name
 * @property integer $author
 * @property integer $category
 * @property integer $status
 */
class ForumPost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'forum_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'author', 'category'], 'required'],
            [['author', 'category', 'status'], 'integer'],
            [['name'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'author' => 'Автор',
            'category' => 'Категория',
            'status' => 'Статус',
        ];
    }
}
