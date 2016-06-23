<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefTahunAjaran;

/**
 * RefTahunAjaranSearch represents the model behind the search form about `common\models\RefTahunAjaran`.
 */
class RefTahunAjaranSearch extends RefTahunAjaran
{
	public $keyword;

	public function rules()
    {
        return [
            [['tanggal_awal', 'tanggal_akhir', 'keyword'], 'safe']
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
    	$query = RefTahunAjaran::find();

    	$dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => array('pageSize' => Yii::$app->params['paging']['pageSize']),
            'sort'=> ['defaultOrder'=>['periode'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
        	'id' => $this->id
        ]);

        $query->andFilterWhere(['or',['like', 'periode', $this->keyword]]);

        return $dataProvider;
    }
}