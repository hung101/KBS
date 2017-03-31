<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MaklumatAkademikJadual;

/**
 * MaklumatAkademikJadualSearch represents the model behind the search form about `app\models\MaklumatAkademikJadual`.
 */
class MaklumatAkademikJadualSearch extends MaklumatAkademikJadual
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['maklumat_akademik_jadual_id', 'maklumat_akademik_id', 'created_by', 'updated_by'], 'integer'],
            [['session_id', 'tarikh', 'masa_dari', 'masa_hingga', 'created', 'updated'], 'safe'],
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
        $query = MaklumatAkademikJadual::find()->joinWith(['refHari']);

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
            'maklumat_akademik_jadual_id' => $this->maklumat_akademik_jadual_id,
            'maklumat_akademik_id' => $this->maklumat_akademik_id,
            'tarikh' => $this->tarikh,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'session_id', $this->session_id])
            ->andFilterWhere(['like', 'masa_dari', $this->masa_dari])
            ->andFilterWhere(['like', 'masa_hingga', $this->masa_hingga]);

        return $dataProvider;
    }
}
