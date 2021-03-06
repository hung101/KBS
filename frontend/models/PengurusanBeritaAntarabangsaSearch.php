<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanBeritaAntarabangsa;

/**
 * PengurusanBeritaAntarabangsaSearch represents the model behind the search form about `app\models\PengurusanBeritaAntarabangsa`.
 */
class PengurusanBeritaAntarabangsaSearch extends PengurusanBeritaAntarabangsa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_berita_antarabangsa_id', 'no_telefon'], 'integer'],
            [['kategori_berita', 'nama_berita', 'tarikh_berita', 'muatnaik', 'nama_negara', 'nama_pegawai_embassy'], 'safe'],
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
        $query = PengurusanBeritaAntarabangsa::find()
                ->joinWith(['refKategoriBerita'])
                ->joinWith(['refNegara']);

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
            'pengurusan_berita_antarabangsa_id' => $this->pengurusan_berita_antarabangsa_id,
            'tarikh_berita' => $this->tarikh_berita,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_kategori_berita.desc', $this->kategori_berita])
            ->andFilterWhere(['like', 'nama_berita', $this->nama_berita])
            ->andFilterWhere(['like', 'muatnaik', $this->muatnaik])
                ->andFilterWhere(['like', 'tbl_ref_negara.desc', $this->nama_negara])
                ->andFilterWhere(['like', 'nama_pegawai_embassy', $this->nama_pegawai_embassy])
                ->andFilterWhere(['like', 'no_telefon', $this->no_telefon]);

        return $dataProvider;
    }
}
