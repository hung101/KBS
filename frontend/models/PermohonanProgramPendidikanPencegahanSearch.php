<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanProgramPendidikanPencegahan;

/**
 * PermohonanProgramPendidikanPencegahanSearch represents the model behind the search form about `app\models\PermohonanProgramPendidikanPencegahan`.
 */
class PermohonanProgramPendidikanPencegahanSearch extends PermohonanProgramPendidikanPencegahan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['program_pendidikan_pencegahan_id', 'atlet_id_staff_id', 'kelulusan'], 'integer'],
            [['program', 'tarikh_permohonan', 'status_permohonan', 'kategori_permohonan', 'catitan_ringkas'], 'safe'],
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
        $query = PermohonanProgramPendidikanPencegahan::find();

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
            'program_pendidikan_pencegahan_id' => $this->program_pendidikan_pencegahan_id,
            'atlet_id_staff_id' => $this->atlet_id_staff_id,
            'tarikh_permohonan' => $this->tarikh_permohonan,
            'kelulusan' => $this->kelulusan,
        ]);

        $query->andFilterWhere(['like', 'program', $this->program])
            ->andFilterWhere(['like', 'status_permohonan', $this->status_permohonan])
            ->andFilterWhere(['like', 'kategori_permohonan', $this->kategori_permohonan])
            ->andFilterWhere(['like', 'catitan_ringkas', $this->catitan_ringkas]);

        return $dataProvider;
    }
}
