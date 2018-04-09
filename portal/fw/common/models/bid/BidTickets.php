<?php

namespace common\models\bid;

use common\models\User;
use common\models\users\UserProfile;
use Yii;

/**
 * This is the model class for table "bid_tickets".
 *
 * @property integer $id
 * @property integer $bid_id
 * @property integer $user_id
 * @property integer $creator_id
 * @property string $create_date
 * @property string $text
 *
 * @property User $creator
 * @property Bid $bid
 * @property User $user
 */
class BidTickets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bid_tickets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bid_id', 'user_id', 'creator_id', 'text'], 'required'],
            [['bid_id', 'user_id', 'creator_id'], 'integer'],
            [['create_date'], 'safe'],
            [['text'], 'string'],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['creator_id' => 'id']],
            [['bid_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bid::className(), 'targetAttribute' => ['bid_id' => 'id']],
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
            'bid_id' => 'Bid ID',
            'user_id' => 'User ID',
            'creator_id' => 'Creator ID',
            'create_date' => 'Create Date',
            'text' => 'Text',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'creator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBid()
    {
        return $this->hasOne(Bid::className(), ['id' => 'bid_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getCreatorName(){
        return $this->hasOne(UserProfile::className(), ['user_id' => 'creator_id'])->andWhere(['slug' => 'fio']);
    }

    public function getUserName(){
        return $this->hasOne(UserProfile::className(), ['user_id' => 'user_id'])->andWhere(['slug' => 'fio']);
    }
}
