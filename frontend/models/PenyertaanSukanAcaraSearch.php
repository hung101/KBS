<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenyertaanSukanAcara;

/**
 * PenyertaanSukanAcaraSearch represents the model behind the search form about `app\models\PenyertaanSukanAcara`.
 */
class PenyertaanSukanAcaraSearch extends PenyertaanSukanAcara
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penyertaan_sukan_acara_id', 'penyertaan_sukan_id', 'jumlah_pingat', 'rekod_baru'], 'integer'],
            [['nama_acara', 'tarikh_acara', 'keputusan_acara', 'catatan_rekod_baru', 'session_id'], 'safe'],
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
        $query = PenyertaanSukanAcara::find()
                ->joinWith(['refAcara']);

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
            'penyertaan_sukan_acara_id' => $this->penyertaan_sukan_acara_id,
            'penyertaan_sukan_id' => $this->penyertaan_sukan_id,
            'tarikh_acara' => $this->tarikh_acara,
            'jumlah_pingat' => $this->jumlah_pingat,
            'rekod_baru' => $this->rekod_baru,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_acara.desc', $this->nama_acara])
            ->andFilterWhere(['like', 'keputusan_acara', $this->keputusan_acara])
            ->andFilterWhere(['like', 'catatan_rekod_baru', $this->catatan_rekod_baru])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
