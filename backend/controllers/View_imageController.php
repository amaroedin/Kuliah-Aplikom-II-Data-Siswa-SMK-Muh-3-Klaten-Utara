<?php
namespace backend\controllers;
ini_set("gd.jpeg_ignore_warning", 1);

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class View_imageController extends Controller
{
    public function actionResize($width=150,$height=150,$id_file=''){    	
		Yii::$app->resizeimage->imgFileName = Yii::$app->params['folder_upload'].$id_file.'.web';
		Yii::$app->resizeimage->ReadImageFile();
		Yii::$app->resizeimage->Resize($width,$height, false);
		Yii::$app->resizeimage->ApplyFrame();
		header("Content-type: image/jpeg");
		Yii::$app->resizeimage->Show();
		Yii::$app->resizeimage->Destroy();
	}	

	public function actionView($id_file='', $filename=''){ 
		$path = pathinfo($filename);   	
		$content = file_get_contents(Yii::$app->params['folder_upload'].$id_file.'.web');
		header("Content-type: image/{$path['extension']}");
		echo($content);
	}	
}


