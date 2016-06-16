<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AnugerahPencalonanPasukan;

/**
 * AnugerahPencalonanPasukanSearch represents the model behind the search form about `app\models\AnugerahPencalonanPasukan`.
 */
class AnugerahPencalonanPasukanSearch extends AnugerahPencalonanPasukan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['anugerah_pencalonan_pasukan_id', 'created_by', 'updated_by'], 'integer'],
            [['kategori', 'sukan', 'nama_pasukan', 'gambar_pasukan', 'ulasan_pencapaian', 'created', 'updated'], 'safe'],
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
        $query = AnugerahPencalonanPasukan::find();

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
            'anugerah_pencalonan_pasukan_id' => $this->anugerah_pencalonan_pasukan_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'kategori', $this->kategori])
            ->andFilterWhere(['like', 'sukan', $this->sukan])
            ->andFilterWhere(['like', 'nama_pasukan', $this->nama_pasukan])
            ->andFilterWhere(['like', 'gambar_pasukan', $this->gambar_pasukan])
            ->andFilterWhere(['like', 'ulasan_pencapaian', $this->ulasan_pencapaian]);

        return $dataProvider;
    }
}
