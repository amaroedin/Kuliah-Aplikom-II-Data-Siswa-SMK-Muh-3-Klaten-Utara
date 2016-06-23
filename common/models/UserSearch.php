<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User
{
	public $keyword;

	/**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_grup'], 'integer'],
            [['nama', 'username', 'password_hash', 'password_reset_token', 'keyword', 'auth_key', 'status'], 'safe'],
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
    	$query = User::find();

    	$query->joinWith('idGrup');

    	$dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => array('pageSize' => Yii::$app->params['paging']['pageSize']),
            'sort'=> ['defaultOrder'=>['nama'=>SORT_ASC]]
        ]);

        $dataProvider->sort->attributes['nama_grup'] = [
            'asc' => ['user_grup.nama' => SORT_ASC],
            'desc' => ['user_grup.nama' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
        	'id' => $this->id,
        	'id_grup' => $this->id_grup
        ]);

        $query->andFilterWhere(['or',['like', 'username', $this->keyword],['like', 'user.nama', $this->keyword]]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key]);

        return $dataProvider;
    }
}