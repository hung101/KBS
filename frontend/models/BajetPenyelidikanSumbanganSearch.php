<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BajetPenyelidikanSumbangan;

/**
 * BajetPenyelidikanSumbanganSearch represents the model behind the search form about `app\models\BajetPenyelidikanSumbangan`.
 */
class BajetPenyelidikanSumbanganSearch extends BajetPenyelidikanSumbangan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bajet_penyelidikan_id', 'permohonana_penyelidikan_id'], 'integer'],
            [['jenis_bajet', 'tahun_1', 'session_id'], 'safe'],
            [['jumlah'], 'number'],
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
        $query = BajetPenyelidikanSumbangan::find()
                ->joinWith(['refJenisBajetSumbangan']);

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
            'bajet_penyelidikan_id' => $this->bajet_penyelidikan_id,
            'permohonana_penyelidikan_id' => $this->permohonana_penyelidikan_id,
            'tahun_1' => $this->tahun_1,
            'jumlah' => $this->jumlah,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_jenis_bajet_sumbangan.desc', $this->jenis_bajet])
                 ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
