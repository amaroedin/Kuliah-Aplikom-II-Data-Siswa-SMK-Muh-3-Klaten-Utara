<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%ref_tahun_ajaran}}".
 *
 * @property integer $id
 * @property string $tanggal_awal
 * @property string $tanggal_akhir
 * @property string $periode
 * @property integer $status
 *
 * @property SiswaMutasi[] $siswaMutasis
 */
class RefTahunAjaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ref_tahun_ajaran}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tanggal_awal', 'tanggal_akhir'], 'required'],
            [['tanggal_awal', 'tanggal_akhir'], 'safe'],
            [['status'], 'integer'],
            [['periode'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tanggal_awal' => 'Tanggal Mulai',
            'tanggal_akhir' => 'Tanggal Selesai',
            'periode' => 'Periode',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiswaMutasis()
    {
        return $this->hasMany(SiswaMutasi::className(), ['id_ref_tahun_ajaran' => 'id']);
    }

    public function beforeSave()
    {
        $this->tanggal_awal     = !Yii::$app->date->valid_tanggal($this->tanggal_awal) ? Yii::$app->date->konversi_tanggal($this->tanggal_awal) : $this->tanggal_awal;
        $this->tanggal_akhir    = !Yii::$app->date->valid_tanggal($this->tanggal_akhir) ? Yii::$app->date->konversi_tanggal($this->tanggal_akhir) : $this->tanggal_akhir;

        return true;
    }
}
