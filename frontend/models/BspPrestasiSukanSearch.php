<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BspPrestasiSukan;

/**
 * BspPrestasiSukanSearch represents the model behind the search form about `app\models\BspPrestasiSukan`.
 */
class BspPrestasiSukanSearch extends BspPrestasiSukan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_prestasi_sukan_id', 'bsp_pemohon_id'], 'integer'],
            [['tarikh', 'kejohanan_yang_disertai', 'lokasi_kejohanan', 'pencapaian'], 'safe'],
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
        $query = BspPrestasiSukan::find();

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
            'bsp_prestasi_sukan_id' => $this->bsp_prestasi_sukan_id,
            'bsp_pemohon_id' => $this->bsp_pemohon_id,
            'tarikh' => $this->tarikh,
        ]);

        $query->andFilterWhere(['like', 'kejohanan_yang_disertai', $this->kejohanan_yang_disertai])
            ->andFilterWhere(['like', 'lokasi_kejohanan', $this->lokasi_kejohanan])
            ->andFilterWhere(['like', 'pencapaian', $this->pencapaian]);

        return $dataProvider;
    }
}
