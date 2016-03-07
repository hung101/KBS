<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PemohonKursusTahapAkk;

/**
 * PemohonKursusTahapAkkSearch represents the model behind the search form about `app\models\PemohonKursusTahapAkk`.
 */
class PemohonKursusTahapAkkSearch extends PemohonKursusTahapAkk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pemohon_kursus_tahap_akk_id', 'akademi_akk_id'], 'integer'],
            [['tahap', 'tahun_lulus', 'no_sijil', 'kod_kursus', 'tempat', 'muatnaik_sijil', 'session_id'], 'safe'],
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
        $query = PemohonKursusTahapAkk::find()
                ->joinWith(['refTahapSainsSukan']);

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
            'pemohon_kursus_tahap_akk_id' => $this->pemohon_kursus_tahap_akk_id,
            'akademi_akk_id' => $this->akademi_akk_id,
            'tahun_lulus' => $this->tahun_lulus,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_tahap_sains_sukan.desc', $this->tahap])
            ->andFilterWhere(['like', 'no_sijil', $this->no_sijil])
            ->andFilterWhere(['like', 'kod_kursus', $this->kod_kursus])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'muatnaik_sijil', $this->muatnaik_sijil])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
