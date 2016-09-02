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
use common\models\RefKelas;
use common\models\RefKelasSearch;

/**
 * Ref_kelasController implements the CRUD actions for RefKelas model.
 */
class Ref_kelasController extends Controller
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
        
        Yii::$app->params['current_menu'] = '<i class="fa fa-gears"></i> Kelas';
        $this->addBreadCrumb('Pengaturan', '#');
        $this->addBreadCrumb('Kelas', $this->controller_id);
    }

    public function actionIndex()
    {
        Yii::$app->session[$this->query_string] = Yii::$app->request->getQueryString();
        
        if(isset($_POST['RefKelasSearch'])){
            Yii::$app->session[$this->ses_keyword] = $_POST;
        }
        
        $searchModel = new RefKelasSearch;
        $dataProvider = $searchModel->search(Yii::$app->session[$this->ses_keyword]);
        
        $data['searchModel'] = $searchModel;
        $data['dataProvider'] = $dataProvider;

        return $this->render('index', $data);
    }

    public function actionCreate()
    {
        $this->addBreadCrumb('Form Kelas', '#');
        $back_url  = $this->getBackUrl();

        $model = new RefKelas();

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
        $this->addBreadCrumb('Form Kelas', '#');
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
        if(($model = RefKelas::findOne($id)) !== null) {
            return $model;
        }else{
            throw new NotFoundHttpException('Halaman tidak ditemukan');
        }
    }
}