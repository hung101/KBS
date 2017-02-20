<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanProgramBinaanTeknikal;

/**
 * PengurusanProgramBinaanTeknikalSearch represents the model behind the search form about `app\models\PengurusanProgramBinaanTeknikal`.
 */
class PengurusanProgramBinaanTeknikalSearch extends PengurusanProgramBinaanTeknikal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_program_binaan_teknikal_id', 'pengurusan_program_binaan_id'], 'integer'],
            [['nama', 'jantina', 'session_id'], 'safe'],
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
        $query = PengurusanProgramBinaanTeknikal::find()
                ->joinWith(['refJantina']);

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
            'pengurusan_program_binaan_teknikal_id' => $this->pengurusan_program_binaan_teknikal_id,
            'pengurusan_program_binaan_id' => $this->pengurusan_program_binaan_id,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'tbl_ref_jantina.desc', $this->jantina])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
