<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PemberianSuplemenMakananJusRundinganPendidikan;

/**
 * PemberianSuplemenMakananJusRundinganPendidikanSearch represents the model behind the search form about `app\models\PemberianSuplemenMakananJusRundinganPendidikan`.
 */
class PemberianSuplemenMakananJusRundinganPendidikanSearch extends PemberianSuplemenMakananJusRundinganPendidikan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pemberian_suplemen_makanan_jus_rundingan_pendidikan_id', 'perkhidmatan_permakanan_id', 'kuantiti_ml_g'], 'integer'],
            [['nama_suplemen_makanan_jus_rundingan_pendidikan', 'session_id'], 'safe'],
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
        $query = PemberianSuplemenMakananJusRundinganPendidikan::find();

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
            'pemberian_suplemen_makanan_jus_rundingan_pendidikan_id' => $this->pemberian_suplemen_makanan_jus_rundingan_pendidikan_id,
            'perkhidmatan_permakanan_id' => $this->perkhidmatan_permakanan_id,
            'nama_suplemen_makanan_jus_rundingan_pendidikan' => $this->nama_suplemen_makanan_jus_rundingan_pendidikan,
            'kuantiti_ml_g' => $this->kuantiti_ml_g,
            'harga' => $this->harga,
        ]);
        
        $query->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
