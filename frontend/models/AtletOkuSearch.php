<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletOku;

/**
 * AtletOkuSearch represents the model behind the search form about `app\models\AtletOku`.
 */
class AtletOkuSearch extends AtletOku
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oku_id', 'atlet_id'], 'integer'],
            [['jenis_kurang_upaya', 'jenis_kurang_upaya_pendengaran'], 'safe'],
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
        $query = AtletOku::find()
                ->joinWith(['refJenisKurangUpaya']);

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
            'oku_id' => $this->oku_id,
            'atlet_id' => $this->atlet_id,
            //'jenis_kurang_upaya' => $this->jenis_kurang_upaya,
        ]);

        $query->andFilterWhere(['like', 'jenis_kurang_upaya_pendengaran', $this->jenis_kurang_upaya_pendengaran])
              ->andFilterWhere(['like', 'tbl_ref_jenis_kurang_upaya.desc', $this->jenis_kurang_upaya]);

        return $dataProvider;
    }
}
