<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanPerhubunganDalamDanLuarNegaraMesyuarat;

/**
 * PengurusanPerhubunganDalamDanLuarNegaraMesyuaratSearch represents the model behind the search form about `app\models\PengurusanPerhubunganDalamDanLuarNegaraMesyuarat`.
 */
class PengurusanPerhubunganDalamDanLuarNegaraMesyuaratSearch extends PengurusanPerhubunganDalamDanLuarNegaraMesyuarat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id'], 'integer'],
            [['nama', 'no_kad_pengenalan', 'jawatan', 'alamat_1', 'alamat_2', 'alamat_3', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'no_tel_bimbit', 'emel', 'muatnaik_dokumen', 'nama_kejohonan', 'muatnaik_dokumen_kejohanan', 'status_permohonan'], 'safe'],
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
        $query = PengurusanPerhubunganDalamDanLuarNegaraMesyuarat::find();

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
            'pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id' => $this->pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
            ->andFilterWhere(['like', 'jawatan', $this->jawatan])
            ->andFilterWhere(['like', 'alamat_1', $this->alamat_1])
            ->andFilterWhere(['like', 'alamat_2', $this->alamat_2])
            ->andFilterWhere(['like', 'alamat_3', $this->alamat_3])
            ->andFilterWhere(['like', 'alamat_negeri', $this->alamat_negeri])
            ->andFilterWhere(['like', 'alamat_bandar', $this->alamat_bandar])
            ->andFilterWhere(['like', 'alamat_poskod', $this->alamat_poskod])
            ->andFilterWhere(['like', 'no_tel_bimbit', $this->no_tel_bimbit])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'muatnaik_dokumen', $this->muatnaik_dokumen])
            ->andFilterWhere(['like', 'nama_kejohonan', $this->nama_kejohonan])
            ->andFilterWhere(['like', 'muatnaik_dokumen_kejohanan', $this->muatnaik_dokumen_kejohanan])
            ->andFilterWhere(['like', 'status_permohonan', $this->status_permohonan]);

        return $dataProvider;
    }
}
