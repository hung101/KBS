<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanMaklumBalasPeserta;

/**
 * PengurusanMaklumBalasPesertaSearch represents the model behind the search form about `app\models\PengurusanMaklumBalasPeserta`.
 */
class PengurusanMaklumBalasPesertaSearch extends PengurusanMaklumBalasPeserta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_maklum_balas_peserta_id'], 'integer'],
            [['nama_penganjuran_kursus', 'kod_kursus', 'tarikh_kursus', 'catatan', 'bangsa', 'jantina'], 'safe'],
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
        $query = PengurusanMaklumBalasPeserta::find()
                ->joinWith(['refJantina'])
                ->joinWith(['refBangsa']);

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
            'pengurusan_maklum_balas_peserta_id' => $this->pengurusan_maklum_balas_peserta_id,
            'tarikh_kursus' => $this->tarikh_kursus,
        ]);

        $query->andFilterWhere(['like', 'nama_penganjuran_kursus', $this->nama_penganjuran_kursus])
            ->andFilterWhere(['like', 'kod_kursus', $this->kod_kursus])
            ->andFilterWhere(['like', 'catatan', $this->catatan])
                ->andFilterWhere(['like', 'tbl_ref_bangsa.desc', $this->bangsa])
                ->andFilterWhere(['like', 'tbl_ref_jantina.desc', $this->jantina]);

        return $dataProvider;
    }
}
