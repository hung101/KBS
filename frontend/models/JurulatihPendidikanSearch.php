<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JurulatihPendidikan;

/**
 * JurulatihPendidikanSearch represents the model behind the search form about `app\models\JurulatihPendidikan`.
 */
class JurulatihPendidikanSearch extends JurulatihPendidikan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jurulatih_pendidikan_id', 'jurulatih_id'], 'integer'],
            [['tahun', 'sekolah_kolej_universiti', 'gred'], 'safe'],
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
        $query = JurulatihPendidikan::find();

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
            'jurulatih_pendidikan_id' => $this->jurulatih_pendidikan_id,
            'jurulatih_id' => $this->jurulatih_id,
            'tahun' => $this->tahun,
        ]);

        $query->andFilterWhere(['like', 'sekolah_kolej_universiti', $this->sekolah_kolej_universiti])
            ->andFilterWhere(['like', 'gred', $this->gred]);

        return $dataProvider;
    }
}
