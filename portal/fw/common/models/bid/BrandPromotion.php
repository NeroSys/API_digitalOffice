<?php

namespace common\models\bid;

use common\models\directory\BidForm;
use Yii;

/**
 * This is the model class for table "brand_promotion".
 *
 * @property integer $id
 * @property integer $bid_form_id
 * @property string $name
 * @property string $description
 * @property string $img
 * @property string $create_date
 *
 * @property BidForm $bidForm
 */
class BrandPromotion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand_promotion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bid_form_id'], 'required'],
            [['bid_form_id'], 'integer'],
            [['description'], 'string'],
            [['create_date'], 'safe'],
            [['name', 'img'], 'string', 'max' => 255],
            [['bid_form_id'], 'exist', 'skipOnError' => true, 'targetClass' => BidForm::className(), 'targetAttribute' => ['bid_form_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bid_form_id' => 'Bid Form ID',
            'name' => 'Name',
            'description' => 'Description',
            'img' => 'Img',
            'create_date' => 'Create Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBidForm()
    {
        return $this->hasOne(BidForm::className(), ['id' => 'bid_form_id']);
    }
}
