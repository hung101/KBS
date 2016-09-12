<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AnugerahPencalonanAtlet;

/**
 * AnugerahPencalonanAtletSearch represents the model behind the search form about `app\models\AnugerahPencalonanAtlet`.
 */
class AnugerahPencalonanAtletSearch extends AnugerahPencalonanAtlet
{
    public $atlet_id;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['anugerah_pencalonan_atlet', 'sifat_kepimpinan_ketua_pasukan', 'sifat_kepimpinan_jurulatih', 'sifat_kepimpinan_asia_tenggara', 
                'sifat_kepimpinan_penolong_jurulatih', 'sifat_kepimpinan_pegawai_teknikal', 'memenangi_kategori_dalam_anugerah_sukan', 'kelulusan',
                'atlet_id'], 'integer'],
            [['nama_atlet', 'tahun_pencalonan', 'nama_sukan', 'nama_acara', 'status_pencalonan', 'kejayaan', 'ulasan_kejayaan', 'susan_ranking_kebangsaan', 'susan_ranking_asia', 
                'susan_ranking_asia_tenggara', 'susan_ranking_dunia', 'nama_sukan_sebelum_dicalon', 'mewakili', 'pencalonan_olahragawan_tahun', 'pencalonan_olahragawati_tahun', 
                'pencalonan_pasukan_lelaki_kebangsaan_tahun', 'pencalonan_pasukan_wanita_kebangsaan_tahun', 'pencalonan_olahragawan_harapan_tahun',
                'pencalonan_olahragawati_harapan_tahun', 'nama_kategori', 'tahun', 'kategori'], 'safe'],
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
        $query = AnugerahPencalonanAtlet::find()
                ->joinWith(['refSukan'])
                ->joinWith(['refAcara'])
                ->joinWith(['refKategoriPencalonanAtlet'])
                ->joinWith(['refAtlet']);

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
            'anugerah_pencalonan_atlet' => $this->anugerah_pencalonan_atlet,
            'tahun_pencalonan' => $this->tahun_pencalonan,
            'sifat_kepimpinan_ketua_pasukan' => $this->sifat_kepimpinan_ketua_pasukan,
            'sifat_kepimpinan_jurulatih' => $this->sifat_kepimpinan_jurulatih,
            'sifat_kepimpinan_asia_tenggara' => $this->sifat_kepimpinan_asia_tenggara,
            'sifat_kepimpinan_penolong_jurulatih' => $this->sifat_kepimpinan_penolong_jurulatih,
            'sifat_kepimpinan_pegawai_teknikal' => $this->sifat_kepimpinan_pegawai_teknikal,
            'memenangi_kategori_dalam_anugerah_sukan' => $this->memenangi_kategori_dalam_anugerah_sukan,
            'tahun' => $this->tahun,
            'kelulusan' => $this->kelulusan,
            'nama_atlet' => $this->atlet_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->nama_atlet])
            ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->nama_sukan])
            ->andFilterWhere(['like', 'tbl_ref_acara.desc', $this->nama_acara])
            ->andFilterWhere(['like', 'status_pencalonan', $this->status_pencalonan])
            ->andFilterWhere(['like', 'kejayaan', $this->kejayaan])
            ->andFilterWhere(['like', 'ulasan_kejayaan', $this->ulasan_kejayaan])
            ->andFilterWhere(['like', 'susan_ranking_kebangsaan', $this->susan_ranking_kebangsaan])
            ->andFilterWhere(['like', 'susan_ranking_asia', $this->susan_ranking_asia])
            ->andFilterWhere(['like', 'susan_ranking_asia_tenggara', $this->susan_ranking_asia_tenggara])
            ->andFilterWhere(['like', 'susan_ranking_dunia', $this->susan_ranking_dunia])
            ->andFilterWhere(['like', 'nama_sukan_sebelum_dicalon', $this->nama_sukan_sebelum_dicalon])
            ->andFilterWhere(['like', 'mewakili', $this->mewakili])
            ->andFilterWhere(['like', 'pencalonan_olahragawan_tahun', $this->pencalonan_olahragawan_tahun])
            ->andFilterWhere(['like', 'pencalonan_olahragawati_tahun', $this->pencalonan_olahragawati_tahun])
            ->andFilterWhere(['like', 'pencalonan_pasukan_lelaki_kebangsaan_tahun', $this->pencalonan_pasukan_lelaki_kebangsaan_tahun])
            ->andFilterWhere(['like', 'pencalonan_pasukan_wanita_kebangsaan_tahun', $this->pencalonan_pasukan_wanita_kebangsaan_tahun])
            ->andFilterWhere(['like', 'pencalonan_olahragawan_harapan_tahun', $this->pencalonan_olahragawan_harapan_tahun])
            ->andFilterWhere(['like', 'pencalonan_olahragawati_harapan_tahun', $this->pencalonan_olahragawati_harapan_tahun])
            ->andFilterWhere(['like', 'nama_kategori', $this->nama_kategori])
                ->andFilterWhere(['like', 'tbl_ref_kategori_pencalonan_atlet.desc', $this->kategori]);

        return $dataProvider;
    }
}
