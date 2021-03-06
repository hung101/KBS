<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SixStep;

/**
 * SixStepSearch represents the model behind the search form about `app\models\SixStep`.
 */
class SixStepSearch extends SixStep
{
    public $atlet;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['six_step_id', 'atlet'], 'integer'],
            [['stage', 'status', 'atlet_id'], 'safe'],
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
        $query = SixStep::find()
                ->joinWith(['atlet'])
                ->joinWith(['refSixStepStage'])
                ->joinWith(['refSixStepStatus']);

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
            'six_step_id' => $this->six_step_id,
            'tbl_six_step.atlet_id' => $this->atlet,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_sixstep_stage.desc', $this->stage])
                ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id])
            ->andFilterWhere(['like', 'tbl_ref_sixstep_status.desc', $this->status]);

        return $dataProvider;
    }
}
