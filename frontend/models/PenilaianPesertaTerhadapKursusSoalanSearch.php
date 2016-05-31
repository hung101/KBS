<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenilaianPesertaTerhadapKursusSoalan;

/**
 * PenilaianPesertaTerhadapKursusSoalanSearch represents the model behind the search form about `app\models\PenilaianPesertaTerhadapKursusSoalan`.
 */
class PenilaianPesertaTerhadapKursusSoalanSearch extends PenilaianPesertaTerhadapKursusSoalan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penilaian_peserta_terhadap_kursus_soalan_id', 'penilaian_peserta_terhadap_kursus_id', 'created_by', 'updated_by'], 'integer'],
            [['session_id', 'created', 'updated', 'kategori_soalan', 'soalan', 'skala'], 'safe'],
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
        $query = PenilaianPesertaTerhadapKursusSoalan::find()
                ->joinWith(['refKategoriSoalanPeserta'])
                ->joinWith(['refSoalanPeserta'])
                ->joinWith(['refRatingSoalan']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'penilaian_peserta_terhadap_kursus_soalan_id' => $this->penilaian_peserta_terhadap_kursus_soalan_id,
            'penilaian_peserta_terhadap_kursus_id' => $this->penilaian_peserta_terhadap_kursus_id,
            //'kategori_soalan' => $this->kategori_soalan,
            //'soalan' => $this->soalan,
            //'skala' => $this->skala,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'session_id', $this->session_id])
                ->andFilterWhere(['like', 'tbl_ref_kategori_soalan_peserta.desc', $this->soalan])
                ->andFilterWhere(['like', 'tbl_ref_soalan_peserta.desc', $this->soalan])
                ->andFilterWhere(['like', 'tbl_ref_rating_soalan.desc', $this->skala]);

        return $dataProvider;
    }
}
