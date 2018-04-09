<?php

namespace common\models\directory;

use Yii;

/**
 * This is the model class for table "sec".
 *
 * @property integer $id
 * @property string $name
 * @property integer $enable
 */
class Sec extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sec';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['enable'], 'required'],
            [['enable'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'enable' => 'Enable',
        ];
    }

}
