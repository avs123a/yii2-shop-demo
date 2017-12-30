<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\SiteSettings;
use yii\web\UploadedFile;
use backend\models\UploadForm;

/**
 * Site controller
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
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'delete-banner'],
                        'allow' => true,
                        'roles' => ['@'],
						'matchCallback' => function ($rule, $action) {
                         return \common\models\User::isUserAdmin(Yii::$app->user->identity->username);
						}
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
		$user_count = (new \yii\db\Query())->select('id')->from('user')->count();
		$product_count = (new \yii\db\Query())->select('id')->from('product')->count();
		$order_count = (new \yii\db\Query())->select('id')->from('order')->count();
		
		
		$form = new UploadForm();
		
		if(Yii::$app->request->isPost)
		{
			$form->files = UploadedFile::getInstance($form, 'files');
			if($form->files && $form->validate()){
				$form->files->saveAs(SiteSettings::getMainBannerPath());
				Yii::$app->session->addFlash('success', 'You uploaded main banner successfuly');
			}else{
				Yii::$app->session->addFlash('error', 'Banner upload error!!!');
			}
		}
		
        return $this->render('index', [
		'user_count' => $user_count,
		'product_count' => $product_count,
		'order_count' => $order_count,
		'upload_form' => $form,
		]);
    }
	
	public function actionDeleteBanner()
	{
		unlink(SiteSettings::getMainBannerPath());
		//unset(SiteSettings::getMainBannerUrl());
		Yii::$app->session->addFlash('success', 'Main banner was deleted successfuly');
		
		return $this->redirect(['site/index']);
		
	}

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->loginAdmin()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
