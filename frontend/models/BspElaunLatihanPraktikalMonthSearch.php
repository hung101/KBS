<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BspElaunLatihanPraktikalMonth;

/**
 * BspElaunLatihanPraktikalMonthSearch represents the model behind the search form about `app\models\BspElaunLatihanPraktikalMonth`.
 */
class BspElaunLatihanPraktikalMonthSearch extends BspElaunLatihanPraktikalMonth
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_elaun_latihan_praktikal_month_id', 'bsp_elaun_latihan_praktikal_id', 'jumlah_hari'], 'integer'],
            [['bulan', 'session_id'], 'safe'],
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
        $query = BspElaunLatihanPraktikalMonth::find();

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
            'bsp_elaun_latihan_praktikal_month_id' => $this->bsp_elaun_latihan_praktikal_month_id,
            'bsp_elaun_latihan_praktikal_id' => $this->bsp_elaun_latihan_praktikal_id,
            'bulan' => $this->bulan,
            'jumlah_hari' => $this->jumlah_hari,
        ]);
        
        $query->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
