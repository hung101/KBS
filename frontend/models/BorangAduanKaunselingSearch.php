<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BorangAduanKaunseling;

/**
 * BorangAduanKaunselingSearch represents the model behind the search form about `app\models\BorangAduanKaunseling`.
 */
class BorangAduanKaunselingSearch extends BorangAduanKaunseling
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['borang_aduan_kaunseling_id'], 'integer'],
            [['nama_pengadu', 'tarikh_aduan', 'no_aduan', 'status_aduan', 'aduan_kategori', 'penyataan_aduan', 'tindakan_yang_telah_diambil', 'dokumen_berkaitan_yang_dilampirkan', 'bantuan_yang_anda_perlukan', 'rujukan_aduan_kepada_cawangan_yang_berkaitan', 'rujuk_aduan_kepada_atlet', 'tiada_sebarang_tindakan', 'maklumbalas_kepada_pengadu', 'tindakan_susulan', 'aduan_dimajukan_kepada_agensi_lain', 'catatan'], 'safe'],
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
        $query = BorangAduanKaunseling::find()
                ->joinWith(['atlet'])
                ->joinWith(['refStatusAduan']);

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
            'borang_aduan_kaunseling_id' => $this->borang_aduan_kaunseling_id,
            'tarikh_aduan' => $this->tarikh_aduan,
        ]);

        $query->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->nama_pengadu])
            ->andFilterWhere(['like', 'no_aduan', $this->no_aduan])
            ->andFilterWhere(['like', 'tbl_ref_status_aduan.desc', $this->status_aduan])
            ->andFilterWhere(['like', 'aduan_kategori', $this->aduan_kategori])
            ->andFilterWhere(['like', 'penyataan_aduan', $this->penyataan_aduan])
            ->andFilterWhere(['like', 'tindakan_yang_telah_diambil', $this->tindakan_yang_telah_diambil])
            ->andFilterWhere(['like', 'dokumen_berkaitan_yang_dilampirkan', $this->dokumen_berkaitan_yang_dilampirkan])
            ->andFilterWhere(['like', 'bantuan_yang_anda_perlukan', $this->bantuan_yang_anda_perlukan])
            ->andFilterWhere(['like', 'rujukan_aduan_kepada_cawangan_yang_berkaitan', $this->rujukan_aduan_kepada_cawangan_yang_berkaitan])
            ->andFilterWhere(['like', 'rujuk_aduan_kepada_atlet', $this->rujuk_aduan_kepada_atlet])
            ->andFilterWhere(['like', 'tiada_sebarang_tindakan', $this->tiada_sebarang_tindakan])
            ->andFilterWhere(['like', 'maklumbalas_kepada_pengadu', $this->maklumbalas_kepada_pengadu])
            ->andFilterWhere(['like', 'tindakan_susulan', $this->tindakan_susulan])
            ->andFilterWhere(['like', 'aduan_dimajukan_kepada_agensi_lain', $this->aduan_dimajukan_kepada_agensi_lain])
            ->andFilterWhere(['like', 'catatan', $this->catatan]);

        return $dataProvider;
    }
}
