<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Satelit;

/**
 * SatelitSearch represents the model behind the search form about `app\models\Satelit`.
 */
class SatelitSearch extends Satelit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['satelit_id'], 'integer'],
            [['tarikh', 'sukan', 'perkhidmatan', 'fasiliti', 'atlet_id'], 'safe'],
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
        $query = Satelit::find()->joinWith(['refAtlet'])
                ->joinWith(['refSukan'])
                ->joinWith(['refPerkhidmatanSatelit']);

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
            'satelit_id' => $this->satelit_id,
            //'atlet_id' => $this->atlet_id,
            'tarikh' => $this->tarikh,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->sukan])
            ->andFilterWhere(['like', 'tbl_ref_perkhidmatan_satelit.desc', $this->perkhidmatan])
                ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id])
            ->andFilterWhere(['like', 'fasiliti', $this->fasiliti]);

        return $dataProvider;
    }
}
