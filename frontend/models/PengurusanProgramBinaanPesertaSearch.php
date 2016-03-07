<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanProgramBinaanPeserta;

/**
 * PengurusanProgramBinaanPesertaSearch represents the model behind the search form about `app\models\PengurusanProgramBinaanPeserta`.
 */
class PengurusanProgramBinaanPesertaSearch extends PengurusanProgramBinaanPeserta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_program_binaan_peserta_id', 'pengurusan_program_binaan_id'], 'integer'],
            [['kategori_peserta', 'atlet_id', 'nama_peserta', 'jantina', 'jurulatih_id', 'session_id'], 'safe'],
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
        $query = PengurusanProgramBinaanPeserta::find()
                ->joinWith(['refKategoriPesertaProgramBinaan'])
                ->joinWith(['refAtlet'])
                ->joinWith(['refJurulatih'])
                ->joinWith(['refJantina']);

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
            'pengurusan_program_binaan_peserta_id' => $this->pengurusan_program_binaan_peserta_id,
            'pengurusan_program_binaan_id' => $this->pengurusan_program_binaan_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_kategori_peserta_program_binaan.desc', $this->kategori_peserta])
            ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id])
                ->andFilterWhere(['like', 'tbl_jurulatih.nama', $this->jurulatih_id])
            ->andFilterWhere(['like', 'nama_peserta', $this->nama_peserta])
            ->andFilterWhere(['like', 'tbl_ref_jantina.desc', $this->jantina])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
