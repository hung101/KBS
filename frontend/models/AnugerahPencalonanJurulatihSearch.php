<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AnugerahPencalonanJurulatih;

/**
 * AnugerahPencalonanJurulatihSearch represents the model behind the search form about `app\models\AnugerahPencalonanJurulatih`.
 */
class AnugerahPencalonanJurulatihSearch extends AnugerahPencalonanJurulatih
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['anugerah_pencalonan_jurulatih_id', 'kategori', 'sijil_kejurulatihan_spesifik', 'kelulusan', 'created_by', 'updated_by'], 'integer'],
            [['sukan', 'nama_jurulatih', 'no_kad_pengenalan', 'no_telefon_1', 'no_telefon_2', 'ulasan_pencapaian', 'created', 'updated'], 'safe'],
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
        $query = AnugerahPencalonanJurulatih::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'anugerah_pencalonan_jurulatih_id' => $this->anugerah_pencalonan_jurulatih_id,
            'kategori' => $this->kategori,
            'sijil_kejurulatihan_spesifik' => $this->sijil_kejurulatihan_spesifik,
            'kelulusan' => $this->kelulusan,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'sukan', $this->sukan])
            ->andFilterWhere(['like', 'nama_jurulatih', $this->nama_jurulatih])
            ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
            ->andFilterWhere(['like', 'no_telefon_1', $this->no_telefon_1])
            ->andFilterWhere(['like', 'no_telefon_2', $this->no_telefon_2])
            ->andFilterWhere(['like', 'ulasan_pencapaian', $this->ulasan_pencapaian]);

        return $dataProvider;
    }
}
