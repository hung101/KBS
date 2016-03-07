<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BorangPermohonanKem;

/**
 * BorangPermohonanKemSearch represents the model behind the search form about `app\models\BorangPermohonanKem`.
 */
class BorangPermohonanKemSearch extends BorangPermohonanKem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['borang_permohonan_kem_id'], 'integer'],
            [['nama_program', 'tarikh_program', 'tempat', 'objektif', 'cadangan'], 'safe'],
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
        $query = BorangPermohonanKem::find();

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
            'borang_permohonan_kem_id' => $this->borang_permohonan_kem_id,
            'tarikh_program' => $this->tarikh_program,
        ]);

        $query->andFilterWhere(['like', 'nama_program', $this->nama_program])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'objektif', $this->objektif])
            ->andFilterWhere(['like', 'cadangan', $this->cadangan]);

        return $dataProvider;
    }
}
