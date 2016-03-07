<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ElaunJurulatih;

/**
 * ElaunJurulatihSearch represents the model behind the search form about `app\models\ElaunJurulatih`.
 */
class ElaunJurulatihSearch extends ElaunJurulatih
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['elaun_jurulatih_id', 'gaji_dan_elaun_jurulatih_id'], 'integer'],
            [['jenis_elaun', 'session_id'], 'safe'],
            [['jumlah_elaun'], 'number'],
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
        $query = ElaunJurulatih::find()
                ->joinWith(['refJenisElaunJurulatih']);

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
            'elaun_jurulatih_id' => $this->elaun_jurulatih_id,
            'gaji_dan_elaun_jurulatih_id' => $this->gaji_dan_elaun_jurulatih_id,
            'jumlah_elaun' => $this->jumlah_elaun,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_jenis_elaun_jurulatih.desc', $this->jenis_elaun])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
