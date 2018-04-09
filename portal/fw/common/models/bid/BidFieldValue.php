<?php

namespace common\models\bid;

use Yii;

/**
 * This is the model class for table "bid_field_value".
 *
 * @property integer $id
 * @property integer $bid_id
 * @property string $fields
 * @property string $value
 *
 * @property Bid $bid
 */
class BidFieldValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bid_field_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bid_id', 'value'], 'required'],
            [['bid_id'], 'integer'],
            [['value'], 'string'],
            [['fields'], 'string', 'max' => 32],
            [['bid_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bid::className(), 'targetAttribute' => ['bid_id' => 'id']],
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
            'fields' => 'Fields',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBid()
    {
        return $this->hasOne(Bid::className(), ['id' => 'bid_id']);
    }
}
