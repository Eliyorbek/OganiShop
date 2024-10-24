<?php

namespace frontend\controllers;

use common\models\User;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class AdminRegister
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup' , 'register'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionRegister(){
        $model = new User([
            'username'=>'eliyorbek',
            'email'=>'eliyorbek@gmail.com',
            'password'=>\Yii::$app->security->generatePasswordHash('00000000'),
            'status'=>User::STATUS_ACTIVE,
        ]);
        $model->save();
        return $model;
    }

}