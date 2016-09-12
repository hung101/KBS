<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanPermohonanKursusPersatuan;

/**
 * PengurusanPermohonanKursusPersatuanSearch represents the model behind the search form about `app\models\PengurusanPermohonanKursusPersatuan`.
 */
class PengurusanPermohonanKursusPersatuanSearch extends PengurusanPermohonanKursusPersatuan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_permohonan_kursus_persatuan_id'], 'integer'],
            [['nama', 'no_kad_pengenalan', 'tarikh_lahir', 'jantina', 'alamat_1', 'alamat_2', 'alamat_3', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 
                'no_tel_bimbit', 'emel', 'facebook', 'kelayakan_akademi', 'perkerjaan', 'nama_majikan', 'kelulusan', 'no_perhubungan', 'tarikh_kursus', 'tarikh_tamat_kursus', 
                'agensi'], 'safe'],
            [['yuran_program'], 'number'],
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
        $query = PengurusanPermohonanKursusPersatuan::find()
                ->joinWith(['refJantina'])
                ->joinWith(['refStatusPermohonanJkk']);

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
            'pengurusan_permohonan_kursus_persatuan_id' => $this->pengurusan_permohonan_kursus_persatuan_id,
            'tarikh_lahir' => $this->tarikh_lahir,
            'yuran_program' => $this->yuran_program,
            //'kelulusan' => $this->kelulusan,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
            ->andFilterWhere(['like', 'tbl_ref_jantina.desc', $this->jantina])
            ->andFilterWhere(['like', 'alamat_1', $this->alamat_1])
            ->andFilterWhere(['like', 'agensi', $this->agensi])
            ->andFilterWhere(['like', 'alamat_3', $this->alamat_3])
            ->andFilterWhere(['like', 'alamat_negeri', $this->alamat_negeri])
            ->andFilterWhere(['like', 'alamat_bandar', $this->alamat_bandar])
            ->andFilterWhere(['like', 'alamat_poskod', $this->alamat_poskod])
            ->andFilterWhere(['like', 'no_tel_bimbit', $this->no_tel_bimbit])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'facebook', $this->facebook])
            ->andFilterWhere(['like', 'kelayakan_akademi', $this->kelayakan_akademi])
            ->andFilterWhere(['like', 'perkerjaan', $this->perkerjaan])
            ->andFilterWhere(['like', 'nama_majikan', $this->nama_majikan])
                ->andFilterWhere(['like', 'no_perhubungan', $this->no_perhubungan])
                ->andFilterWhere(['like', 'tarikh_kursus', $this->tarikh_kursus])
                ->andFilterWhere(['like', 'tarikh_tamat_kursus', $this->tarikh_tamat_kursus])
                ->andFilterWhere(['like', 'tbl_ref_status_permohonan_jkk.desc', $this->kelulusan]);

        return $dataProvider;
    }
}
