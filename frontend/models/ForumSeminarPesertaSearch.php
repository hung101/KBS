<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ForumSeminarPeserta;

/**
 * ForumSeminarPesertaSearch represents the model behind the search form about `app\models\ForumSeminarPeserta`.
 */
class ForumSeminarPesertaSearch extends ForumSeminarPeserta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['forum_seminar_peserta_id', 'forum_seminar_persidangan_di_luar_negara_id', 'created_by', 'updated_by'], 'integer'],
            [['session_id', 'nama', 'jawatan', 'created', 'updated'], 'safe'],
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
        $query = ForumSeminarPeserta::find();

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
            'forum_seminar_peserta_id' => $this->forum_seminar_peserta_id,
            'forum_seminar_persidangan_di_luar_negara_id' => $this->forum_seminar_persidangan_di_luar_negara_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'session_id', $this->session_id])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'jawatan', $this->jawatan]);

        return $dataProvider;
    }
}
