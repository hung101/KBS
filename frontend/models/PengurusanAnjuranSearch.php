<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanAnjuran;

/**
 * PengurusanAnjuranSearch represents the model behind the search form about `app\models\PengurusanAnjuran`.
 */
class PengurusanAnjuranSearch extends PengurusanAnjuran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_anjuran_id'], 'integer'],
            [['nama_program_anjuran', 'tarikh_program_anjuran', 'nama_badan_sukan_antarabangsa', 'nama_delegasi', 'negara'], 'safe'],
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
        $query = PengurusanAnjuran::find()
                ->joinWith(['refBadanSukanAntarabangsa']);

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
            'pengurusan_anjuran_id' => $this->pengurusan_anjuran_id,
            'tarikh_program_anjuran' => $this->tarikh_program_anjuran,
        ]);

        $query->andFilterWhere(['like', 'nama_program_anjuran', $this->nama_program_anjuran])
            ->andFilterWhere(['like', 'tbl_ref_badan_sukan_antarabangsa.desc', $this->nama_badan_sukan_antarabangsa])
            ->andFilterWhere(['like', 'nama_delegasi', $this->nama_delegasi])
            ->andFilterWhere(['like', 'negara', $this->negara]);

        return $dataProvider;
    }
}
