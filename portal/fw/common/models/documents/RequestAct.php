<?php

namespace common\models\documents;

use common\models\User;
use Yii;

/**
 * This is the model class for table "request_act".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $create_date
 * @property string $date_from
 * @property string $date_to
 * @property string $email
 * @property string $status
 *
 * @property User $user
 */
class RequestAct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_act';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'date_from', 'date_to'], 'required'],
            [['user_id'], 'integer'],
            [['create_date', 'date_from', 'date_to'], 'safe'],
            [['status'], 'string'],
            [['email'], 'string', 'max' => 255],
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
            'create_date' => 'Create Date',
            'date_from' => 'Date From',
            'date_to' => 'Date To',
            'email' => 'Email',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
