<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GeranBantuanGaji;

/**
 * GeranBantuanGajiSearch represents the model behind the search form about `app\models\GeranBantuanGaji`.
 */
class GeranBantuanGajiSearch extends GeranBantuanGaji
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['geran_bantuan_gaji_id'], 'integer'],
            [['muatnaik_gambar', 'kelulusan', 'nama_jurulatih', 'cawangan', 'sub_cawangan', 'program_msn', 'lain_lain_program', 'pusat_latihan', 'nama_sukan', 'nama_acara', 'status_jurulatih', 'status_permohonan', 'status_keaktifan_jurulatih', 'kategori_geran', 'status_geran', 'catatan'], 'safe'],
            [['jumlah_geran'], 'number'],
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
        $query = GeranBantuanGaji::find()
                ->joinWith(['refJurulatih'])
                ->joinWith(['refStatusPermohonanGeranBantuanGajiJurulatih'])
                ->joinWith(['refKategoriGeranJurulatih'])
                ->joinWith(['refKelulusan']);

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
            'geran_bantuan_gaji_id' => $this->geran_bantuan_gaji_id,
            'jumlah_geran' => $this->jumlah_geran,
            //'kelulusan' => $this->kelulusan,
        ]);

        $query->andFilterWhere(['like', 'muatnaik_gambar', $this->muatnaik_gambar])
            ->andFilterWhere(['like', 'tbl_jurulatih.nama', $this->nama_jurulatih])
            ->andFilterWhere(['like', 'cawangan', $this->cawangan])
            ->andFilterWhere(['like', 'sub_cawangan', $this->sub_cawangan])
            ->andFilterWhere(['like', 'program_msn', $this->program_msn])
            ->andFilterWhere(['like', 'lain_lain_program', $this->lain_lain_program])
            ->andFilterWhere(['like', 'pusat_latihan', $this->pusat_latihan])
            ->andFilterWhere(['like', 'nama_sukan', $this->nama_sukan])
            ->andFilterWhere(['like', 'nama_acara', $this->nama_acara])
            ->andFilterWhere(['like', 'status_jurulatih', $this->status_jurulatih])
            ->andFilterWhere(['like', 'tbl_ref_status_permohonan_geran_bantuan_gaji_jurulatih.desc', $this->status_permohonan])
            ->andFilterWhere(['like', 'status_keaktifan_jurulatih', $this->status_keaktifan_jurulatih])
            ->andFilterWhere(['like', 'tbl_ref_kategori_geran_jurulatih.desc', $this->kategori_geran])
            ->andFilterWhere(['like', 'status_geran', $this->status_geran])
            ->andFilterWhere(['like', 'catatan', $this->catatan])
                ->andFilterWhere(['like', 'tbl_ref_kelulusan', $this->kelulusan]);

        return $dataProvider;
    }
}
