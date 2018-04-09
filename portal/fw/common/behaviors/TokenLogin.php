<?php

namespace common\behaviors;

use bizon\langSwitch\models\Language;
use common\models\catalog\Country;
use common\models\User;
use yii;
use yii\base\Behavior;


use yii\web\Controller;

class TokenLogin extends Behavior {

    public function events(){
        return [Controller::EVENT_BEFORE_ACTION => 'tokenAuth'];
    }

    public function tokenAuth()
    {
        $user = User::findIdentityByAccessToken(Yii::$app->request->get('token'));


        if(!empty($user)){
            Yii::$app->user->identity = $user;
        }

    }
}