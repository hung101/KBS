<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InventoriPeralatan;

/**
 * InventoriPeralatanSearch represents the model behind the search form about `app\models\InventoriPeralatan`.
 */
class InventoriPeralatanSearch extends InventoriPeralatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inventori_peralatan_id', 'inventori_id', 'kuantiti', 'created_by', 'updated_by'], 'integer'],
            [['nama_peralatan', 'no_inv_do', 'session_id', 'created', 'updated'], 'safe'],
            [['harga_per_unit', 'jumlah'], 'number'],
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
        $query = InventoriPeralatan::find();

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
            'inventori_peralatan_id' => $this->inventori_peralatan_id,
            'inventori_id' => $this->inventori_id,
            'kuantiti' => $this->kuantiti,
            'harga_per_unit' => $this->harga_per_unit,
            'jumlah' => $this->jumlah,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'nama_peralatan', $this->nama_peralatan])
            ->andFilterWhere(['like', 'no_inv_do', $this->no_inv_do])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
