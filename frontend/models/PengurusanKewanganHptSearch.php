<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanKewanganHpt;

/**
 * PengurusanKewanganHptSearch represents the model behind the search form about `app\models\PengurusanKewanganHpt`.
 */
class PengurusanKewanganHptSearch extends PengurusanKewanganHpt
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_kewangan_id'], 'integer'],
            [['nama_acara_program', 'tarikh_acara', 'kategori_acara', 'objektif', 'kategori_penggunaan', 'catatan'], 'safe'],
            [['harga_penggunaan', 'jumlah_bajet', 'jumlah_penggunaan', 'bajet_keseluruhan', 'penggunaan_keseluruhan', 'baki'], 'number'],
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
        $query = PengurusanKewanganHpt::find()
                ->joinWith(['refSukan'])
                ->joinWith(['refKategoriPenggunaan']);

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
            'pengurusan_kewangan_id' => $this->pengurusan_kewangan_id,
            'tarikh_acara' => $this->tarikh_acara,
            'harga_penggunaan' => $this->harga_penggunaan,
            'jumlah_bajet' => $this->jumlah_bajet,
            'jumlah_penggunaan' => $this->jumlah_penggunaan,
            'bajet_keseluruhan' => $this->bajet_keseluruhan,
            'penggunaan_keseluruhan' => $this->penggunaan_keseluruhan,
            'baki' => $this->baki,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->nama_acara_program])
            ->andFilterWhere(['like', 'kategori_acara', $this->kategori_acara])
            ->andFilterWhere(['like', 'objektif', $this->objektif])
            ->andFilterWhere(['like', 'tbl_ref_kategori_penggunaan_hpt.desc', $this->kategori_penggunaan])
            ->andFilterWhere(['like', 'catatan', $this->catatan]);

        return $dataProvider;
    }
}
