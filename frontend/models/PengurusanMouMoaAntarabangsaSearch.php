<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanMouMoaAntarabangsa;

/**
 * PengurusanMouMoaAntarabangsaSearch represents the model behind the search form about `app\models\PengurusanMouMoaAntarabangsa`.
 */
class PengurusanMouMoaAntarabangsaSearch extends PengurusanMouMoaAntarabangsa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_mou_moa_antarabangsa_id'], 'integer'],
            [['nama_negara_terlibat', 'agensi', 'asas_asas_pertimbangan', 'jangka_waktu_mula', 'jangka_waktu_tamat', 'status', 'tajuk_mou_moa', 'catatan'], 'safe'],
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
        $query = PengurusanMouMoaAntarabangsa::find()
                ->joinWith(['refNegara'])
                ->joinWith(['refAgensiAntarabangsa']);

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
            'pengurusan_mou_moa_antarabangsa_id' => $this->pengurusan_mou_moa_antarabangsa_id,
            'jangka_waktu_mula' => $this->jangka_waktu_mula,
            'jangka_waktu_tamat' => $this->jangka_waktu_tamat,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_negara.desc', $this->nama_negara_terlibat])
            ->andFilterWhere(['like', 'tbl_ref_agensi_antarabangsa.desc', $this->agensi])
            ->andFilterWhere(['like', 'asas_asas_pertimbangan', $this->asas_asas_pertimbangan])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'tajuk_mou_moa', $this->tajuk_mou_moa])
            ->andFilterWhere(['like', 'catatan', $this->catatan]);

        return $dataProvider;
    }
}
