<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\components\WebUser;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\session;
use common\models\LoginForm;

/*
 * Site Controller
*/
class SiteController extends Controller
{
	/**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['index', 'error'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    // 'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
    	if(Yii::$app->user->isGuest) {
    		return $this->redirect(['login']);
        } else {
            return $this->redirect(['admin/site/home']);
        }
    }

    public function actionHome()
    {
    	return $this->redirect('login');
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['admin/site/home']);
        }

		$model->username ="";
		$model->password ="";
		return $this->renderPartial('login', [
			'model' => $model,
		]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['login']);
    }
}