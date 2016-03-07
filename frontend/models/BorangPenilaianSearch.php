<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BorangPenilaian;

/**
 * BorangPenilaianSearch represents the model behind the search form about `app\models\BorangPenilaian`.
 */
class BorangPenilaianSearch extends BorangPenilaian
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['borang_penilaian_id'], 'integer'],
            [['nama_program', 'tarikh_program', 'tempat'], 'safe'],
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
        $query = BorangPenilaian::find();

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
            'borang_penilaian_id' => $this->borang_penilaian_id,
            'tarikh_program' => $this->tarikh_program,
        ]);

        $query->andFilterWhere(['like', 'nama_program', $this->nama_program])
            ->andFilterWhere(['like', 'tempat', $this->tempat]);

        return $dataProvider;
    }
}
