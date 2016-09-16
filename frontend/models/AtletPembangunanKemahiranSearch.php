<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletPembangunanKemahiran;

/**
 * AtletPembangunanKemahiranSearch represents the model behind the search form about `app\models\AtletPembangunanKemahiran`.
 */
class AtletPembangunanKemahiranSearch extends AtletPembangunanKemahiran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kemahiran_id', 'atlet_id'], 'integer'],
            [['jenis_kemahiran', 'nama_kemahiran', 'lokasi', 'penganjur', 'tarikh_mula', 'tarikh_tamat'], 'safe'],
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
        $query = AtletPembangunanKemahiran::find()
                ->joinWith(['refJenisKemahiran']);

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
            'kemahiran_id' => $this->kemahiran_id,
            'atlet_id' => $this->atlet_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_jenis_kemahiran.desc', $this->jenis_kemahiran])
            ->andFilterWhere(['like', 'nama_kemahiran', $this->nama_kemahiran])
                ->andFilterWhere(['like', 'penganjur', $this->penganjur])
                ->andFilterWhere(['like', 'lokasi', $this->lokasi])
                ->andFilterWhere(['like', 'tarikh_mula', $this->tarikh_mula])
                ->andFilterWhere(['like', 'tarikh_tamat', $this->tarikh_tamat]);

        return $dataProvider;
    }
}
