<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanPenginapanAtlet;

/**
 * PengurusanPenginapanAtletSearch represents the model behind the search form about `app\models\PengurusanPenginapanAtlet`.
 */
class PengurusanPenginapanAtletSearch extends PengurusanPenginapanAtlet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_penginapan_atlet_id', 'pengurusan_penginapan_id', 'created_by', 'updated_by'], 'integer'],
            [['session_id', 'created', 'updated', 'atlet_id'], 'safe'],
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
        $query = PengurusanPenginapanAtlet::find()
                ->joinWith(['refAtlet']);

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
            'pengurusan_penginapan_atlet_id' => $this->pengurusan_penginapan_atlet_id,
            'pengurusan_penginapan_id' => $this->pengurusan_penginapan_id,
            //'atlet_id' => $this->atlet_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'session_id', $this->session_id])
                ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id]);

        return $dataProvider;
    }
}
