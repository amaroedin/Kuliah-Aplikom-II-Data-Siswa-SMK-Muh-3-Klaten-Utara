<?php
namespace common\components;

class WebUser extends \yii\web\User {
	
	public function getIdGrup($kode){
		switch($kode){
			case 'Admin' 			: $hasil = 1;
				break;
		}
		return $hasil;
	}
	
	public function isAdmin(){
		return($this->identity->id_grup == $this->getIdGrup('Admin'));
	}

}