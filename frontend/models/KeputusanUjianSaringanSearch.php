<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KeputusanUjianSaringan;

/**
 * KeputusanUjianSaringanSearch represents the model behind the search form about `app\models\KeputusanUjianSaringan`.
 */
class KeputusanUjianSaringanSearch extends KeputusanUjianSaringan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keputusan_ujian_saringan_id', 'ujian_saringan_id'], 'integer'],
            [['jenis_ujian_saringan'], 'safe'],
            [['percubaan_1', 'percubaan_2', 'terbaik'], 'number'],
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
        $query = KeputusanUjianSaringan::find();

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
            'keputusan_ujian_saringan_id' => $this->keputusan_ujian_saringan_id,
            'ujian_saringan_id' => $this->ujian_saringan_id,
            'percubaan_1' => $this->percubaan_1,
            'percubaan_2' => $this->percubaan_2,
            'terbaik' => $this->terbaik,
        ]);

        $query->andFilterWhere(['like', 'jenis_ujian_saringan', $this->jenis_ujian_saringan]);

        return $dataProvider;
    }
}
