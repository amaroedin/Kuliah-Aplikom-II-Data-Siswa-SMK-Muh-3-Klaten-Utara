<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%ref_pendidikan}}".
 *
 * @property integer $id
 * @property string $nama
 *
 * @property OrangtuaWali[] $orangtuaWalis
 * @property OrangtuaWali[] $orangtuaWalis0
 * @property OrangtuaWali[] $orangtuaWalis1
 */
class RefPendidikan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ref_pendidikan}}';
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
            'nama' => 'Nama Pendidikan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrangtuaWalis()
    {
        return $this->hasMany(OrangtuaWali::className(), ['id_ref_pendidikan_ayah' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrangtuaWalis0()
    {
        return $this->hasMany(OrangtuaWali::className(), ['id_ref_pendidikan_ibu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrangtuaWalis1()
    {
        return $this->hasMany(OrangtuaWali::className(), ['id_ref_pendidikan_wali' => 'id']);
    }
}
