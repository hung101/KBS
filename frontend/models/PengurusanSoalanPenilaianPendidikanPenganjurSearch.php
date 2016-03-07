<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanSoalanPenilaianPendidikanPenganjur;

/**
 * PengurusanSoalanPenilaianPendidikanPenganjurSearch represents the model behind the search form about `app\models\PengurusanSoalanPenilaianPendidikanPenganjur`.
 */
class PengurusanSoalanPenilaianPendidikanPenganjurSearch extends PengurusanSoalanPenilaianPendidikanPenganjur
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_soalan_penilaian_pendidikan_penganjur_id', 'pengurusan_penilaian_pendidikan_penganjur_intructor_id'], 'integer'],
            [['soalan', 'rating', 'session_id'], 'safe'],
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
        $query = PengurusanSoalanPenilaianPendidikanPenganjur::find()
                ->joinWith(['refSoalanPenilaianPendidikanPenganjurInstructor'])
                ->joinWith(['refRatingSoalan']);

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
            'pengurusan_soalan_penilaian_pendidikan_penganjur_id' => $this->pengurusan_soalan_penilaian_pendidikan_penganjur_id,
            'pengurusan_penilaian_pendidikan_penganjur_intructor_id' => $this->pengurusan_penilaian_pendidikan_penganjur_intructor_id,
            //'rating' => $this->rating,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_soalan_penilaian_pendidikan_penganjur_instructor.desc', $this->soalan])
                ->andFilterWhere(['like', 'tbl_ref_rating_soalan.desc', $this->rating])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
