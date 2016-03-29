<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PlDiagnosisPreskripsiPemeriksaanRehabilitasi;

/**
 * PlDiagnosisPreskripsiPemeriksaanRehabilitasiSearch represents the model behind the search form about `app\models\PlDiagnosisPreskripsiPemeriksaanRehabilitasi`.
 */
class PlDiagnosisPreskripsiPemeriksaanRehabilitasiSearch extends PlDiagnosisPreskripsiPemeriksaanRehabilitasi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pl_diagnosis_preskripsi_pemeriksaan_id', 'pl_temujanji_id'], 'integer'],
            [['jenis_diagnosis_preskripsi_pemeriksaan', 'status_diagnosis_preskripsi_pemeriksaan', 'catitan_ringkas', 'session_id', 'bahagian_kecederaan', 'rawatan_rehabilitasi'], 'safe'],
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
        $query = PlDiagnosisPreskripsiPemeriksaanRehabilitasi::find()
                ->joinWith(['refJenisKecederaanMasalahKesihatan'])
                ->joinWith(['refStatusDiagnosisPreskripsiPemeriksaanPenyiasatan'])
                ->joinWith(['refBahagianKecederaan'])
                ->joinWith(['refRawatanRehabilitasi']);

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
            'pl_diagnosis_preskripsi_pemeriksaan_id' => $this->pl_diagnosis_preskripsi_pemeriksaan_id,
            'pl_temujanji_id' => $this->pl_temujanji_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_jenis_kecederaan_masalah_kesihatan.desc', $this->jenis_diagnosis_preskripsi_pemeriksaan])
            ->andFilterWhere(['like', 'tbl_ref_status_diagnosis_preskripsi_pemeriksaan_penyiasatan.desc', $this->status_diagnosis_preskripsi_pemeriksaan])
                ->andFilterWhere(['like', 'tbl_ref_bahagian_kecederaan.desc', $this->bahagian_kecederaan])
                ->andFilterWhere(['like', 'tbl_ref_rawatan_rehabilitasi.desc', $this->rawatan_rehabilitasi])
            ->andFilterWhere(['like', 'catitan_ringkas', $this->catitan_ringkas])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
