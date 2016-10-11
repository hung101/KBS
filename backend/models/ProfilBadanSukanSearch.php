<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProfilBadanSukan;

/**
 * ProfilBadanSukanSearch represents the model behind the search form about `app\models\ProfilBadanSukan`.
 */
class ProfilBadanSukanSearch extends ProfilBadanSukan
{
    public $status_id;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profil_badan_sukan', 'no_telefon_pejabat', 'no_faks_pejabat', 'status_id'], 'integer'],
            [['nama_badan_sukan', 'nama_badan_sukan_sebelum_ini', 'no_pendaftaran_sijil_pendaftaran', 'tarikh_lulus_pendaftaran', 'jenis_sukan', 
                'alamat_tetap_badan_sukan_1', 'alamat_surat_menyurat_badan_sukan_1', 'emel_badan_sukan', 'pengiktirafan_yang_pernah_diterima_badan_sukan',
                'status'], 'safe'],
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
        $query = ProfilBadanSukan::find()
                ->joinWith(['refStatusLaporanMesyuaratAgung']);

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
            'profil_badan_sukan' => $this->profil_badan_sukan,
            //'tarikh_lulus_pendaftaran' => $this->tarikh_lulus_pendaftaran,
            'no_telefon_pejabat' => $this->no_telefon_pejabat,
            'no_faks_pejabat' => $this->no_faks_pejabat,
            'status' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'nama_badan_sukan', $this->nama_badan_sukan])
            ->andFilterWhere(['like', 'nama_badan_sukan_sebelum_ini', $this->nama_badan_sukan_sebelum_ini])
            ->andFilterWhere(['like', 'no_pendaftaran_sijil_pendaftaran', $this->no_pendaftaran_sijil_pendaftaran])
            ->andFilterWhere(['like', 'jenis_sukan', $this->jenis_sukan])
            ->andFilterWhere(['like', 'alamat_tetap_badan_sukan_1', $this->alamat_tetap_badan_sukan_1])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_badan_sukan_1', $this->alamat_surat_menyurat_badan_sukan_1])
            ->andFilterWhere(['like', 'emel_badan_sukan', $this->emel_badan_sukan])
            ->andFilterWhere(['like', 'pengiktirafan_yang_pernah_diterima_badan_sukan', $this->pengiktirafan_yang_pernah_diterima_badan_sukan])
                ->andFilterWhere(['like', 'tarikh_lulus_pendaftaran', $this->tarikh_lulus_pendaftaran])
                ->andFilterWhere(['like', 'tbl_ref_status_laporan_mesyuarat_agung.desc', $this->status]);

        return $dataProvider;
    }
}
