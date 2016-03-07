<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SenaraiAtlet;

/**
 * SenaraiAtletSearch represents the model behind the search form about `app\models\SenaraiAtlet`.
 */
class SenaraiAtletSearch extends SenaraiAtlet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['senarai_atlet_id', 'pengurusan_jkk_jkp_program_id'], 'integer'],
            [['atlet', 'session_id'], 'safe'],
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
        $query = SenaraiAtlet::find()
                ->joinWith(['refAtlet']);

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
            'senarai_atlet_id' => $this->senarai_atlet_id,
            'pengurusan_jkk_jkp_program_id' => $this->pengurusan_jkk_jkp_program_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
