<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BiomekanikAnthropometrics;

/**
 * BiomekanikAnthropometricsSearch represents the model behind the search form about `app\models\BiomekanikAnthropometrics`.
 */
class BiomekanikAnthropometricsSearch extends BiomekanikAnthropometrics
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['biomekanik_anthropometrics_id', 'perkhidmatan_analisa_perlawanan_biomekanik_id'], 'integer'],
            [['anthropometrics', 'session_id'], 'safe'],
            [['cm_kg'], 'number'],
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
        $query = BiomekanikAnthropometrics::find()
                ->joinWith(['refAnthropometricsUjian']);

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
            'biomekanik_anthropometrics_id' => $this->biomekanik_anthropometrics_id,
            'perkhidmatan_analisa_perlawanan_biomekanik_id' => $this->perkhidmatan_analisa_perlawanan_biomekanik_id,
            'cm_kg' => $this->cm_kg,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_anthropometrics_ujian.desc', $this->anthropometrics])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
