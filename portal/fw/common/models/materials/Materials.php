<?php

namespace common\models\materials;

use common\models\directory\Sec;
use Yii;

/**
 * This is the model class for table "materials".
 *
 * @property integer $id
 * @property integer $sec_id
 * @property string $name
 * @property string $text
 * @property string $file
 * @property string $type
 *
 * @property Sec $sec
 */
class Materials extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'materials';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sec_id'], 'required'],
            [['sec_id'], 'integer'],
            [['text', 'type'], 'string'],
            [['name', 'file'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'text' => 'Text',
            'file' => 'File',
            'type' => 'Type',
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
