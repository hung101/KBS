<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanProgramBinaan;

/**
 * PengurusanProgramBinaanSearch represents the model behind the search form about `app\models\PengurusanProgramBinaan`.
 */
class PengurusanProgramBinaanSearch extends PengurusanProgramBinaan
{
    public $status_permohonan_id;
    public $atlet_id;
    public $kategori_peserta;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jumlah_yang_diluluskan'], 'number'],
            [['pengurusan_program_binaan_id', 'status_permohonan_id', 'created_by', 'atlet_id', 'kategori_peserta'], 'integer'],
            [['nama_ppn', 'pengurus_pn', 'kategori_permohonan', 'jenis_permohonan', 'sukan', 'tempat', 'tahap', 'negeri', 'daerah', 'tarikh_mula', 'tarikh_tamat',
                'sokongan_pn', 'kelulusan', 'status_permohonan', 'aktiviti', 'nama_aktiviti'], 'safe'],
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
        $query = PengurusanProgramBinaan::find()
                ->joinWith(['refKategoriPermohonan'])
                ->joinWith(['refJenisPermohonan'])
                ->joinWith(['refSokongPn'])
                ->joinWith(['refKelulusanProgramBinaan'])
                ->joinWith(['refStatusPermohonanProgramBinaan'])
                ->joinWith(['refPerancanganProgram']);

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
            'pengurusan_program_binaan_id' => $this->pengurusan_program_binaan_id,
            //'sokongan_pn' => $this->sokongan_pn,
            //'kelulusan' => $this->kelulusan,
            'status_permohonan' => $this->status_permohonan_id,
            'tbl_pengurusan_program_binaan.created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'nama_ppn', $this->nama_ppn])
            ->andFilterWhere(['like', 'pengurus_pn', $this->pengurus_pn])
            ->andFilterWhere(['like', 'tbl_ref_kategori_permohonan_program_binaan.desc', $this->kategori_permohonan])
            ->andFilterWhere(['like', 'tbl_ref_jenis_permohonan_program_binaan.desc', $this->jenis_permohonan])
            ->andFilterWhere(['like', 'rk1.desc', $this->sokongan_pn])
            ->andFilterWhere(['like', 'rk2.desc', $this->kelulusan])
            ->andFilterWhere(['like', 'sukan', $this->sukan])
                ->andFilterWhere(['like', 'jumlah_yang_diluluskan', $this->jumlah_yang_diluluskan])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'tahap', $this->tahap])
            ->andFilterWhere(['like', 'negeri', $this->negeri])
            ->andFilterWhere(['like', 'daerah', $this->daerah])
                ->andFilterWhere(['like', 'nama_aktiviti', $this->nama_aktiviti])
                ->andFilterWhere(['like', 'tbl_ref_status_permohonan_program_binaan.desc', $this->status_permohonan])
                ->andFilterWhere(['like', 'tbl_perancangan_program.nama_program', $this->aktiviti])
                ->andFilterWhere(['like', 'tbl_pengurusan_program_binaan.tarikh_mula', $this->tarikh_mula])
                ->andFilterWhere(['like', 'tbl_pengurusan_program_binaan.tarikh_tamat', $this->tarikh_tamat]);

        return $dataProvider;
    }
}
