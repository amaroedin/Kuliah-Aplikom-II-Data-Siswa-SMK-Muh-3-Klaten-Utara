<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Siswa;
use common\models\RefAgama;
use common\models\RefJurusan;

/**
 * SiswaSearch represents the model behind the search form about `common\models\Siswa`.
 */
class SiswaSearch extends Siswa
{
	public $keyword;

	/**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jenis_kelamin', 'golongan_darah', 'status_kps'], 'string'],
            [['id_ref_agama', 'id_desa', 'id_ref_asal_sekolah', 'jumlah_saudara', 'id_orangtua_wali', 'id_ref_jurusan', 'id_user'], 'integer'],
            [['nis', 'nama', 'keyword'], 'safe'],
            [['tinggi_badan', 'berat_badan'], 'number']
        ];
    }

	/**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
    	$query = Siswa::find();
    	$query->joinWith('idRefAgama');
    	$query->joinWith('idRefJurusan');

    	$dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => array('pageSize' => Yii::$app->params['paging']['pageSize']),
            'sort'=> ['defaultOrder'=>['nama'=>SORT_ASC]]
        ]);

        $dataProvider->sort->attributes['agama'] = [
            'asc' => ['ref_agama.nama' => SORT_ASC],
            'desc' => ['ref_agama.nama' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['jurusan'] = [
            'asc' => ['ref_jurusan.nama' => SORT_ASC],
            'desc' => ['ref_jurusan.nama' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
        	'id' => $this->id
        ]);

        $query->andFilterWhere(['or',['like', 'nama', $this->keyword], ['like', 'nis', $this->keyword]]);

        return $dataProvider;
    }
}