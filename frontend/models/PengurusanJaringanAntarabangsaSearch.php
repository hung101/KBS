<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanJaringanAntarabangsa;

/**
 * PengurusanJaringanAntarabangsaSearch represents the model behind the search form about `app\models\PengurusanJaringanAntarabangsa`.
 */
class PengurusanJaringanAntarabangsaSearch extends PengurusanJaringanAntarabangsa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_jaringan_antarabangsa_id'], 'integer'],
            [['nama_badan_sukan', 'negara', 'nama_pemohon', 'no_kad_pengenalan', 'jantina', 'alamat_surat_menyurat_1', 'alamat_surat_menyurat_2', 'alamat_surat_menyurat_3', 'alamat_surat_menyurat_negeri', 'alamat_surat_menyurat_bandar', 'alamat_surat_menyurat_poskod', 'pegawai_teknikal', 'permohonan', 'jenis_program', 'no_telefon', 'no_tel_bimbit', 'no_faks', 'emel', 'nama_majikan', 'alamat_majikan_1', 'alamat_majikan_2', 'alamat_majikan_3', 'alamat_majikan_negeri', 'alamat_majikan_bandar', 'alamat_majikan_poskod', 'jawatan_di_persatuan', 'tahap_kelayakan_sekarang'], 'safe'],
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
        $query = PengurusanJaringanAntarabangsa::find()
                ->joinWith(['refNegara'])
                ->joinWith(['refPemohonJaringanAntarabangsa']);

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
            'pengurusan_jaringan_antarabangsa_id' => $this->pengurusan_jaringan_antarabangsa_id,
        ]);

        $query->andFilterWhere(['like', 'nama_badan_sukan', $this->nama_badan_sukan])
            ->andFilterWhere(['like', 'tbl_ref_negara.desc', $this->negara])
            ->andFilterWhere(['like', 'tbl_ref_pemohon_jaringan_antarabangsa.desc', $this->nama_pemohon])
            ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
            ->andFilterWhere(['like', 'jantina', $this->jantina])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_1', $this->alamat_surat_menyurat_1])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_2', $this->alamat_surat_menyurat_2])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_3', $this->alamat_surat_menyurat_3])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_negeri', $this->alamat_surat_menyurat_negeri])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_bandar', $this->alamat_surat_menyurat_bandar])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_poskod', $this->alamat_surat_menyurat_poskod])
            ->andFilterWhere(['like', 'pegawai_teknikal', $this->pegawai_teknikal])
            ->andFilterWhere(['like', 'permohonan', $this->permohonan])
            ->andFilterWhere(['like', 'jenis_program', $this->jenis_program])
            ->andFilterWhere(['like', 'no_telefon', $this->no_telefon])
            ->andFilterWhere(['like', 'no_tel_bimbit', $this->no_tel_bimbit])
            ->andFilterWhere(['like', 'no_faks', $this->no_faks])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'nama_majikan', $this->nama_majikan])
            ->andFilterWhere(['like', 'alamat_majikan_1', $this->alamat_majikan_1])
            ->andFilterWhere(['like', 'alamat_majikan_2', $this->alamat_majikan_2])
            ->andFilterWhere(['like', 'alamat_majikan_3', $this->alamat_majikan_3])
            ->andFilterWhere(['like', 'alamat_majikan_negeri', $this->alamat_majikan_negeri])
            ->andFilterWhere(['like', 'alamat_majikan_bandar', $this->alamat_majikan_bandar])
            ->andFilterWhere(['like', 'alamat_majikan_poskod', $this->alamat_majikan_poskod])
            ->andFilterWhere(['like', 'jawatan_di_persatuan', $this->jawatan_di_persatuan])
            ->andFilterWhere(['like', 'tahap_kelayakan_sekarang', $this->tahap_kelayakan_sekarang]);

        return $dataProvider;
    }
}
