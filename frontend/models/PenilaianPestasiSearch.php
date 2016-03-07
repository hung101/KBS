<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenilaianPestasi;

/**
 * PenilaianPestasiSearch represents the model behind the search form about `app\models\PenilaianPestasi`.
 */
class PenilaianPestasiSearch extends PenilaianPestasi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penilaian_pestasi_id'], 'integer'],
            [['tahap_sihat', 'atlet_id', 'pencapaian_sukan_dalam_tahun_yang_dinilai', 'kecederaan_jika_ada', 'laporan_kesihatan', 'skim_hadiah_kemenangan_sukan'], 'safe'],
            [['elaun_yang_diterima'], 'number'],
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
        $query = PenilaianPestasi::find()
                ->joinWith(['atlet']);

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
            'penilaian_pestasi_id' => $this->penilaian_pestasi_id,
            //'atlet_id' => $this->atlet_id,
            'elaun_yang_diterima' => $this->elaun_yang_diterima,
        ]);

        $query->andFilterWhere(['like', 'tahap_sihat', $this->tahap_sihat])
                ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id])
            ->andFilterWhere(['like', 'pencapaian_sukan_dalam_tahun_yang_dinilai', $this->pencapaian_sukan_dalam_tahun_yang_dinilai])
            ->andFilterWhere(['like', 'kecederaan_jika_ada', $this->kecederaan_jika_ada])
            ->andFilterWhere(['like', 'laporan_kesihatan', $this->laporan_kesihatan])
            ->andFilterWhere(['like', 'skim_hadiah_kemenangan_sukan', $this->skim_hadiah_kemenangan_sukan]);

        return $dataProvider;
    }
}
