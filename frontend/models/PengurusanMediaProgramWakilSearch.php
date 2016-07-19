<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanMediaProgramWakil;

/**
 * PengurusanMediaProgramWakilSearch represents the model behind the search form about `app\models\PengurusanMediaProgramWakil`.
 */
class PengurusanMediaProgramWakilSearch extends PengurusanMediaProgramWakil
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_media_program_wakil_id', 'pengurusan_media_program_id', 'kehadiran', 'created_by', 'updated_by'], 'integer'],
            [['nama_wakil', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = PengurusanMediaProgramWakil::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'pengurusan_media_program_wakil_id' => $this->pengurusan_media_program_wakil_id,
            'pengurusan_media_program_id' => $this->pengurusan_media_program_id,
            'kehadiran' => $this->kehadiran,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'nama_wakil', $this->nama_wakil])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
