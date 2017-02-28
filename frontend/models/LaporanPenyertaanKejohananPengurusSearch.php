<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LaporanPenyertaanKejohananPengurus;

/**
 * LaporanPenyertaanKejohananPengurusSearch represents the model behind the search form about `app\models\LaporanPenyertaanKejohananPengurusSearch`.
 */
class LaporanPenyertaanKejohananPengurusSearch extends LaporanPenyertaanKejohananPengurus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['laporan_penyertaan_kejohanan_pengurus_id', 'penyertaan_sukan_id'], 'integer'],
            [['nama', 'session_id'], 'safe'],
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
    public function search($params, $penyertaan_sukan_id)
    {
        $query = LaporanPenyertaanKejohananPengurusSearch::find()->where(['penyertaan_sukan_id' => $penyertaan_sukan_id]);

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
            'laporan_penyertaan_kejohanan_pengurus_id' => $this->laporan_penyertaan_kejohanan_pengurus_id,
            'penyertaan_sukan_id' => $this->penyertaan_sukan_id,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
