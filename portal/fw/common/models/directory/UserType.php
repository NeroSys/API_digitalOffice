<?php

namespace common\models\directory;

use Yii;

/**
 * This is the model class for table "user_type".
 *
 * @property integer $id
 * @property integer $departamentId
 * @property string $slug
 * @property string $name
 *
 * @property UserToType[] $userToTypes
 * @property User[] $users
 * @property AuthItem $slug0
 * @property Department $departament
 */
class UserType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['departamentId'], 'required'],
            [['departamentId'], 'integer'],
            [['slug'], 'string', 'max' => 64],
            [['name'], 'string', 'max' => 255],
            [['slug'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItem::className(), 'targetAttribute' => ['slug' => 'name']],
            [['departamentId'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['departamentId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'departamentId' => 'Departament ID',
            'slug' => 'Slug',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserToTypes()
    {
        return $this->hasMany(UserToType::className(), ['type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('user_to_type', ['type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlug0()
    {
        return $this->hasOne(AuthItem::className(), ['name' => 'slug']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartament()
    {
        return $this->hasOne(Department::className(), ['id' => 'departamentId']);
    }
}
