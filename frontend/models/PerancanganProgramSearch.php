<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PerancanganProgram;

/**
 * PerancanganProgramSearch represents the model behind the search form about `app\models\PerancanganProgram`.
 */
class PerancanganProgramSearch extends PerancanganProgram
{
    public $status_program_id;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['perancangan_program_id', 'status_program_id'], 'integer'],
            [['tarikh_tamat', 'nama_program', 'muat_naik', 'tarikh_mula', 'status_program'], 'safe'],
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
        $query = PerancanganProgram::find()
                ->joinWith(['refStatusProgram']);

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
            'perancangan_program_id' => $this->perancangan_program_id,
            'status_program' => $this->status_program_id,
        ]);

        $query->andFilterWhere(['like', 'nama_program', $this->nama_program])
            ->andFilterWhere(['like', 'muat_naik', $this->muat_naik])
                ->andFilterWhere(['like', 'tarikh_tamat', $this->tarikh_tamat])
                ->andFilterWhere(['like', 'tarikh_mula', $this->tarikh_mula])
                ->andFilterWhere(['like', 'tbl_ref_status_program.desc', $this->status_program]);

        return $dataProvider;
    }
}
