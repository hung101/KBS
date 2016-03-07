<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BspPerlanjutanSebab;

/**
 * BspPerlanjutanSebabSearch represents the model behind the search form about `app\models\BspPerlanjutanSebab`.
 */
class BspPerlanjutanSebabSearch extends BspPerlanjutanSebab
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_perlanjutan_sebab_id', 'bsp_perlanjutan_id'], 'integer'],
            [['sebab', 'session_id'], 'safe'],
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
        $query = BspPerlanjutanSebab::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'bsp_perlanjutan_sebab_id' => $this->bsp_perlanjutan_sebab_id,
            'bsp_perlanjutan_id' => $this->bsp_perlanjutan_id,
        ]);

        $query->andFilterWhere(['like', 'sebab', $this->sebab])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
