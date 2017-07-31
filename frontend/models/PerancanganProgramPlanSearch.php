<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PerancanganProgramPlan;

/**
 * PerancanganProgramPlanSearch represents the model behind the search form about `app\models\PerancanganProgramPlan`.
 */
class PerancanganProgramPlanSearch extends PerancanganProgramPlan
{
    public $status_program_id;
    public $sukan_id;
    public $program_id;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['perancangan_program_id', 'perancangan_program_plan_master_id', 'status_program_id', 'mesyuarat_id', 'sukan_id', 'program_id', 'bahagian', 'created_by'], 'integer'],
            [['tarikh_tamat', 'nama_program', 'muat_naik', 'tarikh_mula', 'status_program', 'sukan', 'jenis_program', 'lokasi', 'jenis_aktiviti', 'session_id'], 'safe'],
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
        $query = PerancanganProgramPlan::find()
                ->joinWith(['refKategoriPelan'])
                ->joinWith(['refSukan'])
                ->joinWith(['refProgramSemasaSukanAtlet']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        // sorting for JKK
        if(isset($this->mesyuarat_id)){
            $query->orderBy(['status_program' => SORT_DESC]);
        }

        $query->andFilterWhere([
            'perancangan_program_id' => $this->perancangan_program_id,
            'perancangan_program_plan_master_id' => $this->perancangan_program_plan_master_id,
            'status_program' => $this->status_program_id,
            'mesyuarat_id' => $this->mesyuarat_id,
            'sukan' => $this->sukan_id,
            'jenis_program' => $this->program_id,
            'bahagian' => $this->bahagian,
            'tbl_perancangan_program_plan.created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'nama_program', $this->nama_program])
            ->andFilterWhere(['like', 'muat_naik', $this->muat_naik])
                ->andFilterWhere(['like', 'tarikh_tamat', $this->tarikh_tamat])
                ->andFilterWhere(['like', 'tarikh_mula', $this->tarikh_mula])
                ->andFilterWhere(['like', 'lokasi', $this->lokasi])
                ->andFilterWhere(['like', 'tbl_ref_status_program.desc', $this->status_program])
                ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->sukan])
                ->andFilterWhere(['like', 'session_id', $this->session_id])
                ->andFilterWhere(['like', 'tbl_ref_program_semasa_sukan_atlet.desc', $this->jenis_program]);

        return $dataProvider;
    }
}
