<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletPembangunanKaunseling;

/**
 * AtletPembangunanKaunselingSearch represents the model behind the search form about `app\models\AtletPembangunanKaunseling`.
 */
class AtletPembangunanKaunselingSearch extends AtletPembangunanKaunseling
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kaunseling_id', 'atlet_id'], 'integer'],
            [['tarikh', 'tujuan', 'susulan'], 'safe'],
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
        $query = AtletPembangunanKaunseling::find();

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
            'kaunseling_id' => $this->kaunseling_id,
            'atlet_id' => $this->atlet_id,
            'tarikh' => $this->tarikh,
        ]);

        $query->andFilterWhere(['like', 'tujuan', $this->tujuan])
            ->andFilterWhere(['like', 'susulan', $this->susulan]);

        return $dataProvider;
    }
}
