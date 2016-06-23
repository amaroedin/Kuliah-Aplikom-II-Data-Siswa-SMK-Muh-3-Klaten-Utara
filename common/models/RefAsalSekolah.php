<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%ref_asal_sekolah}}".
 *
 * @property integer $id
 * @property string $nama
 * @property string $alamat
 *
 * @property Siswa[] $siswas
 */
class RefAsalSekolah extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ref_asal_sekolah}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'alamat'], 'required'],
            [['nama'], 'string', 'max' => 128],
            [['alamat'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama Asal Sekolah',
            'alamat' => 'Alamat',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiswas()
    {
        return $this->hasMany(Siswa::className(), ['id_ref_asal_sekolah' => 'id']);
    }
}
