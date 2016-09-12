<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanPenilaianPendidikanPenganjurIntructor;

/**
 * PengurusanPenilaianPendidikanPenganjurIntructorSearch represents the model behind the search form about `app\models\PengurusanPenilaianPendidikanPenganjurIntructor`.
 */
class PengurusanPenilaianPendidikanPenganjurIntructorSearch extends PengurusanPenilaianPendidikanPenganjurIntructor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_penilaian_pendidikan_penganjur_intructor_id'], 'integer'],
            [['nama_penganjuran_kursus', 'kod_kursus', 'tarikh_kursus', 'instructor', 'pengurusan_permohonan_kursus_persatuan_id'], 'safe'],
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
        $query = PengurusanPenilaianPendidikanPenganjurIntructor::find()
                ->joinWith(['refPengurusanPermohonanKursusPersatuan']);

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
            'pengurusan_penilaian_pendidikan_penganjur_intructor_id' => $this->pengurusan_penilaian_pendidikan_penganjur_intructor_id,
            'tarikh_kursus' => $this->tarikh_kursus,
        ]);

        $query->andFilterWhere(['like', 'nama_penganjuran_kursus', $this->nama_penganjuran_kursus])
            ->andFilterWhere(['like', 'kod_kursus', $this->kod_kursus])
            ->andFilterWhere(['like', 'instructor', $this->instructor])
                ->andFilterWhere(['like', 'tbl_pengurusan_permohonan_kursus_persatuan.agensi', $this->pengurusan_permohonan_kursus_persatuan_id]);

        return $dataProvider;
    }
}
