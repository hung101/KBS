<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RefSukan;

/**
 * RefSukanSearch represents the model behind the search form about `app\models\RefSukan`.
 */
class RefSukanSearch extends RefSukan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ref_sukan_id', 'aktif'], 'integer'],
            [['nama_sukan'], 'safe'],
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
        $query = RefSukan::find();

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
            'ref_sukan_id' => $this->ref_sukan_id,
            'aktif' => $this->aktif,
        ]);

        $query->andFilterWhere(['like', 'nama_sukan', $this->nama_sukan]);

        return $dataProvider;
    }
}
