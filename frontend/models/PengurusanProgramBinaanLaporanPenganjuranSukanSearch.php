<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanProgramBinaanLaporanPenganjuranSukan;

/**
 * PengurusanProgramBinaanLaporanPenganjuranSukanSearch represents the model behind the search form about `app\models\PengurusanProgramBinaanLaporanPenganjuranSukan`.
 */
class PengurusanProgramBinaanLaporanPenganjuranSukanSearch extends PengurusanProgramBinaanLaporanPenganjuranSukan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['laporan_penganjuran_sukan_id', 'pengurusan_program_binaan_id', 'sukan_id'], 'integer'],
            [['session_id'], 'safe'],
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
    public function search($params, $id)
    {
        $query = PengurusanProgramBinaanLaporanPenganjuranSukan::find()
                ->joinWith(['refSukan'])->where(['pengurusan_program_binaan_id' => $id]);

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
            'laporan_penganjuran_sukan_id' => $this->laporan_penganjuran_sukan_id,
            'pengurusan_program_binaan_id' => $this->pengurusan_program_binaan_id,
        ]);

        // $query->andFilterWhere(['like', 'tbl_ref_kategori_peserta_program_binaan.desc', $this->kategori_peserta])
            // ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id])
                // ->andFilterWhere(['like', 'tbl_jurulatih.nama', $this->jurulatih_id])
            // ->andFilterWhere(['like', 'nama_peserta', $this->nama_peserta])
            // ->andFilterWhere(['like', 'tbl_ref_jantina.desc', $this->jantina])
        $query->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
