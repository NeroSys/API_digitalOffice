<?php

namespace common\models\directory;

use Yii;

/**
 * This is the model class for table "bid_form".
 *
 * @property integer $id
 * @property integer $departament_id
 * @property integer $subject_id
 * @property string $departament
 * @property string $subject
 * @property string $fields
 *
 * @property Department $departament0
 * @property BidSubject $subject0
 */
class BidForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bid_form';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['departament_id', 'subject_id', 'fields'], 'required'],
            [['departament_id', 'subject_id'], 'integer'],
            [['fields'], 'string'],
            [['departament', 'subject'], 'string', 'max' => 255],
            [['departament_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['departament_id' => 'id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => BidSubject::className(), 'targetAttribute' => ['subject_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'departament_id' => 'Departament ID',
            'subject_id' => 'Subject ID',
            'departament' => 'Departament',
            'subject' => 'Subject',
            'fields' => 'Fields',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartament0()
    {
        return $this->hasOne(Department::className(), ['id' => 'departament_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject0()
    {
        return $this->hasOne(BidSubject::className(), ['id' => 'subject_id']);
    }
}
