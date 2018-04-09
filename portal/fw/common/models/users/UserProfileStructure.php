<?php

namespace common\models\users;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "user_profile".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $slug
 * @property string $value
 *
 * @property User $user
 */
class UserProfileStructure extends Model
{
    public $fio;
    public $email;
    public $phone;
    public $photo;

    private $paramSlug = [];


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['fio', 'email'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

}
