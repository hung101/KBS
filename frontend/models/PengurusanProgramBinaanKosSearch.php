<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanProgramBinaanKos;

/**
 * PengurusanProgramBinaanKosSearch represents the model behind the search form about `app\models\PengurusanProgramBinaanKos`.
 */
class PengurusanProgramBinaanKosSearch extends PengurusanProgramBinaanKos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_program_binaan_kos_id', 'pengurusan_program_binaan_id'], 'integer'],
            [['kategori_kos', 'catatan', 'session_id'], 'safe'],
            [['anggaran_kos_per_kategori', 'revised_kos_per_kategori', 'approved_kos_per_kategori'], 'number'],
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
        $query = PengurusanProgramBinaanKos::find()
                ->joinWith(['refKategoriKosProgramBinaan']);

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
            'pengurusan_program_binaan_kos_id' => $this->pengurusan_program_binaan_kos_id,
            'pengurusan_program_binaan_id' => $this->pengurusan_program_binaan_id,
            'anggaran_kos_per_kategori' => $this->anggaran_kos_per_kategori,
            'revised_kos_per_kategori' => $this->revised_kos_per_kategori,
            'approved_kos_per_kategori' => $this->approved_kos_per_kategori,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_kategori_kos_program_binaan.desc', $this->kategori_kos])
            ->andFilterWhere(['like', 'catatan', $this->catatan])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
