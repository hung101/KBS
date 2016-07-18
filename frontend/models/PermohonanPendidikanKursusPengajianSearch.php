<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanPendidikanKursusPengajian;

/**
 * PermohonanPendidikanKursusPengajianSearch represents the model behind the search form about `app\models\PermohonanPendidikanKursusPengajian`.
 */
class PermohonanPendidikanKursusPengajianSearch extends PermohonanPendidikanKursusPengajian
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_pendidikan_kursus_pengajian_id', 'permohonan_pendidikan_id', 'created_by', 'updated_by'], 'integer'],
            [['kursus_pengajian', 'universiti', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = PermohonanPendidikanKursusPengajian::find();

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
            'permohonan_pendidikan_kursus_pengajian_id' => $this->permohonan_pendidikan_kursus_pengajian_id,
            'permohonan_pendidikan_id' => $this->permohonan_pendidikan_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'kursus_pengajian', $this->kursus_pengajian])
            ->andFilterWhere(['like', 'universiti', $this->universiti])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
