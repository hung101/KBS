<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PeningkatanKerjayaJurulatih;

/**
 * PeningkatanKerjayaJurulatihSearch represents the model behind the search form about `app\models\PeningkatanKerjayaJurulatih`.
 */
class PeningkatanKerjayaJurulatihSearch extends PeningkatanKerjayaJurulatih
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['peningkatan_kerjaya_jurulatih_id'], 'integer'],
            [['nama_jurulatih', 'cawangan', 'sub_cawangan', 'program_msn', 'lain_lain_program', 'pusat_latihan', 'nama_sukan', 'nama_acara'], 'safe'],
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
        $query = PeningkatanKerjayaJurulatih::find();

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
            'peningkatan_kerjaya_jurulatih_id' => $this->peningkatan_kerjaya_jurulatih_id,
        ]);

        $query->andFilterWhere(['like', 'nama_jurulatih', $this->nama_jurulatih])
            ->andFilterWhere(['like', 'cawangan', $this->cawangan])
            ->andFilterWhere(['like', 'sub_cawangan', $this->sub_cawangan])
            ->andFilterWhere(['like', 'program_msn', $this->program_msn])
            ->andFilterWhere(['like', 'lain_lain_program', $this->lain_lain_program])
            ->andFilterWhere(['like', 'pusat_latihan', $this->pusat_latihan])
            ->andFilterWhere(['like', 'nama_sukan', $this->nama_sukan])
            ->andFilterWhere(['like', 'nama_acara', $this->nama_acara]);

        return $dataProvider;
    }
}
