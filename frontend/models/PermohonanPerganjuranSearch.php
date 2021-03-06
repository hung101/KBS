<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanPerganjuran;

/**
 * PermohonanPerganjuranSearch represents the model behind the search form about `app\models\PermohonanPerganjuran`.
 */
class PermohonanPerganjuranSearch extends PermohonanPerganjuran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_perganjuran_id', 'kelulusan'], 'integer'],
            [['tarikh_kursus', 'tempat_kursus', 'aktiviti', 'nama_instructor'], 'safe'],
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
        $query = PermohonanPerganjuran::find();

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
            'permohonan_perganjuran_id' => $this->permohonan_perganjuran_id,
            'tarikh_kursus' => $this->tarikh_kursus,
            'kelulusan' => $this->kelulusan,
        ]);

        $query->andFilterWhere(['like', 'tempat_kursus', $this->tempat_kursus])
            ->andFilterWhere(['like', 'aktiviti', $this->aktiviti])
            ->andFilterWhere(['like', 'nama_instructor', $this->nama_instructor]);

        return $dataProvider;
    }
}
