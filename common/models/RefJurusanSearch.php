<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefJurusan;

/**
 * RefJurusanSearch represents the model behind the search form about `common\models\RefJurusan`.
 */
class RefJurusanSearch extends RefJurusan
{
	public $keyword;

	/**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
    	$query = RefJurusan::find();

    	$dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => array('pageSize' => Yii::$app->params['paging']['pageSize']),
            'sort'=> ['defaultOrder'=>['kode'=>SORT_ASC]]
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

        $query->andFilterWhere(['or',['like', 'nama', $this->keyword]]);

        return $dataProvider;
    }
}