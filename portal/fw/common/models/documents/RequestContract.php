<?php

namespace common\models\documents;

use common\models\directory\Department;
use common\models\directory\Sec;
use common\models\User;
use Yii;

/**
 * This is the model class for table "request_contract".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $sec_id
 * @property integer $departament_id
 * @property string $email
 * @property string $request_date
 *
 * @property Department $departament
 * @property User $user
 * @property Sec $sec
 */
class RequestContract extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_contract';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'sec_id', 'departament_id'], 'required'],
            [['user_id', 'sec_id', 'departament_id'], 'integer'],
            [['request_date'], 'safe'],
            [['status'], 'string'],
            [['email'], 'string', 'max' => 255],
            [['departament_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['departament_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'user_id' => 'User ID',
            'sec_id' => 'Sec ID',
            'departament_id' => 'Departament ID',
            'email' => 'Email',
            'request_date' => 'Request Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartament()
    {
        return $this->hasOne(Department::className(), ['id' => 'departament_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSec()
    {
        return $this->hasOne(Sec::className(), ['id' => 'sec_id']);
    }
}
