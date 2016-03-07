<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanBiasiswaAtlet;

/**
 * PengurusanBiasiswaAtletSearch represents the model behind the search form about `app\models\PengurusanBiasiswaAtlet`.
 */
class PengurusanBiasiswaAtletSearch extends PengurusanBiasiswaAtlet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_biasiswa_atlet_id'], 'integer'],
            [['tarikh_mula', 'tarikh_akhir', 'atlet_id', 'nama_biasiswa_sponsor'], 'safe'],
            [['jumlah_penajaan'], 'number'],
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
        $query = PengurusanBiasiswaAtlet::find()
                ->joinWith(['refAtlet']);

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
            'pengurusan_biasiswa_atlet_id' => $this->pengurusan_biasiswa_atlet_id,
            //'atlet_id' => $this->atlet_id,
            'tarikh_mula' => $this->tarikh_mula,
            'tarikh_akhir' => $this->tarikh_akhir,
            'jumlah_penajaan' => $this->jumlah_penajaan,
        ]);

        $query->andFilterWhere(['like', 'nama_biasiswa_sponsor', $this->nama_biasiswa_sponsor])
                ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id]);

        return $dataProvider;
    }
}
