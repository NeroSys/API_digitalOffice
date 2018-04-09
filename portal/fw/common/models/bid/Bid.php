<?php

namespace common\models\bid;

use common\models\directory\BidStatus;
use common\models\directory\BidSubject;
use common\models\directory\Department;
use common\models\directory\Sec;
use common\models\User;
use common\models\users\UserProfile;
use Yii;

/**
 * This is the model class for table "bid".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $create_date
 * @property integer $sec_id
 * @property integer $departament_id
 * @property integer $subject_id
 * @property integer $status_id
 * @property integer $post_count
 *
 * @property User $user
 * @property Sec $sec
 * @property Department $departament
 * @property BidSubject $subject
 * @property BidStatus $status
 */
class Bid extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bid';
    }

    public $departmentName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'sec_id', 'departament_id', 'subject_id'], 'required'],
            [['user_id', 'sec_id', 'departament_id', 'subject_id', 'status_id', 'post_count'], 'integer'],
            [['create_date', 'departmentName'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['sec_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sec::className(), 'targetAttribute' => ['sec_id' => 'id']],
            [['departament_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['departament_id' => 'id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => BidSubject::className(), 'targetAttribute' => ['subject_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => BidStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
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
            'create_date' => 'Create Date',
            'sec_id' => 'Sec ID',
            'departament_id' => 'Departament ID',
            'subject_id' => 'Subject ID',
            'status_id' => 'Status ID',
            'post_count' => 'Post Count',
        ];
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'departament_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartmentName()
    {
        return $this->getDepartment()->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(BidSubject::className(), ['id' => 'subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(BidStatus::className(), ['id' => 'status_id']);
    }
}
