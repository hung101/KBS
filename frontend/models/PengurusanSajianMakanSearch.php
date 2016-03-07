<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanSajianMakan;

/**
 * PengurusanSajianMakanSearch represents the model behind the search form about `app\models\PengurusanSajianMakan`.
 */
class PengurusanSajianMakanSearch extends PengurusanSajianMakan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_sajian_makan_id'], 'integer'],
            [['tarikh_mula', 'atlet_id', 'tarikh_akhir', 'bilangan_tempahan_makan'], 'safe'],
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
        $query = PengurusanSajianMakan::find()
                ->joinWith(['refAtlet']);

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
            'pengurusan_sajian_makan_id' => $this->pengurusan_sajian_makan_id,
            //'atlet_id' => $this->atlet_id,
            'tarikh_mula' => $this->tarikh_mula,
            'tarikh_akhir' => $this->tarikh_akhir,
        ]);

        $query->andFilterWhere(['like', 'bilangan_tempahan_makan', $this->bilangan_tempahan_makan])
                ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id]);

        return $dataProvider;
    }
}
