<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ElaporanPelaksanaanKelebihan;

/**
 * ElaporanPelaksanaanKelebihanSearch represents the model behind the search form about `app\models\ElaporanPelaksanaanKelebihan`.
 */
class ElaporanPelaksanaanKelebihanSearch extends ElaporanPelaksanaanKelebihan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['elaporan_pelaksanaan_kelebihan_id', 'elaporan_pelaksaan_id', 'created_by', 'updated_by'], 'integer'],
            [['kelebihan', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = ElaporanPelaksanaanKelebihan::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'elaporan_pelaksanaan_kelebihan_id' => $this->elaporan_pelaksanaan_kelebihan_id,
            'elaporan_pelaksaan_id' => $this->elaporan_pelaksaan_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'kelebihan', $this->kelebihan])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
