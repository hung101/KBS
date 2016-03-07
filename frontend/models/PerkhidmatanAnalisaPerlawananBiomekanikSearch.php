<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PerkhidmatanAnalisaPerlawananBiomekanik;

/**
 * PerkhidmatanAnalisaPerlawananBiomekanikSearch represents the model behind the search form about `app\models\PerkhidmatanAnalisaPerlawananBiomekanik`.
 */
class PerkhidmatanAnalisaPerlawananBiomekanikSearch extends PerkhidmatanAnalisaPerlawananBiomekanik
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['perkhidmatan_analisa_perlawanan_biomekanik_id', 'permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id'], 'integer'],
            [['perkhidmatan', 'tarikh', 'pegawai_yang_bertanggungjawab', 'status_ujian', 'catitan_ringkas'], 'safe'],
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
        $query = PerkhidmatanAnalisaPerlawananBiomekanik::find()
                ->joinWith(['refPerkhidmatanBiomekanik']);

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
            'perkhidmatan_analisa_perlawanan_biomekanik_id' => $this->perkhidmatan_analisa_perlawanan_biomekanik_id,
            'permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id' => $this->permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id,
            'tarikh' => $this->tarikh,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_perkhidmatan_biomekanik.desc', $this->perkhidmatan])
            ->andFilterWhere(['like', 'pegawai_yang_bertanggungjawab', $this->pegawai_yang_bertanggungjawab])
            ->andFilterWhere(['like', 'status_ujian', $this->status_ujian])
            ->andFilterWhere(['like', 'catitan_ringkas', $this->catitan_ringkas]);

        return $dataProvider;
    }
}
