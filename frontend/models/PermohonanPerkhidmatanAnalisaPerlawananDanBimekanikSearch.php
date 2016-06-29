<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanPerkhidmatanAnalisaPerlawananDanBimekanik;

/**
 * PermohonanPerkhidmatanAnalisaPerlawananDanBimekanikSearch represents the model behind the search form about `app\models\PermohonanPerkhidmatanAnalisaPerlawananDanBimekanik`.
 */
class PermohonanPerkhidmatanAnalisaPerlawananDanBimekanikSearch extends PermohonanPerkhidmatanAnalisaPerlawananDanBimekanik
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id'], 'integer'],
            [['tarikh', 'sukan', 'tujuan', 'perkhidmatan', 'atlet_id', 'jenis_sukan'], 'safe'],
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
        $query = PermohonanPerkhidmatanAnalisaPerlawananDanBimekanik::find()
                ->joinWith(['refAtlet'])
                ->joinWith(['refPerkhidmatanBiomekanik'])
                ->joinWith(['refSukan']);

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
            'permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id' => $this->permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id,
            //'atlet_id' => $this->atlet_id,
            'tarikh' => $this->tarikh,
        ]);

        $query->andFilterWhere(['like', 'sukan', $this->sukan])
            ->andFilterWhere(['like', 'tujuan', $this->tujuan])
                ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id])
            ->andFilterWhere(['like', 'tbl_ref_perkhidmatan_biomekanik.desc', $this->perkhidmatan])
                ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->jenis_sukan]);

        return $dataProvider;
    }
}
