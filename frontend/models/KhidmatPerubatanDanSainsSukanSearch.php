<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KhidmatPerubatanDanSainsSukan;

/**
 * KhidmatPerubatanDanSainsSukanSearch represents the model behind the search form about `app\models\KhidmatPerubatanDanSainsSukan`.
 */
class KhidmatPerubatanDanSainsSukanSearch extends KhidmatPerubatanDanSainsSukan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['khidmat_perubatan_dan_sains_sukan_id', 'sukan', 'program', 'created_by', 'updated_by'], 'integer'],
            [['tempat', 'tarikh_mula', 'tarikh_tamat', 'status', 'muat_naik', 'kecederaan_jika_ada', 'mod_latihan', 'sasaran', 'created', 'updated', 'kategori_servis', 'servis'], 'safe'],
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
        $query = KhidmatPerubatanDanSainsSukan::find()
                ->joinWith(['refStatusKhidmatPerubatan'])
                ->joinWith(['refKategoriServis'])
                ->joinWith(['refKategoriServisSub'])
                ->joinWith(['refTempatKhidmatPerubatan']);

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
            'khidmat_perubatan_dan_sains_sukan_id' => $this->khidmat_perubatan_dan_sains_sukan_id,
            //'kategori_servis' => $this->kategori_servis,
            //'servis' => $this->servis,
            //'tarikh_mula' => $this->tarikh_mula,
            //'tarikh_tamat' => $this->tarikh_tamat,
            'sukan' => $this->sukan,
            'program' => $this->program,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_tempat_khidmat_perubatan.desc', $this->tempat])
            ->andFilterWhere(['like', 'tbl_ref_status_khidmat_perubatan.desc', $this->status])
                ->andFilterWhere(['like', 'tbl_ref_kategori_servis.desc', $this->kategori_servis])
                ->andFilterWhere(['like', 'tbl_ref_kategori_servis_sub.desc', $this->servis])
            ->andFilterWhere(['like', 'muat_naik', $this->muat_naik])
            ->andFilterWhere(['like', 'kecederaan_jika_ada', $this->kecederaan_jika_ada])
            ->andFilterWhere(['like', 'mod_latihan', $this->mod_latihan])
            ->andFilterWhere(['like', 'sasaran', $this->sasaran])
                ->andFilterWhere(['like', 'tarikh_mula', $this->tarikh_mula])
                ->andFilterWhere(['like', 'tarikh_tamat', $this->tarikh_tamat]);

        return $dataProvider;
    }
}
