<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "forum_category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sort
 * @property integer $status
 */
class ForumCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'forum_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['sort', 'status'], 'integer'],
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
            'sort' => 'Сортировка',
            'status' => 'Статус',
        ];
    }
    
    public function catlist() {
        $model = ForumCategory::find()->where(['status'=>1])->all();
        $result = [];
        foreach ($model as $data) {
            $result[$data->id] = $data->name;
        }
        return $result;
    }
}
