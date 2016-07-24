<?php
namespace backend\controllers;

use Yii;
use common\models\Kecamatan;
use common\models\Desa;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;
use yii\helpers\Json;

class AjaxController extends Controller
{
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

    public function actionGetkecamatan()
	{
		$out = [];
        if(isset($_POST['depdrop_parents'][0]) && $_POST['depdrop_parents'][0]) {
            $parents = $_POST['depdrop_parents'];
            $kode_kabupaten = $parents[0];
            $out = Kecamatan::getOptionsbyKabupaten($kode_kabupaten);
            if(is_array($out)){
                echo Json::encode(['output' => $out, 'selected' => '']);
            }else{                  
                echo Json::encode(['output' => '', 'selected' => '']);
            }
            return;
        }
        echo Json::encode(['output' => '', 'selected' => null]);
    }

    public function actionGetdesa()
    {
        $out = [];
        if(isset($_POST['depdrop_parents'][0]) && $_POST['depdrop_parents'][0]) {
            $parents = $_POST['depdrop_parents'];
            $kode_kecamatan = $parents[0];
            $out = Desa::getOptionsbyKecamatan($kode_kecamatan);
            if(is_array($out)){
                echo Json::encode(['output' => $out]);
            }else{                  
                echo Json::encode(['output' => '']);
            }
            return;
        }
        echo Json::encode(['output' => '', 'selected' => null]);
	}
}