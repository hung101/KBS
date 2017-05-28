<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PerancanganProgramPlanMaster;

/**
 * PerancanganProgramPlanMasterSearch represents the model behind the search form about `app\models\PerancanganProgramPlanMaster`.
 */
class PerancanganProgramPlanMasterSearch extends PerancanganProgramPlanMaster
{    
    public $sukan_id;
    public $program_id;
        
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mesyuarat_id', 'sukan_id', 'program_id'], 'integer'],
            [['tarikh_mula', 'tarikh_tamat', 'cawangan', 'sukan', 'program'], 'safe'],
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
        $query = PerancanganProgramPlanMaster::find()
				->joinWith(['refCawangan'])
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

        $query->andFilterWhere([
            // 'perancangan_program_id' => $this->perancangan_program_id,
            // 'status_program' => $this->status_program_id,
            'mesyuarat_id' => $this->mesyuarat_id,
            'sukan' => $this->sukan_id,
            'program' => $this->program_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_cawangan.desc', $this->cawangan])
            // ->andFilterWhere(['like', 'muat_naik', $this->muat_naik])
                ->andFilterWhere(['like', 'tarikh_tamat', $this->tarikh_tamat])
                ->andFilterWhere(['like', 'tarikh_mula', $this->tarikh_mula])
                // ->andFilterWhere(['like', 'lokasi', $this->lokasi])
                // ->andFilterWhere(['like', 'tbl_ref_status_program.desc', $this->status_program])
                ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->sukan])
                ->andFilterWhere(['like', 'tbl_ref_program_semasa_sukan_atlet.desc', $this->program]);

        return $dataProvider;
    }
}
