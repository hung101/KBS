<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletPembangunanKursuskem;

/**
 * AtletPembangunanKursuskemSearch represents the model behind the search form about `app\models\AtletPembangunanKursuskem`.
 */
class AtletPembangunanKursuskemSearch extends AtletPembangunanKursuskem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kursus_kem_id', 'atlet_id'], 'integer'],
            [['tarikh_mula', 'tarikh_tamat', 'lokasi', 'jenis', 'nama_kursus_kem'], 'safe'],
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
        $query = AtletPembangunanKursuskem::find()
                ->joinWith(['refJenisKursuskem']);

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
            'kursus_kem_id' => $this->kursus_kem_id,
            'atlet_id' => $this->atlet_id,
            //'jenis' => $this->jenis,
            'tarikh_mula' => $this->tarikh_mula,
            'tarikh_tamat' => $this->tarikh_tamat,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_jenis_kursuskem.desc', $this->jenis])
              ->andFilterWhere(['like', 'lokasi', $this->lokasi])
            ->andFilterWhere(['like', 'nama_kursus_kem', $this->nama_kursus_kem]);

        return $dataProvider;
    }
}
