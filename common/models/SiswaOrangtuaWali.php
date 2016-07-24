<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%siswa_orangtua_wali}}".
 *
 * @property integer $id
 * @property string $nama_ayah
 * @property string $tahun_lahir_ayah
 * @property integer $id_ref_pendidikan_ayah
 * @property string $pekerjaan_ayah
 * @property integer $id_ref_penghasilan_ayah
 * @property string $nama_ibu
 * @property string $tahun_lahir_ibu
 * @property integer $id_ref_pendidikan_ibu
 * @property string $pekerjaan_ibu
 * @property integer $id_ref_penghasilan_ibu
 * @property string $nama_wali
 * @property string $tahun_lahir_wali
 * @property integer $id_ref_pendidikan_wali
 * @property string $pekerjaan_wali
 * @property integer $id_ref_penghasilan_wali
 *
 * @property Siswa[] $siswas
 * @property RefPendidikan $idRefPendidikanAyah
 * @property RefPendidikan $idRefPendidikanIbu
 * @property RefPendidikan $idRefPendidikanWali
 * @property RefPenghasilan $idRefPenghasilanAyah
 * @property RefPenghasilan $idRefPenghasilanIbu
 * @property RefPenghasilan $idRefPenghasilanWali
 */
class SiswaOrangtuaWali extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%siswa_orangtua_wali}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_ayah', 'tahun_lahir_ayah', 'id_ref_pendidikan_ayah', 'pekerjaan_ayah', 'id_ref_penghasilan_ayah', 'nama_ibu', 'tahun_lahir_ibu', 'id_ref_pendidikan_ibu', 'pekerjaan_ibu', 'id_ref_penghasilan_ibu'], 'required'],
            [['tahun_lahir_ayah', 'tahun_lahir_ibu', 'tahun_lahir_wali'], 'safe'],
            [['id_ref_pendidikan_ayah', 'id_ref_penghasilan_ayah', 'id_ref_pendidikan_ibu', 'id_ref_penghasilan_ibu', 'id_ref_pendidikan_wali', 'id_ref_penghasilan_wali'], 'integer'],
            [['nama_ayah', 'nama_ibu', 'nama_wali'], 'string', 'max' => 128],
            [['pekerjaan_ayah', 'pekerjaan_ibu', 'pekerjaan_wali'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_ayah' => 'Nama Ayah',
            'tahun_lahir_ayah' => 'Tahun Lahir',
            'id_ref_pendidikan_ayah' => 'Pendidikan',
            'pekerjaan_ayah' => 'Pekerjaan',
            'id_ref_penghasilan_ayah' => 'Penghasilan',
            'nama_ibu' => 'Nama Ibu',
            'tahun_lahir_ibu' => 'Tahun Lahir',
            'id_ref_pendidikan_ibu' => 'Pendidikan',
            'pekerjaan_ibu' => 'Pekerjaan',
            'id_ref_penghasilan_ibu' => 'Penghasilan',
            'nama_wali' => 'Nama Wali',
            'tahun_lahir_wali' => 'Tahun Lahir',
            'id_ref_pendidikan_wali' => 'Pendidikan',
            'pekerjaan_wali' => 'Pekerjaan',
            'id_ref_penghasilan_wali' => 'Penghasilan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiswas()
    {
        return $this->hasMany(Siswa::className(), ['id_orangtua_wali' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRefPendidikanAyah()
    {
        return $this->hasOne(RefPendidikan::className(), ['id' => 'id_ref_pendidikan_ayah']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRefPendidikanIbu()
    {
        return $this->hasOne(RefPendidikan::className(), ['id' => 'id_ref_pendidikan_ibu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRefPendidikanWali()
    {
        return $this->hasOne(RefPendidikan::className(), ['id' => 'id_ref_pendidikan_wali']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRefPenghasilanAyah()
    {
        return $this->hasOne(RefPenghasilan::className(), ['id' => 'id_ref_penghasilan_ayah']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRefPenghasilanIbu()
    {
        return $this->hasOne(RefPenghasilan::className(), ['id' => 'id_ref_penghasilan_ibu']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRefPenghasilanWali()
    {
        return $this->hasOne(RefPenghasilan::className(), ['id' => 'id_ref_penghasilan_wali']);
    }
}
