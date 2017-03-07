<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LaporanPemantauanJurulatihKategori;

/**
 * LaporanPemantauanJurulatihKategoriSearch represents the model behind the search form about `app\models\LaporanPemantauanJurulatihKategori`.
 */
class LaporanPemantauanJurulatihKategoriSearch extends LaporanPemantauanJurulatihKategori
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['laporan_pemantauan_jurulatih_kategori_id', 'laporan_pemantauan_jurulatih_id', 'penilaian_kategori', 'penilaian_sub_kategori'], 'integer'],
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
        $query = LaporanPemantauanJurulatihKategori::find()
                ->joinWith(['refKategoriLaporanPenilaianJurulatih'])
                ->joinWith(['refSubKategoriLaporanPenilaianJurulatih']);

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
            'laporan_pemantauan_jurulatih_kategori_id' => $this->laporan_pemantauan_jurulatih_kategori_id,
            'laporan_pemantauan_jurulatih_id' => $this->laporan_pemantauan_jurulatih_id,
        ]);

        // $query->andFilterWhere(['like', 'tbl_ref_kategori_penilaian_jurulatih.desc', $this->penilaian_kategori])
            // ->andFilterWhere(['like', 'tbl_ref_sub_kategori_penilaian_jurulatih.desc', $this->penilaian_sub_kategori])
                $query->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
