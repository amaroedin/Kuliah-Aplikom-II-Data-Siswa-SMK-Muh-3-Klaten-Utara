<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefAsalSekolah;

/**
 * RefAsalSekolahSearch represents the model behind the search form about `common\models\RefAsalSekolah`.
 */
class RefAsalSekolahSearch extends RefAsalSekolah
{
	public $keyword;

	/**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'alamat', 'keyword'], 'safe']
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
    	$query = RefAsalSekolah::find();

    	$dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => array('pageSize' => Yii::$app->params['paging']['pageSize']),
            'sort'=> ['defaultOrder'=>['nama'=>SORT_ASC]]
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

        $query->andFilterWhere(['or',['like', 'nama', $this->keyword],['like', 'alamat', $this->keyword]]);

        return $dataProvider;
    }
}