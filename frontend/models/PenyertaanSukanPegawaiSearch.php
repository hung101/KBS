<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenyertaanSukanPegawai;

/**
 * PenyertaanSukanPegawaiSearch represents the model behind the search form about `app\models\PenyertaanSukanPegawai`.
 */
class PenyertaanSukanPegawaiSearch extends PenyertaanSukanPegawai
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penyertaan_sukan_pegawai_id', 'penyertaan_sukan_id'], 'integer'],
            [['nama', 'jawatan', 'session_id'], 'safe'],
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
        $query = PenyertaanSukanPegawai::find();

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
            'penyertaan_sukan_pegawai_id' => $this->penyertaan_sukan_pegawai_id,
            'penyertaan_sukan_id' => $this->penyertaan_sukan_id,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'jawatan', $this->jawatan])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
