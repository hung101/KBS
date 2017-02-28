<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenyertaanSukanPerbelanjaan;

/**
 * PenyertaanSukanPerbelanjaanSearch represents the model behind the search form about `app\models\PenyertaanSukanPerbelanjaan`.
 */
class PenyertaanSukanPerbelanjaanSearch extends PenyertaanSukanPerbelanjaan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penyertaan_sukan_perbelanjaan_id', 'penyertaan_sukan_id'], 'integer'],
            [['session_id'], 'safe'],
            //[['anggaran_kos_per_kategori', 'revised_kos_per_kategori', 'approved_kos_per_kategori'], 'number'],
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
        $query = PenyertaanSukanPerbelanjaan::find()
                ->joinWith(['refKategoriPerbelanjaanSukan']);

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
            'penyertaan_sukan_perbelanjaan_id' => $this->penyertaan_sukan_perbelanjaan_id,
            'penyertaan_sukan_id' => $this->penyertaan_sukan_id,
        ]);

        //$query->andFilterWhere(['like', 'tbl_ref_kategori_kos_program_binaan.desc', $this->kategori_kos])
        //    ->andFilterWhere(['like', 'catatan', $this->catatan])
        $query->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
