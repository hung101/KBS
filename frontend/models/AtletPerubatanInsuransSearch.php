<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletPerubatanInsurans;

/**
 * AtletPerubatanInsuransSearch represents the model behind the search form about `app\models\AtletPerubatanInsurans`.
 */
class AtletPerubatanInsuransSearch extends AtletPerubatanInsurans
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['insurans_id', 'atlet_id'], 'integer'],
            [['syarikat_insurans', 'no_polisi_hayat', 'no_polisi_kad_perubatan'], 'safe'],
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
        $query = AtletPerubatanInsurans::find();

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
            'insurans_id' => $this->insurans_id,
            'atlet_id' => $this->atlet_id,
        ]);

        $query->andFilterWhere(['like', 'syarikat_insurans', $this->syarikat_insurans])
            ->andFilterWhere(['like', 'no_polisi_hayat', $this->no_polisi_hayat])
            ->andFilterWhere(['like', 'no_polisi_kad_perubatan', $this->no_polisi_kad_perubatan]);

        return $dataProvider;
    }
}
