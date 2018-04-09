<?php

namespace common\models\documents;

use common\models\directory\Department;
use common\models\directory\DocumentStatus;
use common\models\directory\DocumentsType;
use common\models\directory\Sec;
use common\models\User;
use common\models\users\UserProfile;
use Yii;

/**
 * This is the model class for table "documents".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $type_id
 * @property integer $sec_id
 * @property integer $status_id
 * @property integer $departament_id
 * @property integer $account_number
 * @property string $date
 * @property string $name
 * @property double $amount
 * @property string $file
 *
 * @property Department $departament
 * @property DocumentsType $type
 * @property Sec $sec
 * @property DocumentStatus $status
 * @property User $user
 */
class Documents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'documents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'type_id', 'sec_id', 'status_id', 'account_number', 'amount'], 'required'],
            [['user_id', 'type_id', 'sec_id', 'status_id', 'departament_id', 'account_number'], 'integer'],
            [['date'], 'safe'],
            [['amount'], 'number'],
            [['name', 'file'], 'string', 'max' => 255],
            [['departament_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['departament_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentsType::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['sec_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sec::className(), 'targetAttribute' => ['sec_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'type_id' => 'Type ID',
            'sec_id' => 'Sec ID',
            'status_id' => 'Status ID',
            'departament_id' => 'Departament ID',
            'account_number' => 'Account Number',
            'date' => 'Date',
            'name' => 'Name',
            'amount' => 'Amount',
            'file' => 'File',
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
    public function getType()
    {
        return $this->hasOne(DocumentsType::className(), ['id' => 'type_id']);
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
    public function getStatus()
    {
        return $this->hasOne(DocumentStatus::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestFl()
    {
        return GetDucument::find()->where(['doc_id' => $this->id])->andWhere(['user_id' => \Yii::$app->user->identity->id])->exists();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getUserName(){
        return UserProfile::find()
            ->where(['user_id' => $this->user_id])
            ->andWhere(['slug' => 'fio'])
            ->one()->value;
    }

}
