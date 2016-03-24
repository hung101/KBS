<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenganjuranKursusPeserta;

/**
 * PenganjuranKursusPesertaSearch represents the model behind the search form about `app\models\PenganjuranKursusPeserta`.
 */
class PenganjuranKursusPesertaSearch extends PenganjuranKursusPeserta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penganjuran_kursus_peserta_id', 'penganjuran_kursus_id'], 'integer'],
            [['kategori_kursus', 'kelulusan', 'nama_kursus', 'kod_kursus', 'tarikh', 'tempat', 'nama_penuh', 'muatnaik_gambar', 'jantina', 'taraf_perkahwinan', 'no_passport', 'no_kad_pengenalan', 'no_kp_polis_tentera', 'kaum', 'alamat_1', 'alamat_2', 'alamat_3', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'no_tel_bimbit', 'no_tel_rumah', 'emel', 'pekerjaan', 'nama_majikan', 'alamat_majikan_1', 'alamat_majikan_2', 'alamat_majikan_3', 'alamat_majikan_negeri', 'alamat_majikan_bandar', 'alamat_majikan_poskod', 'no_tel_majikan', 'no_faks_majikan', 'kelulusan_akademi', 'nama_kelulusan', 'kelulusan_sukan_spesifik', 'nama_sukan_akademi', 'kelulusan_sains_sukan', 'sijil_spkk_msn', 'lesen_kejurulatihan_msn', 'status_jurulatih', 'lantikan', 'nama_sukan_jurulatih', 'tahun_berkhidmat_mula', 'tahun_berkhidmat_tamat', 'pencapaian'], 'safe'],
            [['yuran'], 'number'],
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
        $query = PenganjuranKursusPeserta::find()
                ->joinWith(['refJantina'])
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
            'penganjuran_kursus_peserta_id' => $this->penganjuran_kursus_peserta_id,
            'tarikh' => $this->tarikh,
            'yuran' => $this->yuran,
            'tahun_berkhidmat_mula' => $this->tahun_berkhidmat_mula,
            'tahun_berkhidmat_tamat' => $this->tahun_berkhidmat_tamat,
            //'kelulusan' => $this->kelulusan,
            'penganjuran_kursus_id' => $this->penganjuran_kursus_id,
        ]);

        $query->andFilterWhere(['like', 'kategori_kursus', $this->kategori_kursus])
            ->andFilterWhere(['like', 'nama_kursus', $this->nama_kursus])
            ->andFilterWhere(['like', 'kod_kursus', $this->kod_kursus])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'nama_penuh', $this->nama_penuh])
            ->andFilterWhere(['like', 'muatnaik_gambar', $this->muatnaik_gambar])
            ->andFilterWhere(['like', 'tbl_ref_jantina.desc', $this->jantina])
            ->andFilterWhere(['like', 'taraf_perkahwinan', $this->taraf_perkahwinan])
            ->andFilterWhere(['like', 'no_passport', $this->no_passport])
            ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
            ->andFilterWhere(['like', 'no_kp_polis_tentera', $this->no_kp_polis_tentera])
            ->andFilterWhere(['like', 'kaum', $this->kaum])
            ->andFilterWhere(['like', 'alamat_1', $this->alamat_1])
            ->andFilterWhere(['like', 'alamat_2', $this->alamat_2])
            ->andFilterWhere(['like', 'alamat_3', $this->alamat_3])
            ->andFilterWhere(['like', 'alamat_negeri', $this->alamat_negeri])
            ->andFilterWhere(['like', 'alamat_bandar', $this->alamat_bandar])
            ->andFilterWhere(['like', 'alamat_poskod', $this->alamat_poskod])
            ->andFilterWhere(['like', 'no_tel_bimbit', $this->no_tel_bimbit])
            ->andFilterWhere(['like', 'no_tel_rumah', $this->no_tel_rumah])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'pekerjaan', $this->pekerjaan])
            ->andFilterWhere(['like', 'nama_majikan', $this->nama_majikan])
            ->andFilterWhere(['like', 'alamat_majikan_1', $this->alamat_majikan_1])
            ->andFilterWhere(['like', 'alamat_majikan_2', $this->alamat_majikan_2])
            ->andFilterWhere(['like', 'alamat_majikan_3', $this->alamat_majikan_3])
            ->andFilterWhere(['like', 'alamat_majikan_negeri', $this->alamat_majikan_negeri])
            ->andFilterWhere(['like', 'alamat_majikan_bandar', $this->alamat_majikan_bandar])
            ->andFilterWhere(['like', 'alamat_majikan_poskod', $this->alamat_majikan_poskod])
            ->andFilterWhere(['like', 'no_tel_majikan', $this->no_tel_majikan])
            ->andFilterWhere(['like', 'no_faks_majikan', $this->no_faks_majikan])
            ->andFilterWhere(['like', 'kelulusan_akademi', $this->kelulusan_akademi])
            ->andFilterWhere(['like', 'nama_kelulusan', $this->nama_kelulusan])
            ->andFilterWhere(['like', 'kelulusan_sukan_spesifik', $this->kelulusan_sukan_spesifik])
            ->andFilterWhere(['like', 'nama_sukan_akademi', $this->nama_sukan_akademi])
            ->andFilterWhere(['like', 'kelulusan_sains_sukan', $this->kelulusan_sains_sukan])
            ->andFilterWhere(['like', 'sijil_spkk_msn', $this->sijil_spkk_msn])
            ->andFilterWhere(['like', 'lesen_kejurulatihan_msn', $this->lesen_kejurulatihan_msn])
            ->andFilterWhere(['like', 'status_jurulatih', $this->status_jurulatih])
            ->andFilterWhere(['like', 'lantikan', $this->lantikan])
            ->andFilterWhere(['like', 'nama_sukan_jurulatih', $this->nama_sukan_jurulatih])
            ->andFilterWhere(['like', 'pencapaian', $this->pencapaian])
                ->andFilterWhere(['like', 'tbl_ref_kelulusan.desc', $this->kelulusan]);

        return $dataProvider;
    }
}
