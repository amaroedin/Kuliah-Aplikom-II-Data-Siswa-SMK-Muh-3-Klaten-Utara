<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%status}}".
 *
 * @property integer $id
 * @property string $nama
 * @property string $grup
 *
 * @property SiswaMutasi[] $siswaMutasis
 * @property SiswaPresensi[] $siswaPresensis
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%status}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'grup'], 'required'],
            [['nama', 'grup'], 'string', 'max' => 16]
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
            'grup' => 'Format= tanpa spasi dan huruf kecil',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiswaMutasis()
    {
        return $this->hasMany(SiswaMutasi::className(), ['id_status' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiswaPresensis()
    {
        return $this->hasMany(SiswaPresensi::className(), ['id_status' => 'id']);
    }
}
