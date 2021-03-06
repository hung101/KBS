<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JurulatihPengalaman;

/**
 * JurulatihPengalamanSearch represents the model behind the search form about `app\models\JurulatihPengalaman`.
 */
class JurulatihPengalamanSearch extends JurulatihPengalaman
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jurulatih_pengalaman_id', 'jurulatih_id'], 'integer'],
            [['tahun', 'tahun_akhir', 'perkara_aktiviti'], 'safe'],
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
        $query = JurulatihPengalaman::find();

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
            'jurulatih_pengalaman_id' => $this->jurulatih_pengalaman_id,
            'jurulatih_id' => $this->jurulatih_id,
            //'tahun' => $this->tahun,
            //'tahun' => $this->tahun,
        ]);

        $query->andFilterWhere(['like', 'perkara_aktiviti', $this->perkara_aktiviti])
                ->andFilterWhere(['like', 'tahun', $this->tahun])
                ->andFilterWhere(['like', 'tahun_akhir', $this->tahun_akhir]);

        return $dataProvider;
    }
}
