<?php

namespace common\models\contacts;

use common\models\directory\Department;
use common\models\directory\DepartmentPosition;
use common\models\directory\Sec;
use Yii;

/**
 * This is the model class for table "contact_data".
 *
 * @property integer $id
 * @property integer $sec_id
 * @property integer $department_id
 * @property integer $position_id
 * @property string $fio
 * @property string $mail
 * @property string $phone
 * @property string $photo
 *
 * @property Department $position
 * @property Sec $sec
 * @property Department $department
 */
class ContactData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sec_id', 'department_id', 'position_id'], 'integer'],
            [['position_id'], 'required'],
            [['fio', 'mail', 'phone', 'photo'], 'string', 'max' => 255],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => DepartmentPosition::className(), 'targetAttribute' => ['position_id' => 'id']],
            [['sec_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sec::className(), 'targetAttribute' => ['sec_id' => 'id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
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
            'department_id' => 'Department ID',
            'position_id' => 'Position ID',
            'fio' => 'Fio',
            'mail' => 'Mail',
            'phone' => 'Phone',
            'photo' => 'Photo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(DepartmentPosition::className(), ['id' => 'position_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSec()
    {
        return $this->hasOne(Sec::className(), ['id' => 'sec_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }
}
