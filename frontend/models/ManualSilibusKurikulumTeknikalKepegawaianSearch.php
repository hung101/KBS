<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ManualSilibusKurikulumTeknikalKepegawaian;

/**
 * ManualSilibusKurikulumTeknikalKepegawaianSearch represents the model behind the search form about `app\models\ManualSilibusKurikulumTeknikalKepegawaian`.
 */
class ManualSilibusKurikulumTeknikalKepegawaianSearch extends ManualSilibusKurikulumTeknikalKepegawaian
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['manual_silibus_kurikulum_teknikal_kepegawaian_id', 'created_by', 'updated_by'], 'integer'],
            [['persatuan_sukan', 'jilid_versi', 'tarikh', 'muat_naik', 'created', 'updated'], 'safe'],
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
        $query = ManualSilibusKurikulumTeknikalKepegawaian::find();

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
            'manual_silibus_kurikulum_teknikal_kepegawaian_id' => $this->manual_silibus_kurikulum_teknikal_kepegawaian_id,
            'tarikh' => $this->tarikh,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'persatuan_sukan', $this->persatuan_sukan])
            ->andFilterWhere(['like', 'jilid_versi', $this->jilid_versi])
            ->andFilterWhere(['like', 'muat_naik', $this->muat_naik]);

        return $dataProvider;
    }
}
