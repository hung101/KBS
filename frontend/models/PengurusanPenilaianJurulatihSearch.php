<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanPenilaianJurulatih;

/**
 * PengurusanPenilaianJurulatihSearch represents the model behind the search form about `app\models\PengurusanPenilaianJurulatih`.
 */
class PengurusanPenilaianJurulatihSearch extends PengurusanPenilaianJurulatih
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_penilaian_jurulatih_id', 'pengurusan_pemantauan_dan_penilaian_jurulatih_id'], 'integer'],
            [['penilaian_oleh', 'nama', 'tarikh_dinilai'], 'safe'],
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
        $query = PengurusanPenilaianJurulatih::find();

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
            'pengurusan_penilaian_jurulatih_id' => $this->pengurusan_penilaian_jurulatih_id,
            'pengurusan_pemantauan_dan_penilaian_jurulatih_id' => $this->pengurusan_pemantauan_dan_penilaian_jurulatih_id,
            'tarikh_dinilai' => $this->tarikh_dinilai,
        ]);

        $query->andFilterWhere(['like', 'penilaian_oleh', $this->penilaian_oleh])
            ->andFilterWhere(['like', 'nama', $this->nama]);

        return $dataProvider;
    }
}
