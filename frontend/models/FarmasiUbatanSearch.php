<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FarmasiUbatan;

/**
 * FarmasiUbatanSearch represents the model behind the search form about `app\models\FarmasiUbatan`.
 */
class FarmasiUbatanSearch extends FarmasiUbatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['farmasi_ubatan_id', 'farmasi_permohonan_ubatan_id', 'kuantiti'], 'integer'],
            [['nama_ubat', 'size', 'session_id'], 'safe'],
            [['harga'], 'number'],
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
        $query = FarmasiUbatan::find()
                ->joinWith(['refUbat']);

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
            'farmasi_ubatan_id' => $this->farmasi_ubatan_id,
            'farmasi_permohonan_ubatan_id' => $this->farmasi_permohonan_ubatan_id,
            'kuantiti' => $this->kuantiti,
            'harga' => $this->harga,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_ubat.desc', $this->nama_ubat])
            ->andFilterWhere(['like', 'size', $this->size])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
