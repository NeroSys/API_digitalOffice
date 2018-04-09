<?php

namespace common\models\goods_circle;

use common\models\directory\Sec;
use common\models\User;
use common\models\users\UserProfile;
use Yii;

/**
 * This is the model class for table "goods_circle".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $sec_id
 * @property string $date
 * @property double $turnover
 * @property string $file
 *
 * @property User $user
 */
class GoodsCircle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_circle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'sec_id'], 'required'],
            [['user_id', 'sec_id'], 'integer'],
            [['date'], 'safe'],
            [['turnover'], 'number'],
            [['file'], 'string', 'max' => 255],
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
            'sec_id' => 'SEC Id',
            'date' => 'Date',
            'turnover' => 'Turnover',
            'file' => 'File',

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

    public function getUserName(){
        return UserProfile::find()
            ->where(['user_id' => $this->user_id])
            ->andWhere(['slug' => 'fio'])
            ->one()->value;
    }

}
