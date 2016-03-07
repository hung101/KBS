<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PaobsPenganjuranSumberKewangan;

/**
 * PaobsPenganjuranSumberKewanganSearch represents the model behind the search form about `app\models\PaobsPenganjuranSumberKewangan`.
 */
class PaobsPenganjuranSumberKewanganSearch extends PaobsPenganjuranSumberKewangan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['paobs_penganjuran_sumber_kewangan_id', 'penganjuran_id', 'created_by', 'updated_by'], 'integer'],
            [['sumber', 'session_id', 'created', 'updated'], 'safe'],
            [['jumlah'], 'number'],
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
        $query = PaobsPenganjuranSumberKewangan::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'paobs_penganjuran_sumber_kewangan_id' => $this->paobs_penganjuran_sumber_kewangan_id,
            'penganjuran_id' => $this->penganjuran_id,
            'jumlah' => $this->jumlah,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'sumber', $this->sumber])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
