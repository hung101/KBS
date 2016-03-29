<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanInovasiPeralatan;

/**
 * PermohonanInovasiPeralatanSearch represents the model behind the search form about `app\models\PermohonanInovasiPeralatan`.
 */
class PermohonanInovasiPeralatanSearch extends PermohonanInovasiPeralatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_inovasi_peralatan_id'], 'integer'],
            [['tarikh_permohonan', 'pemohon', 'nama_peralatan', 'ringkasan_inovasi_peralatan', 'pegawai_yang_bertanggungjawab', 'catitan_ringkas', 'status_permohonan'], 'safe'],
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
        $query = PermohonanInovasiPeralatan::find()
                ->joinWith(['refStatusPermohonanProjekInovasi']);

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
            'permohonan_inovasi_peralatan_id' => $this->permohonan_inovasi_peralatan_id,
            'tarikh_permohonan' => $this->tarikh_permohonan,
        ]);

        $query->andFilterWhere(['like', 'pemohon', $this->pemohon])
            ->andFilterWhere(['like', 'nama_peralatan', $this->nama_peralatan])
            ->andFilterWhere(['like', 'ringkasan_inovasi_peralatan', $this->ringkasan_inovasi_peralatan])
            ->andFilterWhere(['like', 'pegawai_yang_bertanggungjawab', $this->pegawai_yang_bertanggungjawab])
            ->andFilterWhere(['like', 'catitan_ringkas', $this->catitan_ringkas])
            ->andFilterWhere(['like', 'tbl_ref_status_permohonan_projek_inovasi.desc', $this->status_permohonan]);

        return $dataProvider;
    }
}
