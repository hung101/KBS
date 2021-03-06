<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TempahanKemudahan;

/**
 * TempahanKemudahanSearch represents the model behind the search form about `app\models\TempahanKemudahan`.
 */
class TempahanKemudahanSearch extends TempahanKemudahan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tempahan_kemudahan_id', 'quantity_kadar', 'public_user_pemohon_id', 'public_user_pemilik_id'], 'integer'],
            [['nama', 'no_kad_pengenalan', 'location_alamat_1', 'venue', 'tarikh_mula', 'catatan', 'tarikh_akhir', 'jenis_kadar', 'status', 'kategori_hakmilik', 'bayaran_sewa'], 'safe'],
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
        $query = TempahanKemudahan::find()
                ->joinWith(['refPengurusanKemudahanVenue'])
                ->joinWith(['refStatusTempahanKemudahan'])
                ->joinWith(['refJenisKadarKemudahan'])
                ->joinWith(['refKategoriHakmilik']);

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
            'tempahan_kemudahan_id' => $this->tempahan_kemudahan_id,
            //'tarikh_mula' => $this->tarikh_mula,
            'tarikh_akhir' => $this->tarikh_akhir,
            'quantity_kadar' => $this->quantity_kadar,
            'public_user_pemohon_id' => $this->public_user_pemohon_id,
            'public_user_pemilik_id' => $this->public_user_pemilik_id,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
            ->andFilterWhere(['like', 'location_alamat_1', $this->location_alamat_1])
                ->andFilterWhere(['like', 'tarikh_mula', $this->tarikh_mula])
            ->andFilterWhere(['like', 'tbl_pengurusan_kemudahan_venue.nama_venue', $this->venue])
            ->andFilterWhere(['like', 'bayaran_sewa', $this->bayaran_sewa])
                ->andFilterWhere(['like', 'catatan', $this->catatan])
                ->andFilterWhere(['like', 'tbl_ref_jenis_kadar_kemudahan.desc', $this->jenis_kadar])
                ->andFilterWhere(['like', 'tbl_ref_status_tempahan_kemudahan.desc', $this->status])
                ->andFilterWhere(['like', 'tbl_ref_kategori_hakmilik.desc', $this->kategori_hakmilik]);

        return $dataProvider;
    }
}
