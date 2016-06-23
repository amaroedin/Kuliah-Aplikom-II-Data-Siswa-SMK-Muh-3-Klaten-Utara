<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%ref_penghasilan}}".
 *
 * @property integer $id
 * @property string $nominal
 *
 * @property OrangtuaWali[] $orangtuaWalis
 * @property OrangtuaWali[] $orangtuaWalis0
 * @property OrangtuaWali[] $orangtuaWalis1
 */
class RefPenghasilan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ref_penghasilan}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nominal'], 'required'],
            [['nominal'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nominal' => 'Nominal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrangtuaWalis()
    {
        return $this->hasMany(OrangtuaWali::className(), ['id_ref_penghasilan_ayah' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrangtuaWalis0()
    {
        return $this->hasMany(OrangtuaWali::className(), ['id_ref_penghasilan_ibu' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrangtuaWalis1()
    {
        return $this->hasMany(OrangtuaWali::className(), ['id_ref_penghasilan_wali' => 'id']);
    }
}
