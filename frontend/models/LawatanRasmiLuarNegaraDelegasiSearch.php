<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LawatanRasmiLuarNegaraDelegasi;

/**
 * LawatanRasmiLuarNegaraDelegasiSearch represents the model behind the search form about `app\models\LawatanRasmiLuarNegaraDelegasi`.
 */
class LawatanRasmiLuarNegaraDelegasiSearch extends LawatanRasmiLuarNegaraDelegasi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lawatan_rasmi_luar_negara_delegasi_id', 'lawatan_rasmi_luar_negara_id', 'created_by', 'updated_by'], 'integer'],
            [['delegasi', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = LawatanRasmiLuarNegaraDelegasi::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'lawatan_rasmi_luar_negara_delegasi_id' => $this->lawatan_rasmi_luar_negara_delegasi_id,
            'lawatan_rasmi_luar_negara_id' => $this->lawatan_rasmi_luar_negara_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'delegasi', $this->delegasi])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
