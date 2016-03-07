<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanEBantuanAnggaranPerbelanjaan;

/**
 * PermohonanEBantuanAnggaranPerbelanjaanSearch represents the model behind the search form about `app\models\PermohonanEBantuanAnggaranPerbelanjaan`.
 */
class PermohonanEBantuanAnggaranPerbelanjaanSearch extends PermohonanEBantuanAnggaranPerbelanjaan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['anggaran_perbelanjaan_id', 'permohonan_e_bantuan_id'], 'integer'],
            [['butir_butir_perbelanjaan', 'session_id'], 'safe'],
            [['jumlah_perbelanjaan'], 'number'],
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
        $query = PermohonanEBantuanAnggaranPerbelanjaan::find();

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
            'anggaran_perbelanjaan_id' => $this->anggaran_perbelanjaan_id,
            'permohonan_e_bantuan_id' => $this->permohonan_e_bantuan_id,
            'jumlah_perbelanjaan' => $this->jumlah_perbelanjaan,
        ]);

        $query->andFilterWhere(['like', 'butir_butir_perbelanjaan', $this->butir_butir_perbelanjaan])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
