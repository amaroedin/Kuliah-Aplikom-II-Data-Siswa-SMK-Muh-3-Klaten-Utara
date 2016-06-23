<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefKelas;

/**
 * RefKelasSearch represents the model behind the search form about `common\models\RefKelas`.
 */
class RefKelasSearch extends RefKelas
{
	public $keyword;

	/**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ref_jurusan', 'nomor_urut'], 'integer'],
            [['nama', 'keyword'], 'safe']
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
    	$query = RefKelas::find();
    	$query->joinWith('idRefJurusan');

    	$dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => array('pageSize' => Yii::$app->params['paging']['pageSize']),
            'sort'=> ['defaultOrder'=>['nama'=>SORT_ASC]]
        ]);

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
        	'ref_kelas.id' => $this->id,
        	'ref_kelas.id_ref_jurusan' => $this->id_ref_jurusan,
        	'ref_kelas.tingkatan' => $this->tingkatan
        ]);

        $query->andFilterWhere(['or',['like', 'ref_kelas.nama', $this->keyword]]);

        return $dataProvider;
    }
}