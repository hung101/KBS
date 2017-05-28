<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanEBantuan;

/**
 * PermohonanEBantuanSearch represents the model behind the search form about `app\models\PermohonanEBantuan`.
 */
class PermohonanEBantuanSearch extends PermohonanEBantuan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_e_bantuan_id', 'bilangan_keahlian', 'bilangan_cawangan_badan_gabungan', 'user_public_id'], 'integer'],
            [['bil_mesyuarat','tarikh_mesyuarat','jumlah_diluluskan','jumlah_bantuan_yang_dipohon','nama_program','ebantuan_id','nama_pertubuhan_persatuan', 'no_pendaftaran', 
                'tarikh_didaftarkan', 'pejabat_yang_mendaftarkan', 'alamat_1', 'alamat_2', 'alamat_3', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'alamat_surat_menyurat_1', 
                'alamat_surat_menyurat_2', 'alamat_surat_menyurat_3', 'alamat_surat_menyurat_negeri', 'alamat_surat_menyurat_bandar', 'alamat_surat_menyurat_poskod', 
                'no_telefon_pejabat', 'no_telefon_bimbit', 'no_fax', 'email', 'objektif_pertubuhan', 'aktiviti_dan_kejayaan_yang_dicapai', 'kelulusan',
                'status_permohonan', 'kategori_program', 'hantar_flag'], 'safe'],
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
        $query = PermohonanEBantuan::find()
                ->joinWith(['refKelulusan'])
                ->joinWith(['refStatusPermohonanEBantuan']);

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
            'permohonan_e_bantuan_id' => $this->permohonan_e_bantuan_id,
            'tarikh_didaftarkan' => $this->tarikh_didaftarkan,
            'bilangan_keahlian' => $this->bilangan_keahlian,
            'bilangan_cawangan_badan_gabungan' => $this->bilangan_cawangan_badan_gabungan,
            'user_public_id' => $this->user_public_id,
            'hantar_flag' => $this->hantar_flag,
            'kategori_program' => $this->kategori_program,
        ]);

        $query->andFilterWhere(['like', 'nama_pertubuhan_persatuan', $this->nama_pertubuhan_persatuan])
            ->andFilterWhere(['like', 'no_pendaftaran', $this->no_pendaftaran])
                ->andFilterWhere(['like', 'ebantuan_id', $this->ebantuan_id])
                ->andFilterWhere(['like', 'nama_program', $this->nama_program])
            ->andFilterWhere(['like', 'pejabat_yang_mendaftarkan', $this->pejabat_yang_mendaftarkan])
            ->andFilterWhere(['like', 'alamat_1', $this->alamat_1])
            ->andFilterWhere(['like', 'alamat_2', $this->alamat_2])
            ->andFilterWhere(['like', 'alamat_3', $this->alamat_3])
            ->andFilterWhere(['like', 'alamat_negeri', $this->alamat_negeri])
            ->andFilterWhere(['like', 'alamat_bandar', $this->alamat_bandar])
            ->andFilterWhere(['like', 'alamat_poskod', $this->alamat_poskod])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_1', $this->alamat_surat_menyurat_1])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_2', $this->alamat_surat_menyurat_2])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_3', $this->alamat_surat_menyurat_3])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_negeri', $this->alamat_surat_menyurat_negeri])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_bandar', $this->alamat_surat_menyurat_bandar])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_poskod', $this->alamat_surat_menyurat_poskod])
            ->andFilterWhere(['like', 'no_telefon_pejabat', $this->no_telefon_pejabat])
            ->andFilterWhere(['like', 'no_telefon_bimbit', $this->no_telefon_bimbit])
            ->andFilterWhere(['like', 'no_fax', $this->no_fax])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'tbl_ref_kelulusan.desc', $this->kelulusan])
            ->andFilterWhere(['like', 'objektif_pertubuhan', $this->objektif_pertubuhan])
            ->andFilterWhere(['like', 'aktiviti_dan_kejayaan_yang_dicapai', $this->aktiviti_dan_kejayaan_yang_dicapai])
                ->andFilterWhere(['like', 'bil_mesyuarat', $this->bil_mesyuarat])
                ->andFilterWhere(['like', 'tarikh_mesyuarat', $this->tarikh_mesyuarat])
                ->andFilterWhere(['like', 'jumlah_diluluskan', $this->jumlah_diluluskan])
                ->andFilterWhere(['like', 'jumlah_bantuan_yang_dipohon', $this->jumlah_bantuan_yang_dipohon])
                ->andFilterWhere(['like', 'tbl_ref_status_permohonan_e_bantuan.desc', $this->status_permohonan]);

        return $dataProvider;
    }
}
