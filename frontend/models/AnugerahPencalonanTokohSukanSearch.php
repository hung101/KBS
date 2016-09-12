<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AnugerahPencalonanTokohSukan;

/**
 * AnugerahPencalonanTokohSukanSearch represents the model behind the search form about `app\models\AnugerahPencalonanTokohSukan`.
 */
class AnugerahPencalonanTokohSukanSearch extends AnugerahPencalonanTokohSukan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['anugerah_pencalonan_lain_id', 'created_by', 'updated_by'], 'integer'],
            [['kategori', 'nama', 'gambar', 'no_kad_pengenalan', 'no_tel_1', 'no_tel_2', 'sumbangan_dalam_pencapaian', 'ulasan_justifikasi', 'created', 'updated'], 'safe'],
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
        $query = AnugerahPencalonanTokohSukan::find()
                ->joinWith(['refKategoriPencalonanLain']);

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
            'anugerah_pencalonan_lain_id' => $this->anugerah_pencalonan_lain_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_kategori_pencalonan_lain.desc', $this->kategori])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'gambar', $this->gambar])
            ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
            ->andFilterWhere(['like', 'no_tel_1', $this->no_tel_1])
            ->andFilterWhere(['like', 'no_tel_2', $this->no_tel_2])
            ->andFilterWhere(['like', 'sumbangan_dalam_pencapaian', $this->sumbangan_dalam_pencapaian])
            ->andFilterWhere(['like', 'ulasan_justifikasi', $this->ulasan_justifikasi]);

        return $dataProvider;
    }
}
