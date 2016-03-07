<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BspBorang10;

/**
 * BspBorang10Search represents the model behind the search form about `app\models\BspBorang10`.
 */
class BspBorang10Search extends BspBorang10
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_borang_10_id', 'bsp_borang_borang_id', 'created_by', 'updated_by'], 'integer'],
            [['bsp_10', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = BspBorang10::find();

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
            'bsp_borang_10_id' => $this->bsp_borang_10_id,
            'bsp_borang_borang_id' => $this->bsp_borang_borang_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'bsp_10', $this->bsp_10])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
