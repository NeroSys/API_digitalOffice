<?php

namespace common\models\events;

use common\models\directory\Sec;
use Yii;

/**
 * This is the model class for table "marketing_events".
 *
 * @property integer $id
 * @property integer $sec_id
 * @property string $file
 *
 * @property Sec $sec
 */
class MarketingEvents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marketing_events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sec_id'], 'required'],
            [['sec_id'], 'integer'],
            [['file'], 'string', 'max' => 255],
            [['sec_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sec::className(), 'targetAttribute' => ['sec_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sec_id' => 'Sec ID',
            'file' => 'File',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSec()
    {
        return $this->hasOne(Sec::className(), ['id' => 'sec_id']);
    }
}
