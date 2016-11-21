<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KhidmatPerubatanDanSainsSukanAtlet;

/**
 * KhidmatPerubatanDanSainsSukanAtletSearch represents the model behind the search form about `app\models\KhidmatPerubatanDanSainsSukanAtlet`.
 */
class KhidmatPerubatanDanSainsSukanAtletSearch extends KhidmatPerubatanDanSainsSukanAtlet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['khidmat_perubatan_dan_sains_sukan_atlet_id', 'khidmat_perubatan_dan_sains_sukan_id', 'program', 'sukan', 'atlet', 'created_by', 'updated_by'], 'integer'],
            [['session_id', 'created', 'updated'], 'safe'],
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
        $query = KhidmatPerubatanDanSainsSukanAtlet::find();

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
            'khidmat_perubatan_dan_sains_sukan_atlet_id' => $this->khidmat_perubatan_dan_sains_sukan_atlet_id,
            'khidmat_perubatan_dan_sains_sukan_id' => $this->khidmat_perubatan_dan_sains_sukan_id,
            'program' => $this->program,
            'sukan' => $this->sukan,
            'atlet' => $this->atlet,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
