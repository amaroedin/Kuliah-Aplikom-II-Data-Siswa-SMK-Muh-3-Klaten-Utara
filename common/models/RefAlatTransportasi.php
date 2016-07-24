<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%ref_alat_transportasi}}".
 *
 * @property integer $id
 * @property string $nama
 *
 * @property Siswa[] $siswas
 */
class RefAlatTransportasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ref_alat_transportasi}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['nama'], 'string', 'max' => 64]
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
        return $this->hasMany(Siswa::className(), ['id_ref_alat_transportasi' => 'id']);
    }
}
