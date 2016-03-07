<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RefKategoriSukan;

/**
 * RefKategoriSukanSearch represents the model behind the search form about `app\models\RefKategoriSukan`.
 */
class RefKategoriSukanSearch extends RefKategoriSukan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ref_kategori_sukan_id', 'aktif'], 'integer'],
            [['nama_kategori_sukan'], 'safe'],
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
        $query = RefKategoriSukan::find();

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
            'ref_kategori_sukan_id' => $this->ref_kategori_sukan_id,
            'aktif' => $this->aktif,
        ]);

        $query->andFilterWhere(['like', 'nama_kategori_sukan', $this->nama_kategori_sukan]);

        return $dataProvider;
    }
}
