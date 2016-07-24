<?php
namespace backend\controllers;

use Yii;
use common\models\Siswa;
use common\models\SiswaSearch;
use common\models\SiswaOrangtuaWali;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Security;
use yii\web\Session;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;
use yii\filters\AccessControl;

/**
 * SiswaController implements the CRUD actions for Siswa model.
 */
class SiswaController extends Controller
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
        
        Yii::$app->params['current_menu'] = '<i class="fa fa-graduation-cap"></i> Data Akademik';
        $this->addBreadCrumb('Data Akademik', '#');
        $this->addBreadCrumb('Siswa', $this->controller_id);
    }
    
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
    	Yii::$app->session[$this->query_string] = Yii::$app->request->getQueryString();
        
        if(isset($_POST['SiswaSearch'])){
            Yii::$app->session[$this->ses_keyword] = $_POST;
        }
        
        $searchModel = new SiswaSearch;
        $dataProvider = $searchModel->search(Yii::$app->session[$this->ses_keyword]);
        
        $data['searchModel'] = $searchModel;
        $data['dataProvider'] = $dataProvider;

        return $this->render('index', $data);
    }

    public function actionCreate()
    {
    	$this->addBreadCrumb('Form Siswa', '#');
        $back_url  = $this->getBackUrl();

        $model = new Siswa();
        $modelOrtu = new SiswaOrangtuaWali();
        // $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = 'json';
                return \yii\bootstrap\ActiveForm::validate($model);
            }

            $modelOrtu->attributes = $_POST['SiswaOrangtuaWali'];
            if($modelOrtu->save()) {
                $model->id_user             = Yii::$app->user->identity->id;
                $model->id_orangtua_wali    = $modelOrtu->id;
                $model->attributes          = $_POST['Siswa'];

                if($model->save()){
                    Yii::$app->session->setFlash('noticeSuccess', 'Data berhasil disimpan');
                    unset(Yii::$app->session['keyword_' . $this->controller_id]);
                    return $this->redirect([$this->controller_id.'/index?sort=-id']);
                }   
            }
        }

        $data['model'] = $model;
        $data['modelOrtu'] = $modelOrtu;
        $data['back_url'] = $back_url;
        
        return $this->render('form', $data);
    }

    public function actionUpdate($id)
    {
    	$this->addBreadCrumb('Form Siswa', '#');
        $back_url  = $this->getBackUrl();

        $model = $this->findModel($id);
        $modelOrtu = $this->findModelOrtu($model->id_orangtua_wali);

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
        $data['modelOrtu'] = $modelOrtu;
        $data['back_url'] = $back_url;
        
        return $this->render('form', $data);
    }

    protected function findModel($id)
    {
        if (($model = Siswa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Halaman tidak ditemukan');
        }
    }

    protected function findModelOrtu($id)
    {
        if (($model = SiswaOrangtuaWali::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Halaman tidak ditemukan');
        }
    }
}