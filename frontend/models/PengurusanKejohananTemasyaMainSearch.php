<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanKejohananTemasyaMain;

/**
 * PengurusanKejohananTemasyaMainSearch represents the model behind the search form about `app\models\PengurusanKejohananTemasyaMain`.
 */
class PengurusanKejohananTemasyaMainSearch extends PengurusanKejohananTemasyaMain
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_kejohanan_temasya_main_id'], 'integer'],
            [['nama_temasya', 'nama_pertandingan', 'tarikh'], 'safe'],
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
        $query = PengurusanKejohananTemasyaMain::find()
                ->joinWith(['refTemasya'])
                ->joinWith(['refPertandinganTemasya']);

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
            'pengurusan_kejohanan_temasya_main_id' => $this->pengurusan_kejohanan_temasya_main_id,
            'tarikh' => $this->tarikh,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_temasya.desc', $this->nama_temasya])
            ->andFilterWhere(['like', 'tbl_ref_pertandingan_temasya.desc', $this->nama_pertandingan]);

        return $dataProvider;
    }
}
