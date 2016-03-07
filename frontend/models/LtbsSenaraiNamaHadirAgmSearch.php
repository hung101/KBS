<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LtbsSenaraiNamaHadirAgm;

/**
 * LtbsSenaraiNamaHadirAgmSearch represents the model behind the search form about `app\models\LtbsSenaraiNamaHadirAgm`.
 */
class LtbsSenaraiNamaHadirAgmSearch extends LtbsSenaraiNamaHadirAgm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['senarai_nama_hadir_id', 'mesyuarat_agm_id', 'kehadiran'], 'integer'],
            [['nama_penuh', 'no_kad_pengenalan', 'jantina', 'jawatan', 'kategori_keahlian', 'session_id'], 'safe'],
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
        $query = LtbsSenaraiNamaHadirAgm::find()
                ->joinWith(['refKategoriKeahlian']);

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
            'senarai_nama_hadir_id' => $this->senarai_nama_hadir_id,
            'mesyuarat_agm_id' => $this->mesyuarat_agm_id,
            'kehadiran' => $this->kehadiran,
        ]);

        $query->andFilterWhere(['like', 'nama_penuh', $this->nama_penuh])
            ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
            ->andFilterWhere(['like', 'jantina', $this->jantina])
            ->andFilterWhere(['like', 'jawatan', $this->jawatan])
            ->andFilterWhere(['like', 'kategori_keahlian', $this->kategori_keahlian])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
