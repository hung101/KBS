<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PlSejarahPerubatan;

/**
 * PlSejarahPerubatanSearch represents the model behind the search form about `app\models\PlSejarahPerubatan`.
 */
class PlSejarahPerubatanSearch extends PlSejarahPerubatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pl_sejarah_perubatan_id', 'atlet_id'], 'integer'],
            [['tarikh', 'nama_perubatan', 'butiran_perubatan'], 'safe'],
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
        $query = PlSejarahPerubatan::find();

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
            'pl_sejarah_perubatan_id' => $this->pl_sejarah_perubatan_id,
            'atlet_id' => $this->atlet_id,
            'tarikh' => $this->tarikh,
        ]);

        $query->andFilterWhere(['like', 'nama_perubatan', $this->nama_perubatan])
            ->andFilterWhere(['like', 'butiran_perubatan', $this->butiran_perubatan]);

        return $dataProvider;
    }
}
