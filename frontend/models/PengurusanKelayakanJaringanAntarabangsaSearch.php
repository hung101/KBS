<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanKelayakanJaringanAntarabangsa;

/**
 * PengurusanKelayakanJaringanAntarabangsaSearch represents the model behind the search form about `app\models\PengurusanKelayakanJaringanAntarabangsa`.
 */
class PengurusanKelayakanJaringanAntarabangsaSearch extends PengurusanKelayakanJaringanAntarabangsa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_kelayakan_jaringan_antarabangsa_id', 'pengurusan_jaringan_antarabangsa_id'], 'integer'],
            [['nama_kursus', 'tarikh', 'tempat', 'tahap_kelayakan', 'session_id'], 'safe'],
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
        $query = PengurusanKelayakanJaringanAntarabangsa::find();

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
            'pengurusan_kelayakan_jaringan_antarabangsa_id' => $this->pengurusan_kelayakan_jaringan_antarabangsa_id,
            'pengurusan_jaringan_antarabangsa_id' => $this->pengurusan_jaringan_antarabangsa_id,
            'tarikh' => $this->tarikh,
        ]);

        $query->andFilterWhere(['like', 'nama_kursus', $this->nama_kursus])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'tahap_kelayakan', $this->tahap_kelayakan])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
