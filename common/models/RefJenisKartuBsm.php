<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%ref_jenis_kartu_bsm}}".
 *
 * @property integer $id
 * @property string $nama
 *
 * @property Siswa[] $siswas
 */
class RefJenisKartuBsm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ref_jenis_kartu_bsm}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
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
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiswas()
    {
        return $this->hasMany(Siswa::className(), ['id_jenis_kartu_bsm' => 'id']);
    }
}
