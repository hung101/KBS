<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanKemudahanAduanKerosakan;

/**
 * PengurusanKemudahanAduanKerosakanSearch represents the model behind the search form about `app\models\PengurusanKemudahanAduanKerosakan`.
 */
class PengurusanKemudahanAduanKerosakanSearch extends PengurusanKemudahanAduanKerosakan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_kemudahan_aduan_kerosakan_id', 'pengurusan_kemudahan_aduan_id'], 'integer'],
            [['jenis_kerosakan', 'lokasi_kerosakan'], 'safe'],
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
        $query = PengurusanKemudahanAduanKerosakan::find();

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
            'pengurusan_kemudahan_aduan_kerosakan_id' => $this->pengurusan_kemudahan_aduan_kerosakan_id,
            'pengurusan_kemudahan_aduan_id' => $this->pengurusan_kemudahan_aduan_id,
        ]);

        $query->andFilterWhere(['like', 'jenis_kerosakan', $this->jenis_kerosakan])
            ->andFilterWhere(['like', 'lokasi_kerosakan', $this->lokasi_kerosakan]);

        return $dataProvider;
    }
}
