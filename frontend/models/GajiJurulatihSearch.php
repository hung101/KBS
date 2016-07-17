<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GajiJurulatih;

/**
 * GajiJurulatihSearch represents the model behind the search form about `app\models\GajiJurulatih`.
 */
class GajiJurulatihSearch extends GajiJurulatih
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gaji_jurulatih_id', 'gaji_dan_elaun_jurulatih_id', 'created_by', 'updated_by'], 'integer'],
            [['jumlah'], 'number'],
            [['tarikh_mula', 'tarikh_tamat', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = GajiJurulatih::find();

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
            'gaji_jurulatih_id' => $this->gaji_jurulatih_id,
            'gaji_dan_elaun_jurulatih_id' => $this->gaji_dan_elaun_jurulatih_id,
            'jumlah' => $this->jumlah,
            'tarikh_mula' => $this->tarikh_mula,
            'tarikh_tamat' => $this->tarikh_tamat,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
