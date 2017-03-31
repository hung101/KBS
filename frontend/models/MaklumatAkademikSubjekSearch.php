<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MaklumatAkademikSubjek;

/**
 * MaklumatAkademikSubjekSearch represents the model behind the search form about `app\models\MaklumatAkademikSubjek`.
 */
class MaklumatAkademikSubjekSearch extends MaklumatAkademikSubjek
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['maklumat_akademik_subjek_id', 'maklumat_akademik_id', 'bil_kredit', 'created_by', 'updated_by'], 'integer'],
            [['session_id', 'kod_subjek', 'subjek', 'nama_pensyarah', 'no_telefon', 'email', 'created', 'updated'], 'safe'],
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
        $query = MaklumatAkademikSubjek::find();

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
            'maklumat_akademik_subjek_id' => $this->maklumat_akademik_subjek_id,
            'maklumat_akademik_id' => $this->maklumat_akademik_id,
            'bil_kredit' => $this->bil_kredit,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'session_id', $this->session_id])
            ->andFilterWhere(['like', 'kod_subjek', $this->kod_subjek])
            ->andFilterWhere(['like', 'subjek', $this->subjek])
            ->andFilterWhere(['like', 'nama_pensyarah', $this->nama_pensyarah])
            ->andFilterWhere(['like', 'no_telefon', $this->no_telefon])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
