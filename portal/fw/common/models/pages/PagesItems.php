<?php

namespace common\models\pages;

use Yii;

/**
 * This is the model class for table "pages_items".
 *
 * @property integer $id
 * @property string $page-name
 * @property string $slug
 * @property string $value
 */
class PagesItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'string'],
            [['page-name', 'slug'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page-name' => 'Page Name',
            'slug' => 'Slug',
            'value' => 'Value',
        ];
    }
}
