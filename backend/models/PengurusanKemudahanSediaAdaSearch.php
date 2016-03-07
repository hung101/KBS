<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanKemudahanSediaAda;

/**
 * PengurusanKemudahanSediaAdaSearch represents the model behind the search form about `app\models\PengurusanKemudahanSediaAda`.
 */
class PengurusanKemudahanSediaAdaSearch extends PengurusanKemudahanSediaAda
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_kemudahan_sedia_ada_id', 'jumlah_kapasiti', 'bilangan_kekerapan_penyenggaran', 'kekerapan_penggunaan', 'kekerapan_kerosakan_berlaku', 'pengurusan_kemudahan_venue_id'], 'integer'],
            [['keluasan_padang', 'nama_kemudahan', 'size', 'session_id', 'jenis_kemudahan'], 'safe'],
            [['cost_pembaikian'], 'number'],
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
        $query = PengurusanKemudahanSediaAda::find()
                ->joinWith(['refPengurusanVenue'])
                ->joinWith(['refJenisKemudahan']);

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
            'pengurusan_kemudahan_sedia_ada_id' => $this->pengurusan_kemudahan_sedia_ada_id,
            'tbl_pengurusan_kemudahan_venue.pengurusan_kemudahan_venue_id' => $this->pengurusan_kemudahan_venue_id,
            'jumlah_kapasiti' => $this->jumlah_kapasiti,
            'bilangan_kekerapan_penyenggaran' => $this->bilangan_kekerapan_penyenggaran,
            'kekerapan_penggunaan' => $this->kekerapan_penggunaan,
            'kekerapan_kerosakan_berlaku' => $this->kekerapan_kerosakan_berlaku,
            'cost_pembaikian' => $this->cost_pembaikian,
        ]);

        $query->andFilterWhere(['like', 'keluasan_padang', $this->keluasan_padang])
                ->andFilterWhere(['like', 'nama_kemudahan', $this->nama_kemudahan])
                ->andFilterWhere(['like', 'size', $this->size])
                //->andFilterWhere(['like', 'tbl_pengurusan_kemudahan_venue.nama_venue', $this->pengurusan_kemudahan_venue_id])
                ->andFilterWhere(['like', 'tbl_ref_jenis_kemudahan.desc', $this->jenis_kemudahan])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
