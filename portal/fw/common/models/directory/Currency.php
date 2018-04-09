<?php

namespace common\models\directory;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property integer $id
 * @property string $name
 * @property string $sign
 * @property string $code
 * @property double $rate
 * @property integer $default
 * @property integer $enable
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rate'], 'number'],
            [['default', 'enable'], 'integer'],
            [['name'], 'string', 'max' => 32],
            [['sign'], 'string', 'max' => 2],
            [['code'], 'string', 'max' => 3],
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
            'sign' => 'Sign',
            'code' => 'Code',
            'rate' => 'Rate',
            'default' => 'Default',
            'enable' => 'Enable',
        ];
    }
}
