<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenyertaanSukanAduan;

/**
 * PenyertaanSukanAduanSearch represents the model behind the search form about `app\models\PenyertaanSukanAduan`.
 */
class PenyertaanSukanAduanSearch extends PenyertaanSukanAduan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penyertaan_sukan_aduan_id'], 'integer'],
            [['nama_pengadu', 'tarikh_aduan', 'status_aduan', 'aduan_kategori', 'penyataan_aduan'], 'safe'],
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
        $query = PenyertaanSukanAduan::find()
                ->joinWith(['refStatusAduanPenyertaanSukan'])
                ->joinWith(['refKategoriAduanPenyertaanSukan']);

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
            'penyertaan_sukan_aduan_id' => $this->penyertaan_sukan_aduan_id,
        ]);

        $query->andFilterWhere(['like', 'nama_pengadu', $this->nama_pengadu])
            ->andFilterWhere(['like', 'tbl_ref_status_aduan_penyertaan_sukan.desc', $this->status_aduan])
            ->andFilterWhere(['like', 'tbl_ref_kategori_aduan_penyertaan_sukan.desc', $this->aduan_kategori])
            ->andFilterWhere(['like', 'penyataan_aduan', $this->penyataan_aduan])
                ->andFilterWhere(['like', 'tarikh_aduan', $this->tarikh_aduan]);

        return $dataProvider;
    }
}
