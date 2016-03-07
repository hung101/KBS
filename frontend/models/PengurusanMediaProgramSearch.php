<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanMediaProgram;

/**
 * PengurusanMediaProgramSearch represents the model behind the search form about `app\models\PengurusanMediaProgram`.
 */
class PengurusanMediaProgramSearch extends PengurusanMediaProgram
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_media_program_id'], 'integer'],
            [['tarikh_mula', 'nama_program', 'tempat', 'cawangan', 'maklumat_msn_negeri', 'catatan'], 'safe'],
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
        $query = PengurusanMediaProgram::find();

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
            'pengurusan_media_program_id' => $this->pengurusan_media_program_id,
            'tarikh_mula' => $this->tarikh_mula,
        ]);

        $query->andFilterWhere(['like', 'nama_program', $this->nama_program])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'cawangan', $this->cawangan])
            ->andFilterWhere(['like', 'maklumat_msn_negeri', $this->maklumat_msn_negeri])
            ->andFilterWhere(['like', 'catatan', $this->catatan]);

        return $dataProvider;
    }
}
