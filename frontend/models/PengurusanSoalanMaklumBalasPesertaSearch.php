<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanSoalanMaklumBalasPeserta;

/**
 * PengurusanSoalanMaklumBalasPesertaSearch represents the model behind the search form about `app\models\PengurusanSoalanMaklumBalasPeserta`.
 */
class PengurusanSoalanMaklumBalasPesertaSearch extends PengurusanSoalanMaklumBalasPeserta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_soalan_maklum_balas_peserta_id', 'pengurusan_maklum_balas_peserta_id'], 'integer'],
            [['soalan', 'rating'], 'safe'],
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
        $query = PengurusanSoalanMaklumBalasPeserta::find()
                ->joinWith(['refSoalanPenilaianPeserta'])
                ->joinWith(['refRatingSoalanPenilaianPeserta']);

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
            'pengurusan_soalan_maklum_balas_peserta_id' => $this->pengurusan_soalan_maklum_balas_peserta_id,
            'pengurusan_maklum_balas_peserta_id' => $this->pengurusan_maklum_balas_peserta_id,
            //'rating' => $this->rating,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_soalan_penilaian_peserta.desc', $this->soalan])
                ->andFilterWhere(['like', 'tbl_ref_rating_soalan_penilaian_peserta.desc', $this->rating]);

        return $dataProvider;
    }
}
