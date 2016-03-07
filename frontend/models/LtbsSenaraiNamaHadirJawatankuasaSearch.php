<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LtbsSenaraiNamaHadirJawatankuasa;

/**
 * LtbsSenaraiNamaHadirJawatankuasaSearch represents the model behind the search form about `app\models\LtbsSenaraiNamaHadirJawatankuasa`.
 */
class LtbsSenaraiNamaHadirJawatankuasaSearch extends LtbsSenaraiNamaHadirJawatankuasa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['senarai_nama_hadi_id', 'mesyuarat_id', 'kehadiran'], 'integer'],
            [['nama_penuh', 'no_kad_pengenalan', 'jawatan', 'jantina', 'kategori_keahlian', 'session_id'], 'safe'],
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
        $query = LtbsSenaraiNamaHadirJawatankuasa::find();

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
            'senarai_nama_hadi_id' => $this->senarai_nama_hadi_id,
            'mesyuarat_id' => $this->mesyuarat_id,
            'kehadiran' => $this->kehadiran,
        ]);

        $query->andFilterWhere(['like', 'nama_penuh', $this->nama_penuh])
                ->andFilterWhere(['like', 'jawatan', $this->jawatan])
            ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
            ->andFilterWhere(['like', 'jantina', $this->jantina])
            ->andFilterWhere(['like', 'kategori_keahlian', $this->kategori_keahlian])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
