<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanPenilaianKategoriJurulatihKetua;

/**
 * PengurusanPenilaianKategoriJurulatihKetuaSearch represents the model behind the search form about `app\models\PengurusanPenilaianKategoriJurulatihKetua`.
 */
class PengurusanPenilaianKategoriJurulatihKetuaSearch extends PengurusanPenilaianKategoriJurulatihKetua
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_penilaian_kategori_jurulatih_id', 'pengurusan_pemantauan_dan_penilaian_jurulatih_id', 'markah_penilaian'], 'integer'],
            [['penilaian_kategori', 'penilaian_sub_kategori', 'session_id'], 'safe'],
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
        $query = PengurusanPenilaianKategoriJurulatihKetua::find()
                ->joinWith(['refKategoriPenilaianJurulatih'])
                ->joinWith(['refSubKategoriPenilaianJurulatih']);

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
            'pengurusan_penilaian_kategori_jurulatih_id' => $this->pengurusan_penilaian_kategori_jurulatih_id,
            'pengurusan_pemantauan_dan_penilaian_jurulatih_id' => $this->pengurusan_pemantauan_dan_penilaian_jurulatih_id,
            'markah_penilaian' => $this->markah_penilaian,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_kategori_penilaian_jurulatih.desc', $this->penilaian_kategori])
            ->andFilterWhere(['like', 'tbl_ref_sub_kategori_penilaian_jurulatih.desc', $this->penilaian_sub_kategori])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
