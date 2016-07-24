<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%siswa_mutasi}}".
 *
 * @property integer $id
 * @property integer $id_siswa
 * @property integer $id_ref_kelas
 * @property integer $id_ref_tahun_ajaran
 * @property integer $id_status
 * @property string $tanggal_mutasi
 * @property string $keterangan
 * @property string $tanggal_catat
 * @property integer $id_user
 *
 * @property Siswa $idSiswa
 * @property User $idUser
 * @property RefTahunAjaran $idRefTahunAjaran
 * @property RefKelas $idRefKelas
 * @property Status $idStatus
 */
class SiswaMutasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%siswa_mutasi}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_siswa', 'id_ref_kelas', 'id_ref_tahun_ajaran', 'id_status', 'id_user'], 'required'],
            [['id_siswa', 'id_ref_kelas', 'id_ref_tahun_ajaran', 'id_status', 'id_user'], 'integer'],
            [['tanggal_mutasi', 'tanggal_catat'], 'safe'],
            [['keterangan'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_siswa' => 'Id Siswa',
            'id_ref_kelas' => 'Id Ref Kelas',
            'id_ref_tahun_ajaran' => 'Id Ref Tahun Ajaran',
            'id_status' => 'Reference status grup=\"status_siswa\"',
            'tanggal_mutasi' => 'Tanggal Mutasi',
            'keterangan' => 'Keterangan',
            'tanggal_catat' => 'Tanggal Catat',
            'id_user' => 'Id User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSiswa()
    {
        return $this->hasOne(Siswa::className(), ['id' => 'id_siswa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRefTahunAjaran()
    {
        return $this->hasOne(RefTahunAjaran::className(), ['id' => 'id_ref_tahun_ajaran']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRefKelas()
    {
        return $this->hasOne(RefKelas::className(), ['id' => 'id_ref_kelas']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'id_status']);
    }
}
