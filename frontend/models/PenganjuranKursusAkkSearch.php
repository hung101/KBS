<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenganjuranKursusAkk;

/**
 * PenganjuranKursusAkkSearch represents the model behind the search form about `app\models\PenganjuranKursusAkk`.
 */
class PenganjuranKursusAkkSearch extends PenganjuranKursusAkk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penganjuran_kursus_id', 'kuota_kursus'], 'integer'],
            [['tarikh_kursus_mula', 'tarikh_kursus_tamat', 'tempat_kursus', 'negeri', 'nama_penyelaras', 'no_telefon', 'jenis_kursus', 'nama_kursus', 'kod_kursus'], 'safe'],
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
        $query = PenganjuranKursusAkk::find()
                ->joinWith(['refKategoriKursusPenganjuran'])
                ->joinWith(['refNegeri']);

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
            'penganjuran_kursus_id' => $this->penganjuran_kursus_id,
            //'tarikh_kursus_mula' => $this->tarikh_kursus_mula,
            'kuota_kursus' => $this->kuota_kursus,
        ]);

        $query->andFilterWhere(['like', 'tempat_kursus', $this->tempat_kursus])
                ->andFilterWhere(['like', 'tbl_ref_kategori_kursus_penganjuran.desc', $this->jenis_kursus])
            ->andFilterWhere(['like', 'tbl_ref_negeri.desc', $this->negeri])
            ->andFilterWhere(['like', 'nama_penyelaras', $this->nama_penyelaras])
            ->andFilterWhere(['like', 'no_telefon', $this->no_telefon])
                ->andFilterWhere(['like', 'tarikh_kursus_tamat', $this->tarikh_kursus_tamat])
                ->andFilterWhere(['like', 'tarikh_kursus_mula', $this->tarikh_kursus_mula])
                ->andFilterWhere(['like', 'nama_kursus', $this->nama_kursus])
                ->andFilterWhere(['like', 'kod_kursus', $this->kod_kursus]);

        return $dataProvider;
    }
}
