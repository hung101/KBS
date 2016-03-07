<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanKpi;

/**
 * PengurusanKpiSearch represents the model behind the search form about `app\models\PengurusanKpi`.
 */
class PengurusanKpiSearch extends PengurusanKpi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_kpi_id', 'jumlah_sasaran_pingat', 'jumlah_pingat_yang_telah_dimenangi'], 'integer'],
            [['nama_sukan', 'nama_acara', 'rekod_baru_yang_dicipta', 'senarai_atlet_yang_memenangi'], 'safe'],
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
        $query = PengurusanKpi::find()
                ->joinWith(['refSukan'])
                ->joinWith(['refAcara']);

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
            'pengurusan_kpi_id' => $this->pengurusan_kpi_id,
            'jumlah_sasaran_pingat' => $this->jumlah_sasaran_pingat,
            'jumlah_pingat_yang_telah_dimenangi' => $this->jumlah_pingat_yang_telah_dimenangi,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->nama_sukan])
            ->andFilterWhere(['like', 'tbl_ref_acara.desc', $this->nama_acara])
            ->andFilterWhere(['like', 'rekod_baru_yang_dicipta', $this->rekod_baru_yang_dicipta])
            ->andFilterWhere(['like', 'senarai_atlet_yang_memenangi', $this->senarai_atlet_yang_memenangi]);

        return $dataProvider;
    }
}
