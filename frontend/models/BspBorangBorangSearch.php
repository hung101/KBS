<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BspBorangBorang;

/**
 * BspBorangBorangSearch represents the model behind the search form about `app\models\BspBorangBorang`.
 */
class BspBorangBorangSearch extends BspBorangBorang
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_borang_borang_id', 'bsp_pemohon_id', 'created_by', 'updated_by'], 'integer'],
            [['bsp_03', 'bsp_04', 'bsp_05', 'bsp_07', 'bsp_08', 'bsp_09', 'bsp_12', 'bsp_13', 'bsp_14', 'created', 'updated'], 'safe'],
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
        $query = BspBorangBorang::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'bsp_borang_borang_id' => $this->bsp_borang_borang_id,
            'bsp_pemohon_id' => $this->bsp_pemohon_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'bsp_03', $this->bsp_03])
            ->andFilterWhere(['like', 'bsp_04', $this->bsp_04])
            ->andFilterWhere(['like', 'bsp_05', $this->bsp_05])
            ->andFilterWhere(['like', 'bsp_07', $this->bsp_07])
            ->andFilterWhere(['like', 'bsp_08', $this->bsp_08])
            ->andFilterWhere(['like', 'bsp_09', $this->bsp_09])
            ->andFilterWhere(['like', 'bsp_12', $this->bsp_12])
            ->andFilterWhere(['like', 'bsp_13', $this->bsp_13])
            ->andFilterWhere(['like', 'bsp_14', $this->bsp_14]);

        return $dataProvider;
    }
}
