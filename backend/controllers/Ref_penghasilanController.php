<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Security;
use yii\web\Session;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;
use yii\filters\AccessControl;
use common\models\RefPenghasilan;
use common\models\RefPenghasilanSearch;

/**
 * Ref_penghasilanController implements the CRUD actions for RefPenghasilan model.
 */
class Ref_penghasilanController extends Controller
{
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['create','update','delete','index'],
                'rules' => [
                    [
                        'actions' => ['create','update','delete','index'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
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

    public function init(){
        parent::init();
        
        Yii::$app->params['current_menu'] = '<i class="fa fa-cubes"></i> Penghasilan Orang Tua';
        $this->addBreadCrumb('Pengaturan', '#');
        $this->addBreadCrumb('Penghasilan Orang Tua', $this->controller_id);
    }

    public function actionIndex()
    {
        Yii::$app->session[$this->query_string] = Yii::$app->request->getQueryString();
        
        if(isset($_POST['RefPenghasilanSearch'])){
            Yii::$app->session[$this->ses_keyword] = $_POST;
        }
        
        $searchModel = new RefPenghasilanSearch;
        $dataProvider = $searchModel->search(Yii::$app->session[$this->ses_keyword]);
        
        $data['searchModel'] = $searchModel;
        $data['dataProvider'] = $dataProvider;

        return $this->render('index', $data);
    }

    public function actionCreate()
    {
    	$this->addBreadCrumb('Tambah Penghasilan Orang Tua', '#');
        $back_url  = $this->getBackUrl();

        $model = new RefPenghasilan();

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = 'json';
                return \yii\bootstrap\ActiveForm::validate($model);
            }

            if($model->save()){
                Yii::$app->session->setFlash('noticeSuccess', 'Data berhasil disimpan');
                unset(Yii::$app->session['keyword_' . $this->controller_id]);
                return $this->redirect([$this->controller_id.'/index?sort=-id']);
            }
        }

        $data['model'] = $model;
        $data['back_url'] = $back_url;
        
        return $this->render('form', $data);
    }

    public function actionUpdate($id)
    {
    	$this->addBreadCrumb('Edit Penghasilan Orang Tua', '#');
    	$back_url = $this->getBackUrl();

    	$model = $this->findModel($id);

    	if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = 'json';
                return \yii\bootstrap\ActiveForm::validate($model);
            }

            if($model->save()){
                Yii::$app->session->setFlash('noticeSuccess', 'Data berhasil disimpan');
    			return $this->redirect([$back_url]);
            }
        }

    	$data['model'] = $model;
    	$data['back_url'] = $back_url;

    	return $this->render('form', $data);
    }

    protected function findModel($id)
    {
    	if(($model = RefPenghasilan::findOne($id)) !== null) {
    		return $model;
    	}else{
    		throw new NotFoundHttpException('Halaman tidak ditemukan');
    	}
    }
}