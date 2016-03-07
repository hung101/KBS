<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletPerubatanDoktor;

/**
 * AtletPerubatanDoktorSearch represents the model behind the search form about `app\models\AtletPerubatanDoktor`.
 */
class AtletPerubatanDoktorSearch extends AtletPerubatanDoktor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doktor_id', 'atlet_id', 'no_telefon'], 'integer'],
            [['nama_doktor', 'hospital_klinik'], 'safe'],
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
        $query = AtletPerubatanDoktor::find();

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
            'doktor_id' => $this->doktor_id,
            'atlet_id' => $this->atlet_id,
            'no_telefon' => $this->no_telefon,
        ]);

        $query->andFilterWhere(['like', 'nama_doktor', $this->nama_doktor])
            ->andFilterWhere(['like', 'hospital_klinik', $this->hospital_klinik]);

        return $dataProvider;
    }
}
