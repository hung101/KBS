<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanMembaikiPeralatan;

/**
 * PermohonanMembaikiPeralatanSearch represents the model behind the search form about `app\models\PermohonanMembaikiPeralatan`.
 */
class PermohonanMembaikiPeralatanSearch extends PermohonanMembaikiPeralatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_membaiki_peralatan_id'], 'integer'],
            [['tarikh_permohonan', 'pemohon', 'nama_peralatan', 'model', 'nombor_siri', 'tarikh_diterima', 'tarikh_dipulang', 'kerosakan', 'simptom_kerosakan', 'komponen_utama', 'proses_pemeriksaan', 'pembaikan', 'cadangan', 'pegawai_yang_bertanggungjawab', 'catitan_ringkas', 'status_permohonan'], 'safe'],
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
        $query = PermohonanMembaikiPeralatan::find()
                ->joinWith(['refPeralatanPermohonanMembaiki'])
                ->joinWith(['refStatusPermohonanMembaikiPeralatan']);

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
            'permohonan_membaiki_peralatan_id' => $this->permohonan_membaiki_peralatan_id,
            'tarikh_permohonan' => $this->tarikh_permohonan,
            'tarikh_diterima' => $this->tarikh_diterima,
            'tarikh_dipulang' => $this->tarikh_dipulang,
        ]);

        $query->andFilterWhere(['like', 'pemohon', $this->pemohon])
            ->andFilterWhere(['like', 'tbl_ref_peralatan_permohonan_membaiki.desc', $this->nama_peralatan])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'nombor_siri', $this->nombor_siri])
            ->andFilterWhere(['like', 'kerosakan', $this->kerosakan])
            ->andFilterWhere(['like', 'simptom_kerosakan', $this->simptom_kerosakan])
            ->andFilterWhere(['like', 'komponen_utama', $this->komponen_utama])
            ->andFilterWhere(['like', 'proses_pemeriksaan', $this->proses_pemeriksaan])
            ->andFilterWhere(['like', 'pembaikan', $this->pembaikan])
            ->andFilterWhere(['like', 'cadangan', $this->cadangan])
            ->andFilterWhere(['like', 'pegawai_yang_bertanggungjawab', $this->pegawai_yang_bertanggungjawab])
            ->andFilterWhere(['like', 'catitan_ringkas', $this->catitan_ringkas])
            ->andFilterWhere(['like', 'tbl_ref_status_permohonan_membaiki_peralatan.desc', $this->status_permohonan]);

        return $dataProvider;
    }
}
