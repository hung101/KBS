<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MaklumatKongresDiLuarNegara;

/**
 * MaklumatKongresDiLuarNegaraSearch represents the model behind the search form about `app\models\MaklumatKongresDiLuarNegara`.
 */
class MaklumatKongresDiLuarNegaraSearch extends MaklumatKongresDiLuarNegara
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['maklumat_kongres_di_luar_negara_id', 'pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id'], 'integer'],
            [['tajuk', 'tempat', 'masa', 'tarikh_penerbangan', 'tiket_penerbangan', 'nama_pegawai_terlibat'], 'safe'],
            [['jumlah_penerbangan', 'lain_lain', 'jumlah_kos_lain_lain'], 'number'],
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
        $query = MaklumatKongresDiLuarNegara::find();

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
            'maklumat_kongres_di_luar_negara_id' => $this->maklumat_kongres_di_luar_negara_id,
            'pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id' => $this->pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id,
            'masa' => $this->masa,
            'tarikh_penerbangan' => $this->tarikh_penerbangan,
            'jumlah_penerbangan' => $this->jumlah_penerbangan,
            'lain_lain' => $this->lain_lain,
            'jumlah_kos_lain_lain' => $this->jumlah_kos_lain_lain,
        ]);

        $query->andFilterWhere(['like', 'tajuk', $this->tajuk])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'tiket_penerbangan', $this->tiket_penerbangan])
            ->andFilterWhere(['like', 'nama_pegawai_terlibat', $this->nama_pegawai_terlibat]);

        return $dataProvider;
    }
}
