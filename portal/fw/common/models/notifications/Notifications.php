<?php

namespace common\models\notifications;

use common\models\User;
use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property integer $id
 * @property integer $creator_id
 * @property string $create-date
 * @property string $header
 * @property string $text
 *
 * @property NotificationToUser[] $notificationToUsers
 * @property User[] $users
 * @property User $creator
 */
class Notifications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['creator_id'], 'required'],
            [['creator_id'], 'integer'],
            [['create-date'], 'safe'],
            [['header', 'text'], 'string'],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['creator_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'creator_id' => 'Creator ID',
            'create-date' => 'Create Date',
            'header' => 'Header',
            'text' => 'Text',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificationToUsers()
    {
        return $this->hasMany(NotificationToUser::className(), ['ntId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'userId'])->viaTable('notification_to_user', ['ntId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'creator_id']);
    }
}
