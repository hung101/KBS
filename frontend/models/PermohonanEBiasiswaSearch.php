<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanEBiasiswa;

/**
 * PermohonanEBiasiswaSearch represents the model behind the search form about `app\models\PermohonanEBiasiswa`.
 */
class PermohonanEBiasiswaSearch extends PermohonanEBiasiswa
{
    public $status_permohonan_desc;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_e_biasiswa_id', 'semester_terkini', 'baki_semester_yang_tinggal', 'perakuan_pemohon', 'kelulusan', 'universiti_institusi', 'status_permohonan'], 'integer'],
            [['admin_e_biasiswa_id','muat_naik_gambar', 'nama', 'no_kad_pengenalan', 'jantina', 'keturunan', 'agama', 'taraf_perkahwinan', 'kawasan_temuduga_anda', 'alamat_1', 'alamat_2', 'alamat_3', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'no_tel_bimbit', 'no_pendaftaran_oku', 'kategori_oku', 'oku_lain_lain', 'program_pengajian', 'kursus_bidang_pengajian', 'falkulti', 'kategori', 'tarikh_tamat', 'no_matriks', 'mendapat_pembiayaan_pendidikan', 'sukan', 'status_permohonan_desc'], 'safe'],
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
        $query = PermohonanEBiasiswa::find()
                ->joinWith(['refJantina'])
                ->joinWith(['refSesiPermohonan'])
                ->joinWith(['refStatusPermohonanEBiasiswa']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        
        $dataProvider->sort->attributes['status_permohonan_desc'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['tbl_ref_status_permohonan_e_biasiswa.desc' => SORT_ASC],
            'desc' => ['tbl_ref_status_permohonan_e_biasiswa.desc' => SORT_DESC],
        ];

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'permohonan_e_biasiswa_id' => $this->permohonan_e_biasiswa_id,
            'tarikh_tamat' => $this->tarikh_tamat,
            'semester_terkini' => $this->semester_terkini,
            'baki_semester_yang_tinggal' => $this->baki_semester_yang_tinggal,
            'perakuan_pemohon' => $this->perakuan_pemohon,
            'kelulusan' => $this->kelulusan,
            'universiti_institusi' => $this->universiti_institusi,
            'status_permohonan' => $this->status_permohonan,
        ]);

        $query->andFilterWhere(['like', 'muat_naik_gambar', $this->muat_naik_gambar])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
            ->andFilterWhere(['like', 'tbl_ref_jantina.desc', $this->jantina])
            ->andFilterWhere(['like', 'keturunan', $this->keturunan])
            ->andFilterWhere(['like', 'agama', $this->agama])
            ->andFilterWhere(['like', 'taraf_perkahwinan', $this->taraf_perkahwinan])
            ->andFilterWhere(['like', 'kawasan_temuduga_anda', $this->kawasan_temuduga_anda])
            ->andFilterWhere(['like', 'alamat_1', $this->alamat_1])
            ->andFilterWhere(['like', 'alamat_2', $this->alamat_2])
            ->andFilterWhere(['like', 'alamat_3', $this->alamat_3])
            ->andFilterWhere(['like', 'alamat_negeri', $this->alamat_negeri])
            ->andFilterWhere(['like', 'alamat_bandar', $this->alamat_bandar])
            ->andFilterWhere(['like', 'alamat_poskod', $this->alamat_poskod])
            ->andFilterWhere(['like', 'no_tel_bimbit', $this->no_tel_bimbit])
            ->andFilterWhere(['like', 'no_pendaftaran_oku', $this->no_pendaftaran_oku])
            ->andFilterWhere(['like', 'kategori_oku', $this->kategori_oku])
            ->andFilterWhere(['like', 'oku_lain_lain', $this->oku_lain_lain])
            //->andFilterWhere(['like', 'universiti_institusi', $this->universiti_institusi])
            ->andFilterWhere(['like', 'program_pengajian', $this->program_pengajian])
            ->andFilterWhere(['like', 'kursus_bidang_pengajian', $this->kursus_bidang_pengajian])
            ->andFilterWhere(['like', 'falkulti', $this->falkulti])
            ->andFilterWhere(['like', 'kategori', $this->kategori])
            ->andFilterWhere(['like', 'no_matriks', $this->no_matriks])
            ->andFilterWhere(['like', 'mendapat_pembiayaan_pendidikan', $this->mendapat_pembiayaan_pendidikan])
            ->andFilterWhere(['like', 'sukan', $this->sukan])
            ->andFilterWhere(['like', 'tbl_ref_status_permohonan_e_biasiswa.desc', $this->status_permohonan_desc])
                ->andFilterWhere(['like', 'tbl_admin_e_biasiswa.nama', $this->admin_e_biasiswa_id]);

        return $dataProvider;
    }
}
