<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ElaporanKewanganDanPerbelanjaan;

/**
 * ElaporanKewanganDanPerbelanjaanSearch represents the model behind the search form about `app\models\ElaporanKewanganDanPerbelanjaan`.
 */
class ElaporanKewanganDanPerbelanjaanSearch extends ElaporanKewanganDanPerbelanjaan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['elaporan_kewangan_dan_perbelanjaan_id', 'elaporan_pelaksaan_id'], 'integer'],
            [['program_aktiviti_butir', 'jenis_kewangan'], 'safe'],
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
        $query = ElaporanKewanganDanPerbelanjaan::find();

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
            'elaporan_kewangan_dan_perbelanjaan_id' => $this->elaporan_kewangan_dan_perbelanjaan_id,
            'elaporan_pelaksaan_id' => $this->elaporan_pelaksaan_id,
            'jumlah' => $this->jumlah,
        ]);

        $query->andFilterWhere(['like', 'program_aktiviti_butir', $this->program_aktiviti_butir])
            ->andFilterWhere(['like', 'jenis_kewangan', $this->jenis_kewangan]);

        return $dataProvider;
    }
}
