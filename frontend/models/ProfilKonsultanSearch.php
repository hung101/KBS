<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProfilKonsultan;

/**
 * ProfilKonsultanSearch represents the model behind the search form about `app\models\ProfilKonsultan`.
 */
class ProfilKonsultanSearch extends ProfilKonsultan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profil_konsultan_id'], 'integer'],
            [['nama_konsultan', 'ic_no', 'emel', 'no_bimbit', 'bidang_konsultansi', 'agensi', 'no_kaunselor_berdaftar'], 'safe'],
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
        $query = ProfilKonsultan::find();

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
            'profil_konsultan_id' => $this->profil_konsultan_id,
        ]);

        $query->andFilterWhere(['like', 'nama_konsultan', $this->nama_konsultan])
            ->andFilterWhere(['like', 'ic_no', $this->ic_no])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'no_bimbit', $this->no_bimbit])
            ->andFilterWhere(['like', 'bidang_konsultansi', $this->bidang_konsultansi])
                ->andFilterWhere(['like', 'agensi', $this->agensi])
                ->andFilterWhere(['like', 'no_kaunselor_berdaftar', $this->no_kaunselor_berdaftar]);

        return $dataProvider;
    }
}
