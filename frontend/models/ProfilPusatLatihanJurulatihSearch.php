<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProfilPusatLatihanJurulatih;

/**
 * ProfilPusatLatihanJurulatihSearch represents the model behind the search form about `app\models\ProfilPusatLatihanJurulatih`.
 */
class ProfilPusatLatihanJurulatihSearch extends ProfilPusatLatihanJurulatih
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profil_pusat_latihan_jurulatih_id', 'profil_pusat_latihan_id', 'created_by', 'updated_by'], 'integer'],
            [['jurulatih', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = ProfilPusatLatihanJurulatih::find()
                ->joinWith(['refJurulatih']);

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
            'profil_pusat_latihan_jurulatih_id' => $this->profil_pusat_latihan_jurulatih_id,
            'profil_pusat_latihan_id' => $this->profil_pusat_latihan_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'jurulatih', $this->jurulatih])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
