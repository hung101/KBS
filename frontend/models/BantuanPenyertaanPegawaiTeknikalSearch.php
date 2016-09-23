<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BantuanPenyertaanPegawaiTeknikal;

/**
 * BantuanPenyertaanPegawaiTeknikalSearch represents the model behind the search form about `app\models\BantuanPenyertaanPegawaiTeknikal`.
 */
class BantuanPenyertaanPegawaiTeknikalSearch extends BantuanPenyertaanPegawaiTeknikal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_penyertaan_pegawai_teknikal_id', 'created_by', 'updated_by'], 'integer'],
            [['badan_sukan', 'sukan', 'no_pendaftaran', 'alamat_1', 'alamat_2', 'alamat_3', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'no_telefon', 'no_faks', 'laman_sesawang', 'facebook', 'twitter', 'nama_bank', 'no_akaun', 'nama_kejohanan', 'peringkat', 'peringkat_lain_lain', 'tarikh', 'tempat', 'tujuan', 'surat_rasmi_badan_sukan_ms_negeri', 'surat_jemputan_lantikan_daripada_pengelola', 'butiran_perbelanjaan', 'salinan_passport', 'maklumat_lain_sokongan', 'status_permohonan', 'catatan', 'tarikh_permohonan', 'jkb', 'tarikh_jkb', 'created', 'updated'], 'safe'],
            [['jumlah_bantuan_yang_dipohon', 'jumlah_dilulus'], 'number'],
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
        $query = BantuanPenyertaanPegawaiTeknikal::find()
                ->joinWith(['refProfilBadanSukan'])
                ->joinWith(['refStatusBantuanPenyertaanPegawaiTeknikal'])
                ->joinWith(['refSukan']);

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
            'bantuan_penyertaan_pegawai_teknikal_id' => $this->bantuan_penyertaan_pegawai_teknikal_id,
            'tarikh' => $this->tarikh,
            'jumlah_bantuan_yang_dipohon' => $this->jumlah_bantuan_yang_dipohon,
            'tarikh_permohonan' => $this->tarikh_permohonan,
            'jumlah_dilulus' => $this->jumlah_dilulus,
            'tarikh_jkb' => $this->tarikh_jkb,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'tbl_profil_badan_sukan.nama_badan_sukan', $this->badan_sukan])
            ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->sukan])
            ->andFilterWhere(['like', 'tbl_bantuan_penyertaan_pegawai_teknikal.no_pendaftaran', $this->no_pendaftaran])
            ->andFilterWhere(['like', 'alamat_1', $this->alamat_1])
            ->andFilterWhere(['like', 'alamat_2', $this->alamat_2])
            ->andFilterWhere(['like', 'alamat_3', $this->alamat_3])
            ->andFilterWhere(['like', 'alamat_negeri', $this->alamat_negeri])
            ->andFilterWhere(['like', 'alamat_bandar', $this->alamat_bandar])
            ->andFilterWhere(['like', 'alamat_poskod', $this->alamat_poskod])
            ->andFilterWhere(['like', 'no_telefon', $this->no_telefon])
            ->andFilterWhere(['like', 'no_faks', $this->no_faks])
            ->andFilterWhere(['like', 'laman_sesawang', $this->laman_sesawang])
            ->andFilterWhere(['like', 'facebook', $this->facebook])
            ->andFilterWhere(['like', 'twitter', $this->twitter])
            ->andFilterWhere(['like', 'nama_bank', $this->nama_bank])
            ->andFilterWhere(['like', 'no_akaun', $this->no_akaun])
            ->andFilterWhere(['like', 'nama_kejohanan', $this->nama_kejohanan])
            ->andFilterWhere(['like', 'peringkat', $this->peringkat])
            ->andFilterWhere(['like', 'peringkat_lain_lain', $this->peringkat_lain_lain])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'tujuan', $this->tujuan])
            ->andFilterWhere(['like', 'surat_rasmi_badan_sukan_ms_negeri', $this->surat_rasmi_badan_sukan_ms_negeri])
            ->andFilterWhere(['like', 'surat_jemputan_lantikan_daripada_pengelola', $this->surat_jemputan_lantikan_daripada_pengelola])
            ->andFilterWhere(['like', 'butiran_perbelanjaan', $this->butiran_perbelanjaan])
            ->andFilterWhere(['like', 'salinan_passport', $this->salinan_passport])
            ->andFilterWhere(['like', 'maklumat_lain_sokongan', $this->maklumat_lain_sokongan])
            ->andFilterWhere(['like', 'tbl_ref_status_bantuan_penyertaan_pegawai_teknikal.desc', $this->status_permohonan])
            ->andFilterWhere(['like', 'catatan', $this->catatan])
            ->andFilterWhere(['like', 'jkb', $this->jkb]);

        return $dataProvider;
    }
}
