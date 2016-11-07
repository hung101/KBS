<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletPencapaianRekods;

/**
 * AtletPencapaianRekodsSearch represents the model behind the search form about `app\models\AtletPencapaianRekods`.
 */
class AtletPencapaianRekodsSearch extends AtletPencapaianRekods
{
    public $atlet_id;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pencapaian_rekods_id', 'pencapaian_id', 'atlet_id'], 'integer'],
            [['tarikh', 'peringkat', 'opponent', 'result', 'venue', 'personal_best', 'season_best', 'jenis_rekod', 'session_id'], 'safe'],
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
        $query = AtletPencapaianRekods::find()
                ->joinWith(['refJenisRekod'])
                ->joinWith(['refAtletPencapaian']);

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
            'pencapaian_rekods_id' => $this->pencapaian_rekods_id,
            'tbl_atlet_pencapaian_rekods.pencapaian_id' => $this->pencapaian_id,
            'tarikh' => $this->tarikh,
            'tbl_atlet_pencapaian.atlet_id' => $this->atlet_id,
        ]);

        $query->andFilterWhere(['like', 'peringkat', $this->peringkat])
            ->andFilterWhere(['like', 'opponent', $this->opponent])
            ->andFilterWhere(['like', 'result', $this->result])
            ->andFilterWhere(['like', 'venue', $this->venue])
            ->andFilterWhere(['like', 'personal_best', $this->personal_best])
            ->andFilterWhere(['like', 'season_best', $this->season_best])
                ->andFilterWhere(['like', 'tbl_ref_jenis_rekod.desc', $this->jenis_rekod])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
