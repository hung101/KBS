<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanPerhimpunanKemPeserta;

/**
 * PengurusanPerhimpunanKemPesertaSearch represents the model behind the search form about `app\models\PengurusanPerhimpunanKemPeserta`.
 */
class PengurusanPerhimpunanKemPesertaSearch extends PengurusanPerhimpunanKemPeserta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_perhimpunan_kem_peserta_id', 'pengurusan_perhimpunan_kem_id'], 'integer'],
            [['nama_peserta', 'kategori_peserta', 'jawatan', 'session_id'], 'safe'],
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
        $query = PengurusanPerhimpunanKemPeserta::find()
                ->joinWith(['refKategoriPesertaPerhimpunanKem'])
                ->joinWith(['refJawatanPesertaPerhimpunanKem']);

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
            'pengurusan_perhimpunan_kem_peserta_id' => $this->pengurusan_perhimpunan_kem_peserta_id,
            'pengurusan_perhimpunan_kem_id' => $this->pengurusan_perhimpunan_kem_id,
        ]);

        $query->andFilterWhere(['like', 'nama_peserta', $this->nama_peserta])
            ->andFilterWhere(['like', 'kategori_peserta', $this->kategori_peserta])
            ->andFilterWhere(['like', 'jawatan', $this->jawatan])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
