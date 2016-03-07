<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanPemantauanDanPenilaianJurulatih;

/**
 * PengurusanPemantauanDanPenilaianJurulatihSearch represents the model behind the search form about `app\models\PengurusanPemantauanDanPenilaianJurulatih`.
 */
class PengurusanPemantauanDanPenilaianJurulatihSearch extends PengurusanPemantauanDanPenilaianJurulatih
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_pemantauan_dan_penilaian_jurulatih_id'], 'integer'],
            [['nama_jurulatih_dinilai', 'nama_sukan', 'nama_acara', 'pusat_latihan'], 'safe'],
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
        $query = PengurusanPemantauanDanPenilaianJurulatih::find()
                ->joinWith(['refJurulatih'])
                ->joinWith(['refSukan'])
                ->joinWith(['refAcara']);

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
            'pengurusan_pemantauan_dan_penilaian_jurulatih_id' => $this->pengurusan_pemantauan_dan_penilaian_jurulatih_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_jurulatih.nama', $this->nama_jurulatih_dinilai])
            ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->nama_sukan])
            ->andFilterWhere(['like', 'tbl_ref_acara.desc', $this->nama_acara])
            ->andFilterWhere(['like', 'pusat_latihan', $this->pusat_latihan]);

        return $dataProvider;
    }
}
