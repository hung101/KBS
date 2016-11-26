<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletPencapaian;

/**
 * AtletPencapaianSearch represents the model behind the search form about `app\models\AtletPencapaian`.
 */
class AtletPencapaianSearch extends AtletPencapaian
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pencapaian_id', 'atlet_id', 'insentif_id'], 'integer'],
            [['nama_kejohanan_temasya', 'peringkat_kejohanan', 'tarikh_mula_kejohanan', 'tarikh_tamat_kejohanan', 'nama_sukan', 'nama_acara', 'lokasi_kejohanan', 
                'pencapaian', 'jenis_rekod'], 'safe'],
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
        $query = AtletPencapaian::find()
                ->joinWith(['refJenisRekod'])
                ->joinWith(['refKeputusan'])
                ->orderBy([
	           'tarikh_mula_kejohanan'=>SORT_DESC,
	        ]);

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
            'pencapaian_id' => $this->pencapaian_id,
            'atlet_id' => $this->atlet_id,
            //'tarikh_mula_kejohanan' => $this->tarikh_mula_kejohanan,
            //'tarikh_tamat_kejohanan' => $this->tarikh_tamat_kejohanan,
            'insentif_id' => $this->insentif_id,
        ]);

        $query->andFilterWhere(['like', 'nama_kejohanan_temasya', $this->nama_kejohanan_temasya])
            ->andFilterWhere(['like', 'peringkat_kejohanan', $this->peringkat_kejohanan])
                 ->andFilterWhere(['like', 'tarikh_mula_kejohanan', $this->tarikh_mula_kejohanan])
                 ->andFilterWhere(['like', 'tarikh_tamat_kejohanan', $this->tarikh_tamat_kejohanan])
            ->andFilterWhere(['like', 'nama_sukan', $this->nama_sukan])
            ->andFilterWhere(['like', 'nama_acara', $this->nama_acara])
                ->andFilterWhere(['like', 'tbl_ref_keputusan.desc', $this->nama_acara])
                 ->andFilterWhere(['like', 'tbl_ref_jenis_rekod.desc', $this->jenis_rekod])
            ->andFilterWhere(['like', 'lokasi_kejohanan', $this->lokasi_kejohanan]);

        return $dataProvider;
    }
}
