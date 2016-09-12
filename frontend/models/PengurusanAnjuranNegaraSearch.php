<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanAnjuranNegara;

/**
 * PengurusanAnjuranNegaraSearch represents the model behind the search form about `app\models\PengurusanAnjuranNegara`.
 */
class PengurusanAnjuranNegaraSearch extends PengurusanAnjuranNegara
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_anjuran_negara_id', 'pengurusan_anjuran_id', 'created_by', 'updated_by'], 'integer'],
            [['negara', 'nama_delegasi_luar_negara', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = PengurusanAnjuranNegara::find()
                ->joinWith(['refNegara']);

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
            'pengurusan_anjuran_negara_id' => $this->pengurusan_anjuran_negara_id,
            'pengurusan_anjuran_id' => $this->pengurusan_anjuran_id,
            'negara' => $this->negara,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'nama_delegasi_luar_negara', $this->nama_delegasi_luar_negara])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
