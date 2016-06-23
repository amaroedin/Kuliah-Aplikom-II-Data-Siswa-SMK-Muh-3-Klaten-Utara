<?php
namespace backend\controllers;

use Yii;
use common\models\Kecamatan;
use common\models\Desa;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;

class AjaxController extends Controller
{
	public function getKecamatan()
	{
		$out = [];
        if(isset($_POST['depdrop_parents'][0]) && $_POST['depdrop_parents'][0]) {
            $parents = $_POST['depdrop_parents'];
                $id_kabupaten = $parents[0];
                $out = Kecamatan::getOptionsbyKabupaten($id_kabupaten);
                if(is_array($out)){
                    echo Json::encode(['output' => $out, 'selected' => '']);
                }else{                  
                    echo Json::encode(['output' => '', 'selected' => '']);
                }
                return;
        }
        echo Json::encode(['output' => '', 'selected' => '']);
	}

	public function getDesa()
	{
	}
}