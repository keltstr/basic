<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "banner".
 *
 * @property integer $id
 * @property string $description
 * @property string $url
 * @property string $image
 * @property integer $status
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'url', 'image', 'status'], 'required'],
            [['description', 'url', 'image'], 'string'],
            [['status'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Описание',
            'url' => 'Ссылка',
            'image' => 'Картинка',
            'status' => 'Статус',
        ];
    }
}
