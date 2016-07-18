<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PaobsPenganjuran;

/**
 * PaobsPenganjuranSearch represents the model behind the search form about `app\models\PaobsPenganjuran`.
 */
class PaobsPenganjuranSearch extends PaobsPenganjuran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penganjuran_id', 'bilangan_peserta', 'negara_peserta'], 'integer'],
            [['nama_aktiviti', 'jenis_sukan', 'tarikh_aktiviti', 'tarikh_tamat_aktiviti', 'alamat_lokasi_1', 'pemilik_lokasi', 'sumber_kewangan', 'surat_sokongan', 'laporan_penganjuran'], 'safe'],
            [['kos_aktiviti'], 'number'],
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
        $query = PaobsPenganjuran::find()
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
            'penganjuran_id' => $this->penganjuran_id,
            //'tarikh_aktiviti' => $this->tarikh_aktiviti,
            'bilangan_peserta' => $this->bilangan_peserta,
            'negara_peserta' => $this->negara_peserta,
            'kos_aktiviti' => $this->kos_aktiviti,
        ]);

        $query->andFilterWhere(['like', 'nama_aktiviti', $this->nama_aktiviti])
            ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->jenis_sukan])
            ->andFilterWhere(['like', 'alamat_lokasi_1', $this->alamat_lokasi_1])
            ->andFilterWhere(['like', 'pemilik_lokasi', $this->pemilik_lokasi])
            ->andFilterWhere(['like', 'sumber_kewangan', $this->sumber_kewangan])
            ->andFilterWhere(['like', 'surat_sokongan', $this->surat_sokongan])
            ->andFilterWhere(['like', 'laporan_penganjuran', $this->laporan_penganjuran])
                ->andFilterWhere(['like', 'tarikh_aktiviti', $this->tarikh_aktiviti])
                ->andFilterWhere(['like', 'tarikh_tamat_aktiviti', $this->tarikh_tamat_aktiviti]);

        return $dataProvider;
    }
}
