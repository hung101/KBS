<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SoalanPenilaian;

/**
 * SoalanPenilaianSearch represents the model behind the search form about `app\models\SoalanPenilaian`.
 */
class SoalanPenilaianSearch extends SoalanPenilaian
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['soalan_penilaian_id', 'borang_penilaian_id', 'jawapan'], 'integer'],
            [['bahagian', 'soalan'], 'safe'],
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
        $query = SoalanPenilaian::find();

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
            'soalan_penilaian_id' => $this->soalan_penilaian_id,
            'borang_penilaian_id' => $this->borang_penilaian_id,
            'jawapan' => $this->jawapan,
        ]);

        $query->andFilterWhere(['like', 'bahagian', $this->bahagian])
            ->andFilterWhere(['like', 'soalan', $this->soalan]);

        return $dataProvider;
    }
}
