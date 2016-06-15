<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PembayaranInsentifAtlet;

/**
 * PembayaranInsentifAtletSearch represents the model behind the search form about `app\models\PembayaranInsentifAtlet`.
 */
class PembayaranInsentifAtletSearch extends PembayaranInsentifAtlet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pembayaran_insentif_atlet_id', 'pembayaran_insentif_id', 'negara', 'created_by', 'updated_by'], 'integer'],
            [['session_id', 'created', 'updated', 'atlet'], 'safe'],
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
        $query = PembayaranInsentifAtlet::find()
                ->joinWith(['refAtlet']);

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
            'pembayaran_insentif_atlet_id' => $this->pembayaran_insentif_atlet_id,
            'pembayaran_insentif_id' => $this->pembayaran_insentif_id,
            //'atlet' => $this->atlet,
            'negara' => $this->negara,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'session_id', $this->session_id])
                ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet]);

        return $dataProvider;
    }
}
