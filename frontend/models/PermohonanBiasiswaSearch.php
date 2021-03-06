<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanBiasiswa;

/**
 * PermohonanBiasiswaSearch represents the model behind the search form about `app\models\PermohonanBiasiswa`.
 */
class PermohonanBiasiswaSearch extends PermohonanBiasiswa
{
    public $atlet;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_biasiswa_id', 'umur', 'atlet'], 'integer'],
            [['no_ic', 'created', 'atlet_id', 'sukan', 'kelulusan', 'jantina', 'alamat_rumah_1', 'alamat_rumah_2', 
                'alamat_rumah_3', 'alamat_rumah_negeri', 'alamat_rumah_bandar', 'alamat_rumah_poskod', 'no_tel_rumah', 
                'no_tel_bimbit', 'alamat_pengajian_1', 'alamat_pengajian_2', 'alamat_pengajian_3', 'alamat_pengajian_negeri', 
                'alamat_pengajian_bandar', 'alamat_pengajian_poskod', 'no_tel_pengajian', 'no_fax_pengajian', 'jenis_biasiswa', 
                'muatnaik', 'program', 'kategori', 'kadar', 'nama_institusi_pengajian'], 'safe'],
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
        $query = PermohonanBiasiswa::find()
                ->joinWith(['refAtlet'])
                ->joinWith(['refSukan'])
                ->joinWith(['refJantina'])
                ->joinWith(['refJenisBiasiswa'])
                ->joinWith(['refKelulusan'])
                ->joinWith(['refProgramSemasaSukanAtlet'])
                ->joinWith(['refKategoriBiasiswa']);

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
            'permohonan_biasiswa_id' => $this->permohonan_biasiswa_id,
            'tbl_permohonan_biasiswa.atlet_id' => $this->atlet,
            //'sukan' => $this->sukan,
            'tbl_permohonan_biasiswa.umur' => $this->umur,
            //'kelulusan' => $this->kelulusan,
        ]);

        $query->andFilterWhere(['like', 'sukan', $this->sukan])
                ->andFilterWhere(['like', 'no_ic', $this->no_ic])
            ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id])
            ->andFilterWhere(['like', 'tbl_ref_jantina.desc', $this->jantina])
            ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->sukan])
            ->andFilterWhere(['like', 'alamat_rumah_1', $this->alamat_rumah_1])
            ->andFilterWhere(['like', 'alamat_rumah_2', $this->alamat_rumah_2])
            ->andFilterWhere(['like', 'alamat_rumah_3', $this->alamat_rumah_3])
            ->andFilterWhere(['like', 'alamat_rumah_negeri', $this->alamat_rumah_negeri])
            ->andFilterWhere(['like', 'alamat_rumah_bandar', $this->alamat_rumah_bandar])
            ->andFilterWhere(['like', 'alamat_rumah_poskod', $this->alamat_rumah_poskod])
            ->andFilterWhere(['like', 'no_tel_rumah', $this->no_tel_rumah])
            ->andFilterWhere(['like', 'no_tel_bimbit', $this->no_tel_bimbit])
            ->andFilterWhere(['like', 'alamat_pengajian_1', $this->alamat_pengajian_1])
            ->andFilterWhere(['like', 'alamat_pengajian_2', $this->alamat_pengajian_2])
            ->andFilterWhere(['like', 'alamat_pengajian_3', $this->alamat_pengajian_3])
            ->andFilterWhere(['like', 'alamat_pengajian_negeri', $this->alamat_pengajian_negeri])
            ->andFilterWhere(['like', 'alamat_pengajian_bandar', $this->alamat_pengajian_bandar])
            ->andFilterWhere(['like', 'alamat_pengajian_poskod', $this->alamat_pengajian_poskod])
            ->andFilterWhere(['like', 'no_tel_pengajian', $this->no_tel_pengajian])
            ->andFilterWhere(['like', 'no_fax_pengajian', $this->no_fax_pengajian])
            ->andFilterWhere(['like', 'tbl_ref_jenis_biasiswa.desc', $this->jenis_biasiswa])
                ->andFilterWhere(['like', 'tbl_ref_kelulusan.desc', $this->kelulusan])
            ->andFilterWhere(['like', 'muatnaik', $this->muatnaik])
                ->andFilterWhere(['like', 'created', $this->created])
                ->andFilterWhere(['like', 'tbl_ref_program_semasa_sukan_atlet.desc', $this->program])
                ->andFilterWhere(['like', 'tbl_ref_kategori_biasiswa.desc', $this->kategori]);

        return $dataProvider;
    }
}
