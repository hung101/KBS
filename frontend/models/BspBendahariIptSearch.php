<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BspBendahariIpt;

/**
 * BspBendahariIptSearch represents the model behind the search form about `app\models\BspBendahariIpt`.
 */
class BspBendahariIptSearch extends BspBendahariIpt
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_bendahari_ipt_id'], 'integer'],
            [['nama_pelajar', 'no_kad_pengenalan', 'no_uni_matrix'], 'safe'],
            [['yuran_pengajian'], 'number'],
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
        $query = BspBendahariIpt::find();

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
            'bsp_bendahari_ipt_id' => $this->bsp_bendahari_ipt_id,
            'yuran_pengajian' => $this->yuran_pengajian,
        ]);

        $query->andFilterWhere(['like', 'nama_pelajar', $this->nama_pelajar])
            ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
            ->andFilterWhere(['like', 'no_uni_matrix', $this->no_uni_matrix]);

        return $dataProvider;
    }
}
