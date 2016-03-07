<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PaobsPenganjur;

/**
 * PaobsPenganjurSearch represents the model behind the search form about `app\models\PaobsPenganjur`.
 */
class PaobsPenganjurSearch extends PaobsPenganjur
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penganjur_id', 'penganjuran_id', 'no_telefon_penganjur', 'no_faks_penganjur', 'bilangan_peserta', 'negara_peserta'], 'integer'],
            [['profil_syarikat', 'nama_penganjur', 'no_pendaftaran_syarikat', 'tarikh_penubuhan_syarikat', 'sijil_pendaftaran', 'alamat_penganjur_1', 'emel_penganjur', 'kertas_cadangan_pelaksanaan', 'nama_aktiviti', 'jenis_sukan', 'tarikh_aktiviti', 'alamat_lokasi', 'pemilik_lokasi', 'surat_sokongan', 'laporan_penganjuran'], 'safe'],
            [['kos_aktiviti', 'sumber_kewangan'], 'number'],
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
        $query = PaobsPenganjur::find()
                ->joinWith(['refSukan']);

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
            'penganjur_id' => $this->penganjur_id,
            'penganjuran_id' => $this->penganjuran_id,
            'tarikh_penubuhan_syarikat' => $this->tarikh_penubuhan_syarikat,
            'no_telefon_penganjur' => $this->no_telefon_penganjur,
            'no_faks_penganjur' => $this->no_faks_penganjur,
            'tarikh_aktiviti' => $this->tarikh_aktiviti,
            'bilangan_peserta' => $this->bilangan_peserta,
            'negara_peserta' => $this->negara_peserta,
            'kos_aktiviti' => $this->kos_aktiviti,
            'sumber_kewangan' => $this->sumber_kewangan,
        ]);

        $query->andFilterWhere(['like', 'profil_syarikat', $this->profil_syarikat])
            ->andFilterWhere(['like', 'nama_penganjur', $this->nama_penganjur])
            ->andFilterWhere(['like', 'no_pendaftaran_syarikat', $this->no_pendaftaran_syarikat])
            ->andFilterWhere(['like', 'sijil_pendaftaran', $this->sijil_pendaftaran])
            ->andFilterWhere(['like', 'alamat_penganjur_1', $this->alamat_penganjur_1])
            ->andFilterWhere(['like', 'emel_penganjur', $this->emel_penganjur])
            ->andFilterWhere(['like', 'kertas_cadangan_pelaksanaan', $this->kertas_cadangan_pelaksanaan])
            ->andFilterWhere(['like', 'nama_aktiviti', $this->nama_aktiviti])
            ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->jenis_sukan])
            ->andFilterWhere(['like', 'alamat_lokasi', $this->alamat_lokasi])
            ->andFilterWhere(['like', 'pemilik_lokasi', $this->pemilik_lokasi])
            ->andFilterWhere(['like', 'surat_sokongan', $this->surat_sokongan])
            ->andFilterWhere(['like', 'laporan_penganjuran', $this->laporan_penganjuran]);

        return $dataProvider;
    }
}
