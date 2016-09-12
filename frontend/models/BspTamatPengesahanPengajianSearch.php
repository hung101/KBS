<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BspTamatPengesahanPengajian;

/**
 * BspTamatPengesahanPengajianSearch represents the model behind the search form about `app\models\BspTamatPengesahanPengajian`.
 */
class BspTamatPengesahanPengajianSearch extends BspTamatPengesahanPengajian
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_tamat_pengesahan_pengajian_id'], 'integer'],
            [['nama_ipts', 'pengajian', 'bidang', 'cgpa_pngk', 'tarikh_tamat', 'nama_pelajar'], 'safe'],
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
        $query = BspTamatPengesahanPengajian::find()
                ->joinWith(['refPengajianEBiasiswa']);

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
            'bsp_tamat_pengesahan_pengajian_id' => $this->bsp_tamat_pengesahan_pengajian_id,
            'tarikh_tamat' => $this->tarikh_tamat,
        ]);

        $query->andFilterWhere(['like', 'nama_ipts', $this->nama_ipts])
            ->andFilterWhere(['like', 'tbl_ref_pengajian_e_biasiswa.desc', $this->pengajian])
            ->andFilterWhere(['like', 'bidang', $this->bidang])
                ->andFilterWhere(['like', 'nama_pelajar', $this->nama_pelajar])
            ->andFilterWhere(['like', 'cgpa_pngk', $this->cgpa_pngk]);

        return $dataProvider;
    }
}
