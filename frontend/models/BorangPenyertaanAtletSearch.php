<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BorangPenyertaanAtlet;

/**
 * BorangPenyertaanAtletSearch represents the model behind the search form about `app\models\BorangPenyertaanAtlet`.
 */
class BorangPenyertaanAtletSearch extends BorangPenyertaanAtlet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['borang_penyertaan_atlet_id'], 'integer'],
            [['nama_program', 'tarikh_program', 'atlet_id'], 'safe'],
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
        $query = BorangPenyertaanAtlet::find()
                ->joinWith(['atlet'])
                ->joinWith(['namaProgram']);

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
            'borang_penyertaan_atlet_id' => $this->borang_penyertaan_atlet_id,
            //'atlet_id' => $this->atlet_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_pengurusan_program_binaan.nama_program', $this->nama_program])
                ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id])
                ->andFilterWhere(['like', 'tarikh_program', $this->tarikh_program]);

        return $dataProvider;
    }
}
