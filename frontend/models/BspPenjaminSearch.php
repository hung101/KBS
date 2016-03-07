<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BspPenjamin;

/**
 * BspPenjaminSearch represents the model behind the search form about `app\models\BspPenjamin`.
 */
class BspPenjaminSearch extends BspPenjamin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_penjamin_id', 'bsp_pemohon_id'], 'integer'],
            [['nama', 'no_kad_pengenalan', 'alamat_tetap_1', 'alamat_tetap_2', 'alamat_tetap_3', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'alamat_surat_menyurat_1', 'alamat_surat_menyurat_2', 'alamat_surat_menyurat_3', 'alamat_surat_menyurat_negeri', 'alamat_surat_menyurat_bandar', 'alamat_surat_menyurat_poskod', 'no_telefon_rumah', 'no_telefon_pejabat', 'no_telefon_bimbit', 'email', 'alamat_pejabat_1', 'alamat_pejabat_2', 'alamat_pejabat_3', 'alamat_pejabat_negeri', 'alamat_pejabat_bandar', 'alamat_pejabat_poskod'], 'safe'],
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
        $query = BspPenjamin::find();

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
            'bsp_penjamin_id' => $this->bsp_penjamin_id,
            'bsp_pemohon_id' => $this->bsp_pemohon_id,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
            ->andFilterWhere(['like', 'alamat_tetap_1', $this->alamat_tetap_1])
            ->andFilterWhere(['like', 'alamat_tetap_2', $this->alamat_tetap_2])
            ->andFilterWhere(['like', 'alamat_tetap_3', $this->alamat_tetap_3])
            ->andFilterWhere(['like', 'alamat_negeri', $this->alamat_negeri])
            ->andFilterWhere(['like', 'alamat_bandar', $this->alamat_bandar])
            ->andFilterWhere(['like', 'alamat_poskod', $this->alamat_poskod])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_1', $this->alamat_surat_menyurat_1])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_2', $this->alamat_surat_menyurat_2])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_3', $this->alamat_surat_menyurat_3])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_negeri', $this->alamat_surat_menyurat_negeri])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_bandar', $this->alamat_surat_menyurat_bandar])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_poskod', $this->alamat_surat_menyurat_poskod])
            ->andFilterWhere(['like', 'no_telefon_rumah', $this->no_telefon_rumah])
            ->andFilterWhere(['like', 'no_telefon_pejabat', $this->no_telefon_pejabat])
            ->andFilterWhere(['like', 'no_telefon_bimbit', $this->no_telefon_bimbit])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'alamat_pejabat_1', $this->alamat_pejabat_1])
            ->andFilterWhere(['like', 'alamat_pejabat_2', $this->alamat_pejabat_2])
            ->andFilterWhere(['like', 'alamat_pejabat_3', $this->alamat_pejabat_3])
            ->andFilterWhere(['like', 'alamat_pejabat_negeri', $this->alamat_pejabat_negeri])
            ->andFilterWhere(['like', 'alamat_pejabat_bandar', $this->alamat_pejabat_bandar])
            ->andFilterWhere(['like', 'alamat_pejabat_poskod', $this->alamat_pejabat_poskod]);

        return $dataProvider;
    }
}
