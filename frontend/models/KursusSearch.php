<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Kursus;

/**
 * KursusSearch represents the model behind the search form about `app\models\Kursus`.
 */
class KursusSearch extends Kursus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kursus_id'], 'integer'],
            [['nama_kursus', 'tempat', 'tarikh', 'penganjur', 'kod_kursus', 'pengkhususan'], 'safe'],
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
        $query = Kursus::find();

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
            'kursus_id' => $this->kursus_id,
            'tarikh' => $this->tarikh,
        ]);

        $query->andFilterWhere(['like', 'nama_kursus', $this->nama_kursus])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'penganjur', $this->penganjur])
            ->andFilterWhere(['like', 'kod_kursus', $this->kod_kursus])
            ->andFilterWhere(['like', 'pengkhususan', $this->pengkhususan]);

        return $dataProvider;
    }
}
