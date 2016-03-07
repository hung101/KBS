<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bsp;

/**
 * BspSearch represents the model behind the search form about `app\models\Bsp`.
 */
class BspSearch extends Bsp
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_pemohon_id', 'atlet_id', 'kelulusan'], 'integer'],
            [['peringkat_pengajian', 'bidang_pengajian', 'falkuti_pengajian', 'ipt', 'tahun_mula_pengajian', 'tahun_tamat_pengajian', 'tahun_ditawarkan_biasiswa'], 'safe'],
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
        $query = Bsp::find();

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
            'bsp_pemohon_id' => $this->bsp_pemohon_id,
            'atlet_id' => $this->atlet_id,
            'tahun_mula_pengajian' => $this->tahun_mula_pengajian,
            'tahun_tamat_pengajian' => $this->tahun_tamat_pengajian,
            'tahun_ditawarkan_biasiswa' => $this->tahun_ditawarkan_biasiswa,
            'kelulusan' => $this->kelulusan,
        ]);

        $query->andFilterWhere(['like', 'peringkat_pengajian', $this->peringkat_pengajian])
            ->andFilterWhere(['like', 'bidang_pengajian', $this->bidang_pengajian])
            ->andFilterWhere(['like', 'falkuti_pengajian', $this->falkuti_pengajian])
            ->andFilterWhere(['like', 'ipt', $this->ipt]);

        return $dataProvider;
    }
}
