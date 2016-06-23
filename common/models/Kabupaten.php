<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%kabupaten}}".
 *
 * @property integer $id
 * @property string $kode
 * @property integer $id_provinsi
 * @property string $nama
 *
 * @property Provinsi $idProvinsi
 * @property Kecamatan[] $kecamatans
 */
class Kabupaten extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%kabupaten}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode', 'id_provinsi', 'nama'], 'required'],
            [['id_provinsi'], 'integer'],
            [['kode'], 'string', 'max' => 4],
            [['nama'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode',
            'id_provinsi' => 'Id Provinsi',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProvinsi()
    {
        return $this->hasOne(Provinsi::className(), ['id' => 'id_provinsi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKecamatans()
    {
        return $this->hasMany(Kecamatan::className(), ['id_kabupaten' => 'id']);
    }
}
