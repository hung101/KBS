<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LtbsNotisAgm;

/**
 * LtbsNotisAgmSearch represents the model behind the search form about `app\models\LtbsNotisAgm`.
 */
class LtbsNotisAgmSearch extends LtbsNotisAgm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tbl_ltbs_id', 'mesyuarat_id'], 'integer'],
            [['notis_agm', 'tahun', 'nama_mesyuarat_agong', 'session_id'], 'safe'],
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
        $query = LtbsNotisAgm::find();

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
            'tbl_ltbs_id' => $this->tbl_ltbs_id,
            'mesyuarat_id' => $this->mesyuarat_id,
        ]);

        $query->andFilterWhere(['like', 'notis_agm', $this->notis_agm])
                ->andFilterWhere(['like', 'tahun', $this->tahun])
                ->andFilterWhere(['like', 'nama_mesyuarat_agong', $this->nama_mesyuarat_agong])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
