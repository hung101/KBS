<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BspPrestasi;

/**
 * BspPrestasiSearch represents the model behind the search form about `app\models\BspPrestasi`.
 */
class BspPrestasiSearch extends BspPrestasi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_prestasi_id', 'bsp_pemohon_id'], 'integer'],
            [['laporan_ulasan', 'nyatakan_sebab_sebab_tidak_menyertai_kejohanan'], 'safe'],
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
        $query = BspPrestasi::find();

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
            'bsp_prestasi_id' => $this->bsp_prestasi_id,
            'bsp_pemohon_id' => $this->bsp_pemohon_id,
        ]);

        $query->andFilterWhere(['like', 'laporan_ulasan', $this->laporan_ulasan])
            ->andFilterWhere(['like', 'nyatakan_sebab_sebab_tidak_menyertai_kejohanan', $this->nyatakan_sebab_sebab_tidak_menyertai_kejohanan]);

        return $dataProvider;
    }
}
