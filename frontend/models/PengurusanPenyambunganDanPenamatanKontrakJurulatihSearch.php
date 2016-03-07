<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanPenyambunganDanPenamatanKontrakJurulatih;

/**
 * PengurusanPenyambunganDanPenamatanKontrakJurulatihSearch represents the model behind the search form about `app\models\PengurusanPenyambunganDanPenamatanKontrakJurulatih`.
 */
class PengurusanPenyambunganDanPenamatanKontrakJurulatihSearch extends PengurusanPenyambunganDanPenamatanKontrakJurulatih
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id'], 'integer'],
            [['jurulatih', 'status_permohonan', 'muat_naik_document', 'tarikh_mula', 'tarikh_tamat'], 'safe'],
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
        $query = PengurusanPenyambunganDanPenamatanKontrakJurulatih::find()
                ->joinWith(['refJurulatih'])
                ->joinWith(['refStatusPermohonanKontrakJurulatih']);

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
            'pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id' => $this->pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_jurulatih.nama', $this->jurulatih])
                ->andFilterWhere(['like', 'tarikh_mula', $this->tarikh_mula])
                ->andFilterWhere(['like', 'tarikh_tamat', $this->tarikh_tamat])
            ->andFilterWhere(['like', 'tbl_ref_status_permohonan_kontrak_jurulatih.desc', $this->status_permohonan])
            ->andFilterWhere(['like', 'muat_naik_document', $this->muat_naik_document]);

        return $dataProvider;
    }
}
