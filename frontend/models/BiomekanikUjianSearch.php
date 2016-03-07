<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BiomekanikUjian;

/**
 * BiomekanikUjianSearch represents the model behind the search form about `app\models\BiomekanikUjian`.
 */
class BiomekanikUjianSearch extends BiomekanikUjian
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['biomekanik_ujian_id', 'perkhidmatan_analisa_perlawanan_biomekanik_id'], 'integer'],
            [['tarikh', 'biomekanik_ujian', 'session_id'], 'safe'],
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
        $query = BiomekanikUjian::find()
                ->joinWith(['refBiomekanikUjian']);

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
            'biomekanik_ujian_id' => $this->biomekanik_ujian_id,
            'perkhidmatan_analisa_perlawanan_biomekanik_id' => $this->perkhidmatan_analisa_perlawanan_biomekanik_id,
            'tarikh' => $this->tarikh,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_biomekanik_ujian.desc', $this->biomekanik_ujian])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
