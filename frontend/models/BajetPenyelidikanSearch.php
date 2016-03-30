<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BajetPenyelidikan;

/**
 * BajetPenyelidikanSearch represents the model behind the search form about `app\models\BajetPenyelidikan`.
 */
class BajetPenyelidikanSearch extends BajetPenyelidikan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bajet_penyelidikan_id', 'permohonana_penyelidikan_id'], 'integer'],
            [['jenis_bajet', 'tahun_1'], 'safe'],
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
        $query = BajetPenyelidikan::find()
                ->joinWith(['refJenisBajet']);

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

        $query->andFilterWhere(['like', 'tbl_ref_jenis_bajet.desc', $this->jenis_bajet]);

        return $dataProvider;
    }
}
