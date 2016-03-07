<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ElaporanPelaksanaan;

/**
 * ElaporanPelaksanaanSearch represents the model behind the search form about `app\models\ElaporanPelaksanaan`.
 */
class ElaporanPelaksanaanSearch extends ElaporanPelaksanaan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['elaporan_pelaksaan_id', 'lelaki', 'perempuan', 'l_melayu', 'l_cina', 'l_india', 'l_lain_lain', 'jumlah_penyertaan', 'user_public_id'], 'integer'],
            [['alamat_tempat_pelaksanaan_parlimen', 'kategori_elaporan', 'nama_projek_program_aktiviti_kejohanan', 'peringkat', 'nama_penganjur_persatuan_kerjasama', 'no_cek_eft', 'tarikh_cek_eft', 'tarikh_pelaksanaan_mula', 'tarikh_pelaksanaan_akhir', 'objektif_pelaksaan', 'alamat_tempat_pelaksanaan_1', 'dirasmikan_oleh', 'rumusan_program', 'muat_naik'], 'safe'],
            [['jumlah_bantuan_peruntukan', 'jumlah_perbelanjaan'], 'number'],
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
        $query = ElaporanPelaksanaan::find()
                ->joinWith(['refKategoriELaporan'])
                ->joinWith(['refPeringkatELaporan'])
                ->joinWith(['refParlimen']);

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
            'jumlah_bantuan_peruntukan' => $this->jumlah_bantuan_peruntukan,
            'jumlah_perbelanjaan' => $this->jumlah_perbelanjaan,
            'tarikh_cek_eft' => $this->tarikh_cek_eft,
            'tarikh_pelaksanaan_mula' => $this->tarikh_pelaksanaan_mula,
            'tarikh_pelaksanaan_akhir' => $this->tarikh_pelaksanaan_akhir,
            'lelaki' => $this->lelaki,
            'perempuan' => $this->perempuan,
            'l_melayu' => $this->l_melayu,
            'l_cina' => $this->l_cina,
            'l_india' => $this->l_india,
            'l_lain_lain' => $this->l_lain_lain,
            'jumlah_penyertaan' => $this->jumlah_penyertaan,
            'user_public_id' => $this->user_public_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_kategori_e_laporan.desc', $this->kategori_elaporan])
            ->andFilterWhere(['like', 'nama_projek_program_aktiviti_kejohanan', $this->nama_projek_program_aktiviti_kejohanan])
            ->andFilterWhere(['like', 'tbl_ref_peringkat_e_laporan.desc', $this->peringkat])
            ->andFilterWhere(['like', 'nama_penganjur_persatuan_kerjasama', $this->nama_penganjur_persatuan_kerjasama])
            ->andFilterWhere(['like', 'no_cek_eft', $this->no_cek_eft])
            ->andFilterWhere(['like', 'objektif_pelaksaan', $this->objektif_pelaksaan])
            ->andFilterWhere(['like', 'alamat_tempat_pelaksanaan_1', $this->alamat_tempat_pelaksanaan_1])
            ->andFilterWhere(['like', 'dirasmikan_oleh', $this->dirasmikan_oleh])
            ->andFilterWhere(['like', 'rumusan_program', $this->rumusan_program])
            ->andFilterWhere(['like', 'muat_naik', $this->muat_naik])
                ->andFilterWhere(['like', 'tbl_ref_parlimen.desc', $this->alamat_tempat_pelaksanaan_parlimen]);

        return $dataProvider;
    }
}
