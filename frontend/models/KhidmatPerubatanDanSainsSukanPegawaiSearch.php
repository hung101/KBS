<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KhidmatPerubatanDanSainsSukanPegawai;

/**
 * KhidmatPerubatanDanSainsSukanPegawaiSearch represents the model behind the search form about `app\models\KhidmatPerubatanDanSainsSukanPegawai`.
 */
class KhidmatPerubatanDanSainsSukanPegawaiSearch extends KhidmatPerubatanDanSainsSukanPegawai
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['khidmat_perubatan_dan_sains_sukan_pegawai_id', 'khidmat_perubatan_dan_sains_sukan_id', 'created_by', 'updated_by'], 'integer'],
            [['nama_pegawai', 'jawatan', 'agensi', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = KhidmatPerubatanDanSainsSukanPegawai::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'khidmat_perubatan_dan_sains_sukan_pegawai_id' => $this->khidmat_perubatan_dan_sains_sukan_pegawai_id,
            'khidmat_perubatan_dan_sains_sukan_id' => $this->khidmat_perubatan_dan_sains_sukan_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'nama_pegawai', $this->nama_pegawai])
            ->andFilterWhere(['like', 'jawatan', $this->jawatan])
            ->andFilterWhere(['like', 'agensi', $this->agensi])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
