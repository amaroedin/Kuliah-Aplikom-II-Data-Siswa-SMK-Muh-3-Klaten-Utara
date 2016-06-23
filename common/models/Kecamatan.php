<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%kecamatan}}".
 *
 * @property integer $id
 * @property string $kode
 * @property integer $id_kabupaten
 * @property string $nama
 *
 * @property Desa[] $desas
 * @property Kabupaten $idKabupaten
 */
class Kecamatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%kecamatan}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode', 'id_kabupaten', 'nama'], 'required'],
            [['id_kabupaten'], 'integer'],
            [['kode'], 'string', 'max' => 7],
            [['nama'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode',
            'id_kabupaten' => 'Id Kabupaten',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesas()
    {
        return $this->hasMany(Desa::className(), ['id_kecamatan' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdKabupaten()
    {
        return $this->hasOne(Kabupaten::className(), ['id' => 'id_kabupaten']);
    }

    public function getOptionsbyKabupaten($id_kabupaten)
    {
        $data = parent::find()->where(['id_kabupaten' => $id_kabupaten])->select(['id', 'nama as name'])->asArray()->all();
        $value = (count($data) == 0) ? '' : $data;

        return $value;
    }
}
