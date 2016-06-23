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
use common\models\RefJurusan;
use common\models\RefJurusanSearch;

/**
 * Ref_jurusanController implements the CRUD actions for RefJurusan model.
 */
class Ref_jurusanController extends Controller
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
        
        Yii::$app->params['current_menu'] = '<i class="fa fa-cubes"></i> Jurusan';
        $this->addBreadCrumb('Pengaturan', '#');
        $this->addBreadCrumb('Jurusan', $this->controller_id);
    }

    public function actionIndex()
    {
        Yii::$app->session[$this->query_string] = Yii::$app->request->getQueryString();
        
        if(isset($_POST['RefJurusanSearch'])){
            Yii::$app->session[$this->ses_keyword] = $_POST;
        }
        
        $searchModel = new RefJurusanSearch;
        $dataProvider = $searchModel->search(Yii::$app->session[$this->ses_keyword]);
        
        $data['searchModel'] = $searchModel;
        $data['dataProvider'] = $dataProvider;

        return $this->render('index', $data);
    }

    public function actionCreate()
    {
    	$this->addBreadCrumb('Tambah Jurusan', '#');
        $back_url  = $this->getBackUrl();

        $model = new RefJurusan();

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
    	$this->addBreadCrumb('Edit Jurusan', '#');
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
    	if(($model = RefJurusan::findOne($id)) !== null) {
    		return $model;
    	}else{
    		throw new NotFoundHttpException('Halaman tidak ditemukan');
    	}
    }
}