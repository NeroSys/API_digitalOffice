<?php

namespace common\models\notifications;

use common\models\User;
use Yii;

/**
 * This is the model class for table "notification_to_user".
 *
 * @property integer $ntId
 * @property integer $userId
 *
 * @property User $user
 * @property Notifications $nt
 */
class NotificationToUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification_to_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ntId', 'userId'], 'required'],
            [['ntId', 'userId'], 'integer'],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
            [['ntId'], 'exist', 'skipOnError' => true, 'targetClass' => Notifications::className(), 'targetAttribute' => ['ntId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ntId' => 'Nt ID',
            'userId' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNt()
    {
        return $this->hasOne(Notifications::className(), ['id' => 'ntId']);
    }
}
