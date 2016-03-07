<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BspBorang11;

/**
 * BspBorang11Search represents the model behind the search form about `app\models\BspBorang11`.
 */
class BspBorang11Search extends BspBorang11
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_borang_11_id', 'bsp_borang_borang_id', 'created_by', 'updated_by'], 'integer'],
            [['bsp_11', 'session_id', 'created', 'updated'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = BspBorang11::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'bsp_borang_11_id' => $this->bsp_borang_11_id,
            'bsp_borang_borang_id' => $this->bsp_borang_borang_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'bsp_11', $this->bsp_11])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
