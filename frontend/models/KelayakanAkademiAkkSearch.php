<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KelayakanAkademiAkk;

/**
 * KelayakanAkademiAkkSearch represents the model behind the search form about `app\models\KelayakanAkademiAkk`.
 */
class KelayakanAkademiAkkSearch extends KelayakanAkademiAkk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kelayakan_akademi_akk_id', 'akademi_akk_id'], 'integer'],
            [['nama_peperiksaan', 'tahun', 'keputusan', 'session_id'], 'safe'],
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
        $query = KelayakanAkademiAkk::find();

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
            'kelayakan_akademi_akk_id' => $this->kelayakan_akademi_akk_id,
            'akademi_akk_id' => $this->akademi_akk_id,
            'tahun' => $this->tahun,
        ]);

        $query->andFilterWhere(['like', 'nama_peperiksaan', $this->nama_peperiksaan])
            ->andFilterWhere(['like', 'keputusan', $this->keputusan])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
