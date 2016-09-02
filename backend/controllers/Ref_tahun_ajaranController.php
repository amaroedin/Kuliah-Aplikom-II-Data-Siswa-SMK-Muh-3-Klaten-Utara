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
use common\models\RefTahunAjaran;
use common\models\RefTahunAjaranSearch;

/**
 * Ref_tahun_ajaranController implements the CRUD actions for User model.
 */
class Ref_tahun_ajaranController extends Controller
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
        
        Yii::$app->params['current_menu'] = '<i class="fa fa-gears"></i> Tahun Ajaran';
        $this->addBreadCrumb('Pengaturan', '#');
        $this->addBreadCrumb('Tahun Ajaran', $this->controller_id);
    }
    
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
    	Yii::$app->session[$this->query_string] = Yii::$app->request->getQueryString();
        
        if(isset($_POST['RefTahunAjaranSearch'])){
            Yii::$app->session[$this->ses_keyword] = $_POST;
        }

        $searchModel = new RefTahunAjaranSearch;
        $dataProvider = $searchModel->search(Yii::$app->session[$this->ses_keyword]);
        
        $data['searchModel'] = $searchModel;
        $data['dataProvider'] = $dataProvider;

        return $this->render('index', $data);
    }

    public function actionCreate()
    {
        $this->addBreadCrumb('Form Tahun Ajaran', '#');
        $back_url  = $this->getBackUrl();

        $model = new RefTahunAjaran();

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
        $this->addBreadCrumb('Form Tahun Ajaran', '#');
        $back_url  = $this->getBackUrl();

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
        if(($model = RefTahunAjaran::findOne($id)) !== null) {
            return $model;
        }else{
            throw new NotFoundHttpException('Halaman tidak ditemukan');
        }
    }
}