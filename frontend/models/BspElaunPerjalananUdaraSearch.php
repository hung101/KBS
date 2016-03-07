<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BspElaunPerjalananUdara;

/**
 * BspElaunPerjalananUdaraSearch represents the model behind the search form about `app\models\BspElaunPerjalananUdara`.
 */
class BspElaunPerjalananUdaraSearch extends BspElaunPerjalananUdara
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_elaun_perjalanan_udara_id', 'bsp_pemohon_id'], 'integer'],
            [['tarikh', 'destinasi_pergi', 'tarikh_pergi', 'destinasi_balik', 'tarikh_balik'], 'safe'],
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
        $query = BspElaunPerjalananUdara::find();

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
            'bsp_elaun_perjalanan_udara_id' => $this->bsp_elaun_perjalanan_udara_id,
            'bsp_pemohon_id' => $this->bsp_pemohon_id,
            'tarikh' => $this->tarikh,
            'tarikh_pergi' => $this->tarikh_pergi,
            'tarikh_balik' => $this->tarikh_balik,
        ]);

        $query->andFilterWhere(['like', 'destinasi_pergi', $this->destinasi_pergi])
            ->andFilterWhere(['like', 'destinasi_balik', $this->destinasi_balik]);

        return $dataProvider;
    }
}
