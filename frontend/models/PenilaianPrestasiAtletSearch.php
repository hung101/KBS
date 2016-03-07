<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenilaianPrestasiAtlet;

/**
 * PenilaianPrestasiAtletSearch represents the model behind the search form about `app\models\PenilaianPrestasiAtlet`.
 */
class PenilaianPrestasiAtletSearch extends PenilaianPrestasiAtlet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penilaian_prestasi_atlet_id', 'break_record'], 'integer'],
            [['tahap_kesihatan', 'atlet_id', 'tahap_kecederaan', 'tahun_penilaian', 'jadual_latihan', 'nama_sukan', 'nama_acara', 'sasaran', 'keputusan', 'maklumat_shakam_shakar'], 'safe'],
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
        $query = PenilaianPrestasiAtlet::find()
                ->joinWith(['refAtlet']);

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
            'penilaian_prestasi_atlet_id' => $this->penilaian_prestasi_atlet_id,
            //'atlet_id' => $this->atlet_id,
            'tahun_penilaian' => $this->tahun_penilaian,
            'jadual_latihan' => $this->jadual_latihan,
            'break_record' => $this->break_record,
        ]);

        $query->andFilterWhere(['like', 'tahap_kesihatan', $this->tahap_kesihatan])
            ->andFilterWhere(['like', 'tahap_kecederaan', $this->tahap_kecederaan])
            ->andFilterWhere(['like', 'nama_sukan', $this->nama_sukan])
            ->andFilterWhere(['like', 'nama_acara', $this->nama_acara])
            ->andFilterWhere(['like', 'sasaran', $this->sasaran])
            ->andFilterWhere(['like', 'keputusan', $this->keputusan])
            ->andFilterWhere(['like', 'maklumat_shakam_shakar', $this->maklumat_shakam_shakar])
                ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id]);

        return $dataProvider;
    }
}
