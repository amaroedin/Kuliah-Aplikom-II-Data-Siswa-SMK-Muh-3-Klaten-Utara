<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%ref_kelas}}".
 *
 * @property integer $id
 * @property integer $id_ref_jurusan
 * @property string $tingkatan
 * @property string $nama
 * @property integer $kapasitas
 * @property integer $nomor_urut
 *
 * @property RefJurusan $idRefJurusan
 * @property SiswaMutasi[] $siswaMutasis
 */
class RefKelas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ref_kelas}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ref_jurusan', 'tingkatan', 'nama', 'kapasitas'], 'required'],
            [['id_ref_jurusan', 'kapasitas', 'nomor_urut'], 'integer'],
            [['tingkatan'], 'string', 'max' => 4],
            [['nama'], 'string', 'max' => 8]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ref_jurusan' => 'Jurusan',
            'tingkatan' => 'Tingkatan',
            'nama' => 'Nama Kelas',
            'kapasitas' => 'Kapasitas',
            'nomor_urut' => 'Nomor Urut',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRefJurusan()
    {
        return $this->hasOne(RefJurusan::className(), ['id' => 'id_ref_jurusan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiswaMutasis()
    {
        return $this->hasMany(SiswaMutasi::className(), ['id_ref_kelas' => 'id']);
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)) {
            $this->nomor_urut = $this->getLastKelasJurusan($this->id_ref_jurusan);
            return true;
        }

        return false;
    }

    public function getLastKelasJurusan($id_ref_jurusan)
    {
        return static::find()->where(['id_ref_jurusan' => $id_ref_jurusan])->count();
    }
}
