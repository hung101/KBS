<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenilaianPrestasiAtletLatihan;

/**
 * PenilaianPrestasiAtletLatihanSearch represents the model behind the search form about `app\models\PenilaianPrestasiAtletLatihan`.
 */
class PenilaianPrestasiAtletLatihanSearch extends PenilaianPrestasiAtletLatihan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tbl_penilaian_prestasi_atlet_latihan_id', 'penilaian_pestasi_id', 'created_by', 'updated_by', 'penilaian_prestasi_atlet_sasaran_id'], 'integer'],
            [['tarikh_mula', 'tarikh_tamat', 'tempoh', 'tempat', 'keterangan', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = PenilaianPrestasiAtletLatihan::find();

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
            'tbl_penilaian_prestasi_atlet_latihan_id' => $this->tbl_penilaian_prestasi_atlet_latihan_id,
            'penilaian_pestasi_id' => $this->penilaian_pestasi_id,
            'penilaian_prestasi_atlet_sasaran_id' => $this->penilaian_prestasi_atlet_sasaran_id,
            //'tarikh_mula' => $this->tarikh_mula,
            //'tarikh_tamat' => $this->tarikh_tamat,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'tempoh', $this->tempoh])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'session_id', $this->session_id])
                ->andFilterWhere(['like', 'tarikh_mula', $this->tarikh_mula])
                ->andFilterWhere(['like', 'tarikh_tamat', $this->tarikh_tamat]);

        return $dataProvider;
    }
}
