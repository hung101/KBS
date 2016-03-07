<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BorangPenilaianKaunseling;

/**
 * BorangPenilaianKaunselingSearch represents the model behind the search form about `app\models\BorangPenilaianKaunseling`.
 */
class BorangPenilaianKaunselingSearch extends BorangPenilaianKaunseling
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['borang_penilaian_kaunseling_id'], 'integer'],
            [['atlet', 'diagnosis', 'preskripsi', 'cadangan', 'rujukan', 'tindakan_selanjutnya', 'kategori_permasalahan', 'tarikh_temujanji', 'profil_konsultan_id'], 'safe'],
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
        $query = BorangPenilaianKaunseling::find()
                ->joinWith(['refUser'])
                ->joinWith(['refAtlet'])
                ->joinWith(['refKategoriMasalahKaunseling']);

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
            'borang_penilaian_kaunseling_id' => $this->borang_penilaian_kaunseling_id,
            //'profil_konsultan_id' => $this->profil_konsultan_id,
            'tarikh_temujanji' => $this->tarikh_temujanji,
        ]);

        $query->andFilterWhere(['like', 'diagnosis', $this->diagnosis])
            ->andFilterWhere(['like', 'preskripsi', $this->preskripsi])
            ->andFilterWhere(['like', 'cadangan', $this->cadangan])
            ->andFilterWhere(['like', 'rujukan', $this->rujukan])
            ->andFilterWhere(['like', 'tindakan_selanjutnya', $this->tindakan_selanjutnya])
            ->andFilterWhere(['like', 'tbl_ref_kategori_masalah_kaunseling.desc', $this->kategori_permasalahan])
            ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet])
            ->andFilterWhere(['like', 'tbl_user.full_name', $this->profil_konsultan_id]);

        return $dataProvider;
    }
}
