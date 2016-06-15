<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanUpstnJurulatih;

/**
 * PengurusanUpstnJurulatihSearch represents the model behind the search form about `app\models\PengurusanUpstnJurulatih`.
 */
class PengurusanUpstnJurulatihSearch extends PengurusanUpstnJurulatih
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_upstn_jurulatih_id', 'peserta', 'created_by', 'updated_by'], 'integer'],
            [['pengurusan_upstn_id', 'tarikh', 'tempat', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = PengurusanUpstnJurulatih::find();

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
            'pengurusan_upstn_jurulatih_id' => $this->pengurusan_upstn_jurulatih_id,
            'tarikh' => $this->tarikh,
            'peserta' => $this->peserta,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'pengurusan_upstn_id', $this->pengurusan_upstn_id])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
