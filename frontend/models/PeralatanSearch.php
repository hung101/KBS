<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Peralatan;

/**
 * PeralatanSearch represents the model behind the search form about `app\models\Peralatan`.
 */
class PeralatanSearch extends Peralatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['peralatan_id', 'permohonan_peralatan_id'], 'integer'],
            [['nama_peralatan', 'spesifikasi', 'kuantiti_unit', 'catatan', 'session_id'], 'safe'],
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
        $query = Peralatan::find();

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
            'peralatan_id' => $this->peralatan_id,
            'permohonan_peralatan_id' => $this->permohonan_peralatan_id,
        ]);

        $query->andFilterWhere(['like', 'nama_peralatan', $this->nama_peralatan])
            ->andFilterWhere(['like', 'spesifikasi', $this->spesifikasi])
            ->andFilterWhere(['like', 'kuantiti_unit', $this->kuantiti_unit])
            ->andFilterWhere(['like', 'catatan', $this->catatan])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
