<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LaporanPendedahanLatihanJurulatih;

/**
 * LaporanPendedahanLatihanJurulatihSearchSearch represents the model behind the search form about `app\models\LaporanPendedahanLatihanJurulatihSearchSearch`.
 */
class LaporanPendedahanLatihanJurulatihSearch extends LaporanPendedahanLatihanJurulatih
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['laporan_pendedahan_latihan_jurulatih_id', 'penyertaan_sukan_id', 'jurulatih_id'], 'integer'],
            [['session_id'], 'safe'],
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
        $query = LaporanPendedahanLatihanJurulatih::find()->where(['penyertaan_sukan_id' => $penyertaan_sukan_id]);

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
            'laporan_pendedahan_latihan_jurulatih_id' => $this->laporan_pendedahan_latihan_jurulatih_id,
            'penyertaan_sukan_id' => $this->penyertaan_sukan_id,
        ]);

        $query->andFilterWhere(['like', 'jurulatih_id', $this->jurulatih_id])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
