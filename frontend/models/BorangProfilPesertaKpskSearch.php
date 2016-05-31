<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BorangProfilPesertaKpsk;

/**
 * BorangProfilPesertaKpskSearch represents the model behind the search form about `app\models\BorangProfilPesertaKpsk`.
 */
class BorangProfilPesertaKpskSearch extends BorangProfilPesertaKpsk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['borang_profil_peserta_kpsk_id', 'created_by', 'updated_by'], 'integer'],
            [['penganjur_kursus', 'kod_kursus', 'tarikh_kursus', 'created', 'updated'], 'safe'],
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
        $query = BorangProfilPesertaKpsk::find();

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
            'borang_profil_peserta_kpsk_id' => $this->borang_profil_peserta_kpsk_id,
            'tarikh_kursus' => $this->tarikh_kursus,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'penganjur_kursus', $this->penganjur_kursus])
            ->andFilterWhere(['like', 'kod_kursus', $this->kod_kursus]);

        return $dataProvider;
    }
}
