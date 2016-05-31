<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenilaianPenganjurKursus;

/**
 * PenilaianPenganjurKursusSearch represents the model behind the search form about `app\models\PenilaianPenganjurKursus`.
 */
class PenilaianPenganjurKursusSearch extends PenilaianPenganjurKursus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penilaian_penganjur_kursus_id', 'created_by', 'updated_by'], 'integer'],
            [['tarikh_kursus', 'nama_penganjur_kursus', 'kod_kursus', 'tempat_kursus', 'nama_penyelaras', 'created', 'updated', 'pengurusan_permohonan_kursus_persatuan_id'], 'safe'],
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
        $query = PenilaianPenganjurKursus::find()
                ->joinWith(['refPengurusanPermohonanKursusPersatuan']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'penilaian_penganjur_kursus_id' => $this->penilaian_penganjur_kursus_id,
            //'pengurusan_permohonan_kursus_persatuan_id' => $this->pengurusan_permohonan_kursus_persatuan_id,
            'tarikh_kursus' => $this->tarikh_kursus,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'nama_penganjur_kursus', $this->nama_penganjur_kursus])
            ->andFilterWhere(['like', 'kod_kursus', $this->kod_kursus])
            ->andFilterWhere(['like', 'tempat_kursus', $this->tempat_kursus])
            ->andFilterWhere(['like', 'nama_penyelaras', $this->nama_penyelaras])
                ->andFilterWhere(['like', 'tbl_pengurusan_permohonan_kursus_persatuan.tarikh_kursus', $this->pengurusan_permohonan_kursus_persatuan_id]);

        return $dataProvider;
    }
}
