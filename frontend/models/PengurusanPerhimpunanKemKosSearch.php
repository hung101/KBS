<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanPerhimpunanKemKos;

/**
 * PengurusanPerhimpunanKemKosSearch represents the model behind the search form about `app\models\PengurusanPerhimpunanKemKos`.
 */
class PengurusanPerhimpunanKemKosSearch extends PengurusanPerhimpunanKemKos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_perhimpunan_kem_kos_id', 'pengurusan_perhimpunan_kem_id'], 'integer'],
            [['kategori_kos', 'catatan', 'session_id'], 'safe'],
            [['anggaran_kos_per_kategori', 'revised_kos_per_kategori', 'approved_kos_per_kategori'], 'number'],
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
        $query = PengurusanPerhimpunanKemKos::find()
                ->joinWith(['refKategoriKosPerhimpunanKem']);

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
            'pengurusan_perhimpunan_kem_kos_id' => $this->pengurusan_perhimpunan_kem_kos_id,
            'pengurusan_perhimpunan_kem_id' => $this->pengurusan_perhimpunan_kem_id,
            'anggaran_kos_per_kategori' => $this->anggaran_kos_per_kategori,
            'revised_kos_per_kategori' => $this->revised_kos_per_kategori,
            'approved_kos_per_kategori' => $this->approved_kos_per_kategori,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_kategori_kos_perhimpunan_kem.desc', $this->kategori_kos])
            ->andFilterWhere(['like', 'catatan', $this->catatan])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
