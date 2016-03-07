<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletKewanganPinjaman;

/**
 * AtletKewanganPinjamanSearch represents the model behind the search form about `app\models\AtletKewanganPinjaman`.
 */
class AtletKewanganPinjamanSearch extends AtletKewanganPinjaman
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pinjaman_id', 'atlet_id', 'tahun_tamat'], 'integer'],
            [['nama_bank', 'jenis_pinjaman', 'no_akaun', 'tahun_permulaan'], 'safe'],
            [['nilai_pinjaman'], 'number'],
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
        $query = AtletKewanganPinjaman::find();

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
            'pinjaman_id' => $this->pinjaman_id,
            'atlet_id' => $this->atlet_id,
            'nilai_pinjaman' => $this->nilai_pinjaman,
            'tahun_tamat' => $this->tahun_tamat,
            'tahun_permulaan' => $this->tahun_permulaan,
        ]);

        $query->andFilterWhere(['like', 'nama_bank', $this->nama_bank])
            ->andFilterWhere(['like', 'jenis_pinjaman', $this->jenis_pinjaman])
            ->andFilterWhere(['like', 'no_akaun', $this->no_akaun]);

        return $dataProvider;
    }
}
