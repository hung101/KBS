<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BantuanPenganjuranKejohanan;

/**
 * BantuanPenganjuranKejohananSearch represents the model behind the search form about `app\models\BantuanPenganjuranKejohanan`.
 */
class BantuanPenganjuranKejohananSearch extends BantuanPenganjuranKejohanan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_penganjuran_kejohanan_id', 'bil_pasukan', 'bil_peserta', 'bil_pengadil_hakim', 'bil_pegawai_teknikal', 'bilangan_pembantu', 
                'created_by', 'updated_by', 'hantar_flag'], 'integer'],
            [['badan_sukan', 'sukan', 'no_pendaftaran', 'alamat_1', 'alamat_2', 'alamat_3', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 
                'no_telefon', 'no_faks', 'laman_sesawang', 'facebook', 'twitter', 'nama_bank', 'no_akaun', 'nama_kejohanan_pertandingan', 
                'peringkat', 'tarikh_mula', 'tarikh_tamat', 'tempat', 'tujuan', 'kertas_kerja', 'surat_rasmi_badan_sukan_ms_negeri', 
                'permohonan_rasmi_dari_ahli_gabungan', 'maklumat_lain_sokongan', 'status_permohonan', 'catatan', 'tarikh_permohonan', 'jkb', 
                'tarikh_jkb', 'created', 'updated', 'selesai'], 'safe'],
            [['anggaran_perbelanjaan', 'jumlah_bantuan_yang_dipohon', 'jumlah_dilulus'], 'number'],
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
        $query = BantuanPenganjuranKejohanan::find()
                ->joinWith(['refProfilBadanSukan'])
                ->joinWith(['refStatusBantuanPenganjuranKejohanan'])
                ->joinWith(['refSukan'])
                ->joinWith(['refKelulusan']);

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
            'bantuan_penganjuran_kejohanan_id' => $this->bantuan_penganjuran_kejohanan_id,
            'tarikh_mula' => $this->tarikh_mula,
            'tarikh_tamat' => $this->tarikh_tamat,
            'bil_pasukan' => $this->bil_pasukan,
            'bil_peserta' => $this->bil_peserta,
            'bil_pengadil_hakim' => $this->bil_pengadil_hakim,
            'bil_pegawai_teknikal' => $this->bil_pegawai_teknikal,
            'bilangan_pembantu' => $this->bilangan_pembantu,
            'anggaran_perbelanjaan' => $this->anggaran_perbelanjaan,
            //'jumlah_bantuan_yang_dipohon' => $this->jumlah_bantuan_yang_dipohon,
            'tarikh_permohonan' => $this->tarikh_permohonan,
            'jumlah_dilulus' => $this->jumlah_dilulus,
            'tarikh_jkb' => $this->tarikh_jkb,
            'tbl_bantuan_penganjuran_kejohanan.created_by' => $this->created_by,
            'tbl_bantuan_penganjuran_kejohanan.updated_by' => $this->updated_by,
            'tbl_bantuan_penganjuran_kejohanan.created' => $this->created,
            'tbl_bantuan_penganjuran_kejohanan.updated' => $this->updated,
            'tbl_bantuan_penganjuran_kejohanan.hantar_flag' => $this->hantar_flag,
        ]);

        $query->andFilterWhere(['like', 'tbl_profil_badan_sukan.nama_badan_sukan', $this->badan_sukan])
            ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->sukan])
            ->andFilterWhere(['like', 'tbl_bantuan_penganjuran_kejohanan.no_pendaftaran', $this->no_pendaftaran])
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
            ->andFilterWhere(['like', 'nama_kejohanan_pertandingan', $this->nama_kejohanan_pertandingan])
            ->andFilterWhere(['like', 'peringkat', $this->peringkat])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'tujuan', $this->tujuan])
            ->andFilterWhere(['like', 'kertas_kerja', $this->kertas_kerja])
            ->andFilterWhere(['like', 'surat_rasmi_badan_sukan_ms_negeri', $this->surat_rasmi_badan_sukan_ms_negeri])
            ->andFilterWhere(['like', 'permohonan_rasmi_dari_ahli_gabungan', $this->permohonan_rasmi_dari_ahli_gabungan])
            ->andFilterWhere(['like', 'maklumat_lain_sokongan', $this->maklumat_lain_sokongan])
            ->andFilterWhere(['like', 'tbl_ref_status_bantuan_penganjuran_kejohanan.desc', $this->status_permohonan])
            ->andFilterWhere(['like', 'catatan', $this->catatan])
            ->andFilterWhere(['like', 'jkb', $this->jkb])
                ->andFilterWhere(['like', 'jumlah_bantuan_yang_dipohon', $this->jumlah_bantuan_yang_dipohon])
                ->andFilterWhere(['like', 'tbl_ref_kelulusan.desc', $this->selesai]);

        return $dataProvider;
    }
}
