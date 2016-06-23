<?php
namespace common\models;


use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefPenghasilan;

/**
 * RefPenghasilanSearch represents the model behind the search form about `common\models\RefPenghasilan`.
 */
class RefPenghasilanSearch extends RefPenghasilan
{
	public $keyword;

	/**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nominal', 'keyword'], 'safe']
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
    	$query = RefPenghasilan::find();

    	$dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => array('pageSize' => Yii::$app->params['paging']['pageSize']),
            'sort'=> ['defaultOrder'=>['nominal'=>SORT_ASC]]
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

        $query->andFilterWhere(['or',['like', 'nominal', $this->keyword]]);

        return $dataProvider;
    }
}