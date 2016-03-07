<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FarmasiPengurusanStok;

/**
 * FarmasiPengurusanStokSearch represents the model behind the search form about `app\models\FarmasiPengurusanStok`.
 */
class FarmasiPengurusanStokSearch extends FarmasiPengurusanStok
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['farmasi_pengurusan_stok', 'kuantiti'], 'integer'],
            [['nama_ubat', 'dos'], 'safe'],
            [['harga', 'jumlah_harga'], 'number'],
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
        $query = FarmasiPengurusanStok::find();

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
            'farmasi_pengurusan_stok' => $this->farmasi_pengurusan_stok,
            'harga' => $this->harga,
            'kuantiti' => $this->kuantiti,
            'jumlah_harga' => $this->jumlah_harga,
        ]);

        $query->andFilterWhere(['like', 'nama_ubat', $this->nama_ubat])
            ->andFilterWhere(['like', 'dos', $this->dos]);

        return $dataProvider;
    }
}
