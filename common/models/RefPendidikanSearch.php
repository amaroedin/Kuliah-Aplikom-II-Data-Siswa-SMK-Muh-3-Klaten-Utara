<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefPendidikan;

/**
 * RefPendidikanSearch represents the model behind the search form about `common\models\RefPendidikan`.
 */
class RefPendidikanSearch extends RefPendidikan
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
    	$query = RefPendidikan::find();

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

        $query->andFilterWhere(['or',['like', 'nama', $this->keyword]]);

        return $dataProvider;
    }
}