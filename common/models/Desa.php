<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%desa}}".
 *
 * @property integer $id
 * @property string $kode
 * @property integer $id_kecamatan
 * @property string $nama
 *
 * @property Kecamatan $idKecamatan
 * @property Siswa[] $siswas
 */
class Desa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%desa}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode', 'id_kecamatan', 'nama'], 'required'],
            [['id_kecamatan'], 'integer'],
            [['kode'], 'string', 'max' => 10],
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
            'id_kecamatan' => 'Id Kecamatan',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdKecamatan()
    {
        return $this->hasOne(Kecamatan::className(), ['id' => 'id_kecamatan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiswas()
    {
        return $this->hasMany(Siswa::className(), ['id_desa' => 'id']);
    }
}
