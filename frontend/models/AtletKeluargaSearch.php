<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletKeluarga;

/**
 * AtletKeluargaSearch represents the model behind the search form about `app\models\AtletKeluarga`.
 */
class AtletKeluargaSearch extends AtletKeluarga
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keluarga_id', 'atlet_id'], 'integer'],
            [['nama', 'hubungan', 'no_kad_pengenalan', 'tarikh_lahir', 'pekerjaan', 'bangsa', 'agama', 'no_tel'], 'safe'],
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
        $query = AtletKeluarga::find()
                ->joinWith(['refHubungan']);

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
            'keluarga_id' => $this->keluarga_id,
            'atlet_id' => $this->atlet_id,
            'tarikh_lahir' => $this->tarikh_lahir,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'tbl_ref_hubungan.desc', $this->hubungan])
            ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
            ->andFilterWhere(['like', 'pekerjaan', $this->pekerjaan])
            ->andFilterWhere(['like', 'bangsa', $this->bangsa])
            ->andFilterWhere(['like', 'agama', $this->agama])
            ->andFilterWhere(['like', 'no_tel', $this->no_tel]);

        return $dataProvider;
    }
}
