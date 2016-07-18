<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanPendidikanKeputusanSpm;

/**
 * PermohonanPendidikanKeputusanSpmSearch represents the model behind the search form about `app\models\PermohonanPendidikanKeputusanSpm`.
 */
class PermohonanPendidikanKeputusanSpmSearch extends PermohonanPendidikanKeputusanSpm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_pendidikan_keputusan_spm_id', 'permohonan_pendidikan_id', 'subjek', 'created_by', 'updated_by'], 'integer'],
            [['keputusan', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = PermohonanPendidikanKeputusanSpm::find();

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
            'permohonan_pendidikan_keputusan_spm_id' => $this->permohonan_pendidikan_keputusan_spm_id,
            'permohonan_pendidikan_id' => $this->permohonan_pendidikan_id,
            'subjek' => $this->subjek,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'keputusan', $this->keputusan])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
