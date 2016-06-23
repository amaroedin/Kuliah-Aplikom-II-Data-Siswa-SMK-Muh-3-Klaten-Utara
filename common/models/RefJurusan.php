<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%ref_jurusan}}".
 *
 * @property integer $id
 * @property string $kode
 * @property string $nama
 *
 * @property RefKelas[] $refKelas
 * @property Siswa[] $siswas
 */
class RefJurusan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ref_jurusan}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode', 'nama'], 'required'],
            ['kode', 'unique', 'message' => 'Maaf, {attribute} sudah digunakan.'],
            ['kode', 'match', 'not' => true, 'pattern' => '/[^a-zA-Z_-]/', 'message' => 'Maaf, {attribute} tidak valid.'],
            [['kode'], 'string', 'max' => 4],
            [['nama'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode Jurusan',
            'nama' => 'Nama Jurusan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKelas()
    {
        return $this->hasMany(RefKelas::className(), ['id_ref_jurusan' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiswas()
    {
        return $this->hasMany(Siswa::className(), ['id_ref_jurusan' => 'id']);
    }
}
