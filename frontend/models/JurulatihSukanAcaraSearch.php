<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JurulatihSukanAcara;

/**
 * JurulatihSukanAcaraSearch represents the model behind the search form about `app\models\JurulatihSukanAcara`.
 */
class JurulatihSukanAcaraSearch extends JurulatihSukanAcara
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jurulatih_sukan_acara_id', 'jurulatih_sukan_id', 'created_by', 'updated_by'], 'integer'],
            [['acara', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = JurulatihSukanAcara::find()
                ->joinWith(['refAcara']);

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
            'jurulatih_sukan_acara_id' => $this->jurulatih_sukan_acara_id,
            'jurulatih_sukan_id' => $this->jurulatih_sukan_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_acara.desc', $this->acara])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
