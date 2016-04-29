<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanKemudahanDanPeralatan;

/**
 * PengurusanKemudahanDanPeralatanSearch represents the model behind the search form about `app\models\PengurusanKemudahanDanPeralatan`.
 */
class PengurusanKemudahanDanPeralatanSearch extends PengurusanKemudahanDanPeralatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_kemudahan_dan_peralatan_id'], 'integer'],
            [['kerja', 'masa', 'catatan_ringkas', 'tindakan_yang_diambil', 'hasil', 'ketidakpatuhan', 'status'], 'safe'],
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
        $query = PengurusanKemudahanDanPeralatan::find()
                ->joinWith(['refKerjaPengurusanKemudahanPeralatan'])
                ->joinWith(['refStatusPengurusanKemudahan']);

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
            'pengurusan_kemudahan_dan_peralatan_id' => $this->pengurusan_kemudahan_dan_peralatan_id,
            'masa' => $this->masa,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_kerja_pengurusan_kemudahan_peralatan.desc', $this->kerja])
            ->andFilterWhere(['like', 'catatan_ringkas', $this->catatan_ringkas])
            ->andFilterWhere(['like', 'tindakan_yang_diambil', $this->tindakan_yang_diambil])
            ->andFilterWhere(['like', 'hasil', $this->hasil])
            ->andFilterWhere(['like', 'ketidakpatuhan', $this->ketidakpatuhan])
                ->andFilterWhere(['like', 'tbl_ref_status_pengurusan_kemudahan.desc', $this->status]);

        return $dataProvider;
    }
}
