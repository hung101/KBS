<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ElaporanPelaksaan;

/**
 * ElaporanPelaksaanSearch represents the model behind the search form about `app\models\ElaporanPelaksaan`.
 */
class ElaporanPelaksaanSearch extends ElaporanPelaksaan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['elaporan_pelaksaan_id', 'jumlah_penyertaan_keseluruhan'], 'integer'],
            [['nama_projek_program_aktiviti_kejohanan', 'nama_persatuan', 'no_cek_eft', 'tarikh_cek_eft', 'objektif_pelaksaan', 'tarikh_dilaksanakan', 'tempat', 'dirasmikan_oleh', 'keberkesanan_pelaksaan'], 'safe'],
            [['jumlah_bantuan'], 'number'],
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
        $query = ElaporanPelaksaan::find();

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
            'elaporan_pelaksaan_id' => $this->elaporan_pelaksaan_id,
            'jumlah_bantuan' => $this->jumlah_bantuan,
            'tarikh_cek_eft' => $this->tarikh_cek_eft,
            'tarikh_dilaksanakan' => $this->tarikh_dilaksanakan,
            'jumlah_penyertaan_keseluruhan' => $this->jumlah_penyertaan_keseluruhan,
        ]);

        $query->andFilterWhere(['like', 'nama_projek_program_aktiviti_kejohanan', $this->nama_projek_program_aktiviti_kejohanan])
            ->andFilterWhere(['like', 'nama_persatuan', $this->nama_persatuan])
            ->andFilterWhere(['like', 'no_cek_eft', $this->no_cek_eft])
            ->andFilterWhere(['like', 'objektif_pelaksaan', $this->objektif_pelaksaan])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'dirasmikan_oleh', $this->dirasmikan_oleh])
            ->andFilterWhere(['like', 'keberkesanan_pelaksaan', $this->keberkesanan_pelaksaan]);

        return $dataProvider;
    }
}
