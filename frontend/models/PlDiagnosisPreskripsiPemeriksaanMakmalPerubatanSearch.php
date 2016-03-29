<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PlDiagnosisPreskripsiPemeriksaanMakmalPerubatan;

/**
 * PlDiagnosisPreskripsiPemeriksaanMakmalPerubatanSearch represents the model behind the search form about `app\models\PlDiagnosisPreskripsiPemeriksaanMakmalPerubatan`.
 */
class PlDiagnosisPreskripsiPemeriksaanMakmalPerubatanSearch extends PlDiagnosisPreskripsiPemeriksaanMakmalPerubatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pl_diagnosis_preskripsi_pemeriksaan_id', 'pl_temujanji_id'], 'integer'],
            [['jenis_diagnosis_preskripsi_pemeriksaan', 'status_diagnosis_preskripsi_pemeriksaan', 'catitan_ringkas', 'session_id'], 'safe'],
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
        $query = PlDiagnosisPreskripsiPemeriksaanMakmalPerubatan::find()
                ->joinWith(['refJenisKecederaanMasalahKesihatan'])
                ->joinWith(['refStatusDiagnosisPreskripsiPemeriksaanPenyiasatan']);

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
            ->andFilterWhere(['like', 'catitan_ringkas', $this->catitan_ringkas])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
