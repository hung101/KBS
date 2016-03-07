<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BspPembayaran;

/**
 * BspPembayaranSearch represents the model behind the search form about `app\models\BspPembayaran`.
 */
class BspPembayaranSearch extends BspPembayaran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_pembayaran_id', 'bsp_pemohon_id'], 'integer'],
            [['tarikh', 'session_id', 'semester'], 'safe'],
            [['bayaran'], 'number'],
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
        $query = BspPembayaran::find()
                ->joinWith(['refPemohonEBiasiswa'])
                ->joinWith(['refSemesterTerkini']);

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
            'bsp_pembayaran_id' => $this->bsp_pembayaran_id,
            'bsp_pemohon_id' => $this->bsp_pemohon_id,
            'tarikh' => $this->tarikh,
            'bayaran' => $this->bayaran,
        ]);
        
        $query->andFilterWhere(['like', 'session_id', $this->session_id])
                ->andFilterWhere(['like', 'tbl_ref_semester_terkini.desc', $this->semester]);

        return $dataProvider;
    }
}
