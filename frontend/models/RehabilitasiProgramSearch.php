<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RehabilitasiProgram;

/**
 * RehabilitasiProgramSearch represents the model behind the search form about `app\models\RehabilitasiProgram`.
 */
class RehabilitasiProgramSearch extends RehabilitasiProgram
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rehabilitasi_program_id', 'rehabilitasi_id'], 'integer'],
            [['tarikh', 'nama_exercise_modality'], 'safe'],
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
        $query = RehabilitasiProgram::find();

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
            'rehabilitasi_program_id' => $this->rehabilitasi_program_id,
            'rehabilitasi_id' => $this->rehabilitasi_id,
            'tarikh' => $this->tarikh,
        ]);

        $query->andFilterWhere(['like', 'nama_exercise_modality', $this->nama_exercise_modality]);

        return $dataProvider;
    }
}
