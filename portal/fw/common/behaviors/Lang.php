<?php

namespace bizon\langSwitch\behaviors;

use bizon\langSwitch\models\Language;
use common\models\catalog\Country;
use yii;
use yii\base\Behavior;


use yii\web\Controller;

class Lang extends Behavior {

    public function events(){
        return [Controller::EVENT_BEFORE_ACTION => 'setLang'];
    }

    public function setLang()
    {
        $langSlug = Yii::$app->request->get('langSlug');
        $language = new Language();

        if(empty($langSlug)){
            Yii::$app->params['language'] = $language->getLangBySlug();
//            Yii::$app->response->redirect(yii\helpers\Url::to('/'.Yii::$app->params['language']->code), 302);
        } else {
            Yii::$app->params['language'] = $language->getLangBySlug($langSlug);
        }

        if(!is_null(Yii::$app->params['language'])){
            Yii::$app->language = Yii::$app->params['language']->code;
        } else {
            Yii::$app->response->redirect(yii\helpers\Url::to('/'), 302);
        };


        Yii::$app->params['country'] = Country::find()->where(['default' => true])->one();

    }
}