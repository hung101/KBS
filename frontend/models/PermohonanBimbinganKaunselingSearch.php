<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanBimbinganKaunseling;

/**
 * PermohonanBimbinganKaunselingSearch represents the model behind the search form about `app\models\PermohonanBimbinganKaunseling`.
 */
class PermohonanBimbinganKaunselingSearch extends PermohonanBimbinganKaunseling
{
    public $atlet;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_bimbingan_kaunseling_id', 'bil_adik_beradik', 'atlet'], 'integer'],
            [['status_permohonan', 'atlet_id', 'tarikh_rujukan', 'nama_pemohon_rujukan', 'kes_latarbelakang', 'notis', 'pekerjaan_bapa', 'pekerjaan_ibu', 
                'no_telefon', 'tarikh_temujanji', 'jurulatih'], 'safe'],
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
        $query = PermohonanBimbinganKaunseling::find()
                ->joinWith(['atlet'])
                ->joinWith(['refStatusPermohonan'])
                ->joinWith(['refLatarbelakangKes'])
                ->joinWith(['refJurulatih']);

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
            'permohonan_bimbingan_kaunseling_id' => $this->permohonan_bimbingan_kaunseling_id,
            //'atlet_id' => $this->atlet_id,
            'tarikh_rujukan' => $this->tarikh_rujukan,
            'bil_adik_beradik' => $this->bil_adik_beradik,
            'tbl_permohonan_bimbingan_kaunseling.atlet_id' => $this->atlet,
        ]);

        $query->andFilterWhere(['like', 'status_permohonan', $this->status_permohonan])
            ->andFilterWhere(['like', 'nama_pemohon_rujukan', $this->nama_pemohon_rujukan])
            ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id])
                ->andFilterWhere(['like', 'tbl_jurulatih.nama', $this->jurulatih])
            ->andFilterWhere(['like', 'notis', $this->notis])
            ->andFilterWhere(['like', 'pekerjaan_bapa', $this->pekerjaan_bapa])
            ->andFilterWhere(['like', 'pekerjaan_ibu', $this->pekerjaan_ibu])
            ->andFilterWhere(['like', 'no_telefon', $this->no_telefon])
                ->andFilterWhere(['like', 'tarikh_temujanji', $this->tarikh_temujanji])
                ->andFilterWhere(['like', 'tbl_ref_latarbelakang_kes.desc', $this->kes_latarbelakang]);

        return $dataProvider;
    }
}
