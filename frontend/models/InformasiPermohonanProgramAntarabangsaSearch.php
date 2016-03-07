<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InformasiPermohonanProgramAntarabangsa;

/**
 * InformasiPermohonanProgramAntarabangsaSearch represents the model behind the search form about `app\models\InformasiPermohonanProgramAntarabangsa`.
 */
class InformasiPermohonanProgramAntarabangsaSearch extends InformasiPermohonanProgramAntarabangsa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['informasi_permohonan_id', 'forum_seminar_persidangan_di_luar_negara_id'], 'integer'],
            [['butiran_permohonan', 'muatnaik_dokumen', 'session_id'], 'safe'],
            [['amaun'], 'number'],
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
        $query = InformasiPermohonanProgramAntarabangsa::find();

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
            'informasi_permohonan_id' => $this->informasi_permohonan_id,
            'forum_seminar_persidangan_di_luar_negara_id' => $this->forum_seminar_persidangan_di_luar_negara_id,
            'amaun' => $this->amaun,
        ]);

        $query->andFilterWhere(['like', 'butiran_permohonan', $this->butiran_permohonan])
            ->andFilterWhere(['like', 'muatnaik_dokumen', $this->muatnaik_dokumen])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
