<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanPerganjuranInstructor;

/**
 * PermohonanPerganjuranInstructorSearch represents the model behind the search form about `app\models\PermohonanPerganjuranInstructor`.
 */
class PermohonanPerganjuranInstructorSearch extends PermohonanPerganjuranInstructor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_perganjuran_instructor_id', 'permohonan_perganjuran_id'], 'integer'],
            [['nama_instructor', 'session_id'], 'safe'],
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
        $query = PermohonanPerganjuranInstructor::find();

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
            'permohonan_perganjuran_instructor_id' => $this->permohonan_perganjuran_instructor_id,
            'permohonan_perganjuran_id' => $this->permohonan_perganjuran_id,
        ]);

        $query->andFilterWhere(['like', 'nama_instructor', $this->nama_instructor])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
