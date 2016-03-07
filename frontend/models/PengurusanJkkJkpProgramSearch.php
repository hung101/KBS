<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanJkkJkpProgram;

/**
 * PengurusanJkkJkpProgramSearch represents the model behind the search form about `app\models\PengurusanJkkJkpProgram`.
 */
class PengurusanJkkJkpProgramSearch extends PengurusanJkkJkpProgram
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_jkk_jkp_program_id', 'pengurusan_jkk_jkp_id'], 'integer'],
            [['tarikh_mula_program', 'tarikh_tamat_program', 'lokasi_program', 'nama_program', 'nama_pesserta'], 'safe'],
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
        $query = PengurusanJkkJkpProgram::find();

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
            'pengurusan_jkk_jkp_program_id' => $this->pengurusan_jkk_jkp_program_id,
            'pengurusan_jkk_jkp_id' => $this->pengurusan_jkk_jkp_id,
            'tarikh_mula_program' => $this->tarikh_mula_program,
            'tarikh_tamat_program' => $this->tarikh_tamat_program,
        ]);

        $query->andFilterWhere(['like', 'lokasi_program', $this->lokasi_program])
            ->andFilterWhere(['like', 'nama_program', $this->nama_program])
            ->andFilterWhere(['like', 'nama_pesserta', $this->nama_pesserta]);

        return $dataProvider;
    }
}
