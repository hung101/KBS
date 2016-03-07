<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanKemudahanAduan;

/**
 * PengurusanKemudahanAduanSearch represents the model behind the search form about `app\models\PengurusanKemudahanAduan`.
 */
class PengurusanKemudahanAduanSearch extends PengurusanKemudahanAduan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_kemudahan_aduan_id'], 'integer'],
            [['kategori_aduan', 'pengurusan_kemudahan_venue_id', 'venue', 'peralatan', 'tarikh_aduan', 'nama_pengadu', 'kenyataan_aduan', 'tindakan_ulasan'], 'safe'],
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
        $query = PengurusanKemudahanAduan::find()
                ->joinWith(['refPengurusanVenue'])
                ->joinWith(['refKategoriAduanKemudahan'])
                ->joinWith(['refPeralatanKemudahan']);

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
            'pengurusan_kemudahan_aduan_id' => $this->pengurusan_kemudahan_aduan_id,
            //'pengurusan_kemudahan_venue_id' => $this->pengurusan_kemudahan_venue_id,
            'tarikh_aduan' => $this->tarikh_aduan,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_kategori_aduan_kemudahan.desc', $this->kategori_aduan])
            ->andFilterWhere(['like', 'venue', $this->venue])
            ->andFilterWhere(['like', 'tbl_pengurusan_kemudahan_venue.nama_venue', $this->pengurusan_kemudahan_venue_id])
            ->andFilterWhere(['like', 'tbl_ref_peralatan_kemudahan.desc', $this->peralatan])
            ->andFilterWhere(['like', 'nama_pengadu', $this->nama_pengadu])
            ->andFilterWhere(['like', 'kenyataan_aduan', $this->kenyataan_aduan])
            ->andFilterWhere(['like', 'tindakan_ulasan', $this->tindakan_ulasan]);

        return $dataProvider;
    }
}
