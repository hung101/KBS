<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ElaporanPelaksanaanKerjasama;

/**
 * ElaporanPelaksanaanKerjasamaSearch represents the model behind the search form about `app\models\ElaporanPelaksanaanKerjasama`.
 */
class ElaporanPelaksanaanKerjasamaSearch extends ElaporanPelaksanaanKerjasama
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['elaporan_pelaksanaan_kerjasama_id', 'elaporan_pelaksaan_id'], 'integer'],
            [['nama_kerjasama', 'session_id'], 'safe'],
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
        $query = ElaporanPelaksanaanKerjasama::find();

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
            'elaporan_pelaksanaan_kerjasama_id' => $this->elaporan_pelaksanaan_kerjasama_id,
            'elaporan_pelaksaan_id' => $this->elaporan_pelaksaan_id,
        ]);

        $query->andFilterWhere(['like', 'nama_kerjasama', $this->nama_kerjasama])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
