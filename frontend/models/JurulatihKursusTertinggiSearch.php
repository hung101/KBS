<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JurulatihKursusTertinggi;

/**
 * JurulatihKursusTertinggiSearch represents the model behind the search form about `app\models\JurulatihKursusTertinggi`.
 */
class JurulatihKursusTertinggiSearch extends JurulatihKursusTertinggi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kursus_tertinggi_id', 'jurulatih_id'], 'integer'],
            [['tahun', 'kursus'], 'safe'],
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
        $query = JurulatihKursusTertinggi::find();

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
            'kursus_tertinggi_id' => $this->kursus_tertinggi_id,
            'jurulatih_id' => $this->jurulatih_id,
            'tahun' => $this->tahun,
        ]);

        $query->andFilterWhere(['like', 'kursus', $this->kursus]);

        return $dataProvider;
    }
}
